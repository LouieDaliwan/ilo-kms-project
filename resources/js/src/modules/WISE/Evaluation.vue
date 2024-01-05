<script setup>
import Admin from "@/Components/Layouts/Admin.vue";
import PageHeader from "@/Components/Headers/PageHeader.vue";
import { useDisplay } from "vuetify";
import $api from "./routes/api.js";
import { onMounted, reactive, ref } from "vue";

const dialogBox = reactive({ dialog: false });

function uploadModal() {
    dialogBox.dialog = true;
}

onMounted(() => {
    fetchEvaluation();
});

const evaluationData = ref([]);

const fetchEvaluation = () => {
    axios
        .get($api.evaluations())
        .then(({ data }) => {
            evaluationData.value = data.values;
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
        .post($api.uploadEvaluation(), formData, {
            headers: {
                "Content-Type": "multipart/form-data",
            },
        })
        .then(({ data }) => {
            fetchEvaluation();
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
        <metatag :title="'Wise Evaluation'"></metatag>

        <page-header>
            <template v-slot:title> WISE Evaluation</template>

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
                        <Bar
                            :name="'evaluation-chart-1'"
                            :values="evaluationData.first_question"
                        />
                    </v-card>
                </v-col>
                <v-col>
                    <v-card class="pa-5">
                        <div class="chart-title">
                            <p>
                                As an employer, I have an improved understanding
                                of my legal duties and responsibilities related
                                to OSH.
                            </p>
                        </div>
                        <Bar
                            :name="'evaluation-chart-2'"
                            :values="evaluationData.second_question"
                        />
                    </v-card>
                </v-col>
            </v-row>
            <v-row class="mt-5">
                <v-col>
                    <v-card class="pa-5">
                        <div class="chart-title">
                            <p>
                                As a worker, I have an improved understanding of
                                my legal duties and responsibilities related to
                                OSH.
                            </p>
                        </div>
                        <Bar
                            :name="'evaluation-chart-3'"
                            :values="evaluationData.third_question"
                        />
                    </v-card>
                </v-col>
                <v-col>
                    <v-card class="pa-5">
                        <div class="chart-title">
                            <p>
                                I have learned how to conduct hazard and risk
                                assessment.
                            </p>
                        </div>

                        <Bar
                            :name="'evaluation-chart-4'"
                            :values="evaluationData.fourth_question"
                        />
                    </v-card>
                </v-col>
            </v-row>
            <v-row class="mt-5">
                <v-col>
                    <v-card class="pa-5">
                        <div class="chart-title">
                            <p>
                                I have acquired new knowledge on how to prevent
                                and mitigate COVID-19 and other health hazards
                                in the workplace.
                            </p>
                        </div>
                        <Bar
                            :name="'evaluation-chart-5'"
                            :values="evaluationData.fifth_question"
                        />
                    </v-card>
                </v-col>
                <v-col>
                    <v-card class="pa-5">
                        <div class="chart-title">
                            <p>
                                I will recommend this training to other MSMEs
                                and informal business.
                            </p>
                        </div>
                        <Bar
                            :name="'evaluation-chart-6'"
                            :values="evaluationData.sixth_question"
                        />
                    </v-card>
                </v-col>
            </v-row>
        </div>
    </admin>
</template>
