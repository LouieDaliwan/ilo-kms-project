<script setup>
import { useDisplay } from "vuetify";
import $api from "./routes/api.js";
import { computed, onMounted, reactive, ref } from "vue";
import IndicatorTwoData from "./Components/IndicatorTwoData.vue";
import IndicatorTwoComments from "./Components/IndicatorTwoComments.vue";
import { useForm } from "vee-validate";
import { uploadSchema } from "../WISE/Schema/uploadvalidation";
import Swal from "sweetalert2";

const { defineComponentBinds, resetForm, handleSubmit, meta } = useForm({
    validationSchema: uploadSchema,
});

const vuetifyConfig = (state) => ({
    props: {
        "error-messages": state.errors,
    },
});

const upload = defineComponentBinds("file_upload", vuetifyConfig);

const fileUpload = ref([]);

const dialogBox = reactive({ dialog: false });

function uploadModal() {
    dialogBox.dialog = true;
}

onMounted(() => {
    fetchIndicatorTwoData();
});

const indicatorData = ref([]);

const fetchIndicatorTwoData = () => {
    axios
        .get($api.indicatorTwoData())
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

const onSubmit = handleSubmit(async () => {
    const formData = new FormData();

    formData.append("file", file.value);

    await axios
        .post($api.uploadIndicatorTwo(), formData, {
            headers: {
                "Content-Type": "multipart/form-data",
            },
        })
        .then(({ data }) => {
            fetchIndicatorTwoData();
        })
        .catch((err) => {
            console.log(err);
        })
        .finally(() => {
            dialogBox.dialog = false;
            fileUpload.value = [];
            Swal.fire({
                title: "Success!",
                text: "Data has been uploaded.",
                icon: "success",
                confirmButtonColor: "#1E2DBE",
            });
        });
});

const isDisabledComputed = computed(() => {
    return meta.value.valid;
});
</script>

<template>
    <admin>
        <metatag :title="'Regional MSME'"></metatag>

        <page-header>
            <template v-slot:title>Regional MSME</template>

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
                            <div class="bg-blue-lighten-5">
                                <v-card-title
                                    class="text-secondary-color font-weight-bold"
                                >
                                    UPLOAD DATA
                                </v-card-title>
                            </div>
                            <small
                                class="font-italic font-weight-thin pt-3 pb-2 px-5"
                                >Please make sure that the fields on the excel
                                file are in order and correct.</small
                            >
                            <v-form
                                enctype="multipart/form-data"
                                @submit.prevent="onSubmit"
                            >
                                <v-card-text>
                                    <v-file-input
                                        v-model="fileUpload"
                                        label="File input"
                                        name="file_upload"
                                        show-size
                                        v-bind="upload"
                                        @change="uploadFile"
                                    ></v-file-input>
                                </v-card-text>

                                <v-divider></v-divider>

                                <v-card-actions>
                                    <v-spacer></v-spacer>
                                    <v-btn
                                        :disabled="!isDisabledComputed"
                                        color="primary"
                                        type="submit"
                                    >
                                        Upload
                                    </v-btn>
                                </v-card-actions>
                            </v-form>
                        </v-card>
                    </v-dialog>
                </div>
            </template>
        </page-header>

        <indicator-two-data :values="indicatorData"></indicator-two-data>

        <indicator-two-comments></indicator-two-comments>
    </admin>
</template>
