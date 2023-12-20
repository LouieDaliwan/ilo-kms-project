<script setup>
import Admin from "@/Components/Layouts/Admin.vue";
import PageHeader from "@/Components/Headers/PageHeader.vue";
import { useDisplay } from "vuetify";
import $api from "./routes/api.js";
import { reactive } from "vue";
import WiseChart from "./Bar-sample-1/WiseChart.vue";
import WiseChart2 from "./Bar-sample-2/WiseChart.vue";
import WiseChart3 from "./Bar-sample-3/WiseChart.vue";
import WiseChart4 from "./Bar-sample-4/WiseChart.vue";
import WiseChart5 from "./Bar-sample-5/WiseChart.vue";
import WiseChart6 from "./Bar-sample-6/WiseChart.vue";
import PieChart from "./Pie-sample/WiseChart.vue";

const dialogBox = reactive({ dialog: false });

function uploadModal() {
    dialogBox.dialog = true;
}

const { smAndDown } = useDisplay();

const onSubmit = () => {
    axios
        .post(
            $api.uploadEvaluation(),
            {},
            {
                headers: {
                    "Content-Type": "multipart/form-data",
                },
            },
        )
        .then((response) => {
            console.log(response);
        })
        .catch((error) => {
            console.log(error);
        });
};
</script>

<template>
    <admin>
        <metatag :title="'Wise Activity'"></metatag>

        <page-header>
            <template v-slot:title> WISE Activity Plus</template>

            <template v-slot:action>
                <v-btn
                    :block="!!smAndDown"
                    color="primary"
                    large
                    rounded
                    @click="uploadModal"
                >
                    Add data
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
                                ></v-file-input>
                            </v-card-text>

                            <v-divider></v-divider>

                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn
                                    color="primary"
                                    @click="dialogBox.dialog = false"
                                >
                                    Save
                                </v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-dialog>
                </div>
            </template>
        </page-header>

        <v-form
            ref="addform-form"
            autocomplete="false"
            enctype="multipart/form-data"
            @submit.prevent="onSubmit"
        >
            <button ref="submit-button" type="submit">Save</button>
        </v-form>
        <div class="mt-15">
            <h3>Workplan Completion</h3>
            <p>SMEs that have implemented their workplan.</p>
            <v-progress-linear
                :height="12"
                bg-color="#303DC3"
                color="rgb(250,60,75)"
                model-value="20"
            ></v-progress-linear>
        </div>
        <div class="mt-15">
            <h3>OSH Knowledge Assessment</h3>
            <p>
                The percentage of workers reporting an improved understanding of
                their rights and duties related to OSH issues.
            </p>
            <v-row class="mt-5">
                <v-col>
                    <PieChart />
                </v-col>
                <v-col>
                    <WiseChart5 />
                </v-col>
                <v-col>
                    <WiseChart6 />
                </v-col>
            </v-row>
        </div>
        <div class="mt-10">
            <v-row class="mt-5">
                <v-col>
                    <WiseChart />
                </v-col>
                <v-col>
                    <WiseChart2 />
                </v-col>
            </v-row>
            <v-row class="mt-5">
                <v-col>
                    <WiseChart3 />
                </v-col>
                <v-col>
                    <WiseChart4 />
                </v-col>
            </v-row>
        </div>
    </admin>
</template>
