<script setup>
import { useDisplay } from "vuetify";
import $api from "./routes/api.js";
import { onMounted, reactive, ref } from "vue";
import IndicatorThreeData from "@modules/SCORE/Components/IndicatorThreeData.vue";

const dialogBox = reactive({ dialog: false });

function uploadModal() {
    dialogBox.dialog = true;
}

onMounted(() => {
    fetchIndicatorThreeData();
});

const indicatorData = ref([]);

const fetchIndicatorThreeData = () => {
    axios
        .get($api.indicatorThreeData())
        .then(({ data }) => {
            indicatorData.value = data;
        })
        .catch((err) => {});
};

const { smAndDown } = useDisplay();

const file = ref(null);

const uploadFile = (event) => {
    file.value = event.target.files[0];
};

const onSubmit = async () => {
    const formData = new FormData();

    formData.append("file", file.value);

    await axios
        .post($api.uploadIndicatorThree(), formData, {
            headers: {
                "Content-Type": "multipart/form-data",
            },
        })
        .then(({ data }) => {
            fetchIndicatorThreeData();
        })
        .catch((err) => {
            console.log(err);
        })
        .finally(() => {
            dialogBox.dialog = false;
        });
};
</script>

<template>
    <admin>
        <metatag :title="'Score Indicator Three'"></metatag>

        <page-header>
            <template v-slot:title> Score Indicator Three</template>

            <template v-slot:action>
                <v-btn
                    :block="!!smAndDown"
                    color="primary"
                    large
                    rounded
                    @click="uploadModal"
                >
                    Upload data
                    <v-icon class="ms-2" left>mdi-cloud-upload</v-icon>
                </v-btn>
                <div class="text-center">
                    <v-dialog v-model="dialogBox.dialog" width="500">
                        <v-card>
                            <v-card-title class="text-h5 grey lighten-2">
                                Upload a File
                            </v-card-title>

                            <v-card-text>
                                <v-file-input
                                    label="File input"
                                    show-size
                                    @change="uploadFile"
                                ></v-file-input>
                            </v-card-text>

                            <v-divider></v-divider>

                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn color="primary" @click="onSubmit">
                                    Upload
                                </v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-dialog>
                </div>
            </template>
        </page-header>

        <indicator-three-data :values="indicatorData"></indicator-three-data>
    </admin>
</template>
