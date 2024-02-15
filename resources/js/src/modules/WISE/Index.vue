<script setup>
import Admin from "@/Components/Layouts/Admin.vue";
import EvaluationData from "./Components/EvaluationData.vue";

import { onMounted, ref } from "vue";
import $api from "@modules/WISE/routes/api.js";

onMounted(() => {
    getData();
    fetchEvaluation();
});

const evaluationData = ref([]);
const overAllData = ref([]);

const labels = ref([
    "Agriculture",
    "Manufacturing",
    "Others",
    "Small Construction",
    "Services",
]);

const sectorValues = ref([0, 0, 0, 0, 0]);

const getData = () => {
    axios
        .get($api.overall())
        .then(({ data }) => {
            overAllData.value = data;
            sectorValues.value = [
                data.sector["Agriculture"],
                data.sector["Manufacturing"],
                data.sector["Others"],
                data.sector["Small Construction"],
                data.sector["Services"],
            ];
        })
        .catch((err) => {});
};

const fetchEvaluation = () => {
    axios
        .get($api.evaluations())
        .then(({ data }) => {
            evaluationData.value = data.values;
        })
        .catch((err) => {});
};
</script>

<template>
    <admin>
        <metatag :title="'Wise Dashboard'"></metatag>

        <page-header>
            <template v-slot:title> WISE Dashboard</template>
        </page-header>
        <div class="workplan-completion rounded pa-6 mb-10">
            <div>
                <h3 class="text-tertiary-color">Workplan Completion</h3>
                <p>SMEs that have implemented their workplan.</p>
                <div class="d-flex align-end">
                    <h1 class="text-secondary-color mt-1">
                        {{ overAllData.total_participants }}
                    </h1>
                </div>
            </div>
            <div class="mt-15">
                <v-row class="mt-5">
                    <v-col>
                        <h4 class="text-secondary">Sector</h4>
                        <Pie
                            v-if="overAllData"
                            :labels="labels"
                            :name="'wise-sector'"
                            :values="sectorValues"
                            class="mt-10"
                        />
                    </v-col>
                    <v-col>
                        <h4 class="text-secondary mb-9">Gender</h4>
                        <Bar
                            :name="'gender'"
                            :values="overAllData.gender"
                        ></Bar>
                    </v-col>
                    <v-col>
                        <h4 class="text-secondary mb-9">Position</h4>
                        <Bar
                            :name="'position'"
                            :values="overAllData.position"
                        ></Bar>
                    </v-col>
                </v-row>
            </div>
        </div>
        <evaluation-data :values="evaluationData"></evaluation-data>
    </admin>
</template>
