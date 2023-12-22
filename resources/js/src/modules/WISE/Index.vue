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
import WiseChart7 from "./Bar-sample-7/WiseChart.vue";
import WiseChart8 from "./Bar-sample-8/WiseChart.vue";
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
        <metatag :title="'Wise Dashboard'"></metatag>

        <page-header>
            <template v-slot:title> WISE Dashboard </template>

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
        <div class="workplan-completion rounded pa-6">
            <div>
                <h3 class="text-tertiary-color">Workplan Completion</h3>
                <p>SMEs that have implemented their workplan.</p>
                <div class="d-flex align-end">
                    <h1 class="text-secondary-color mt-1">3,652</h1>
                    <p class="text-secondary-color ms-2 me-1">/</p>
                    <p class="text-secondary-color">10,000</p>
                </div>
                <v-progress-linear
                    :height="12"
                    bg-color="#303DC3"
                    color="rgb(250,60,75)"
                    model-value="20"
                ></v-progress-linear>
            </div>
            <div class="mt-15">
                <v-row class="mt-5">
                    <v-col>
                        <h4 class="text-secondary">Sector</h4>
                        <h5>3,652 Responses</h5>
                        <PieChart class="mt-10" />
                    </v-col>
                    <v-col>
                        <h4 class="text-secondary">Gender</h4>
                        <h5>3,652 Responses</h5>
                        <WiseChart5 class="mt-10" />
                    </v-col>
                    <v-col>
                        <h4 class="text-secondary">Position</h4>
                        <h5>3,652 Responses</h5>
                        <WiseChart6 class="mt-10" />
                    </v-col>
                </v-row>
            </div>
        </div>
        <div class="mt-10">
            <h3 class="text-tertiary-color">OSH Knowledge Assessment</h3>
            <p>
                The percentage of workers reporting an improved understanding of
                their rights and duties related to OSH issues.
            </p>
            <v-row class="mt-5">
                <v-col>
                    <v-card class="pa-5">
                        <div class="chart-title">
                            <p>The training objectives were met</p>
                        </div>
                        <WiseChart />
                    </v-card>
                </v-col>
                <v-col>
                    <v-card class="pa-5">
                        <div class="chart-title">
                            <p>As an employer, I have an improved understanding of my legal duties and responsibilities related to OSH.</p>
                        </div>
                        <WiseChart2 />
                    </v-card>
                </v-col>
            </v-row>
            <v-row class="mt-5">
                <v-col>
                    <v-card class="pa-5">
                        <div class="chart-title">
                            <p>As a worker,  I have an improved understanding of my legal duties and responsibilities related to OSH.</p>
                        </div>
                        <WiseChart3 />
                    </v-card>
                </v-col>
                <v-col>
                    <v-card class="pa-5">
                        <div class="chart-title">
                            <p>I have learned how to conduct hazard and risk assessment.</p>
                        </div>
                        <WiseChart4 />
                    </v-card>
                </v-col>
            </v-row>
            <v-row class="mt-5">
                <v-col>
                    <v-card class="pa-5">
                        <div class="chart-title">
                            <p>I have acquired new knowledge on how to prevent and mitigate COVID-19 and other health hazards in the workplace.</p>
                        </div>
                        <WiseChart7 />
                    </v-card>
                </v-col>
                <v-col>
                    <v-card class="pa-5">
                        <div class="chart-title">
                            <p>I will recommend this training to other MSMEs and informal business.</p>
                    </div>
                        <WiseChart8 />
                    </v-card>
                </v-col>
            </v-row>
        </div>
    </admin>
</template>
