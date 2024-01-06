<script setup>
import Admin from "@/Components/Layouts/Admin.vue";
import PageHeader from "@/Components/Headers/PageHeader.vue";
import EvaluationData from "./Components/EvaluationData.vue";

import WiseChart5 from "./Bar-sample-5/WiseChart.vue";
import WiseChart6 from "./Bar-sample-6/WiseChart.vue";

import { onMounted, ref } from "vue";
import $api from "@modules/WISE/routes/api.js";

onMounted(() => {
    getData();
    fetchEvaluation();
});

const getData = () => {};

const evaluationData = ref([]);

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
        <div class="workplan-completion rounded pa-6">
            <div>
                <h3 class="text-tertiary-color">Workplan Completion</h3>
                <p>SMEs that have implemented their workplan.</p>
                <div class="d-flex align-end">
                    <h1 class="text-secondary-color mt-1">3,652</h1>
                </div>
            </div>
            <div class="mt-15">
                <v-row class="mt-5">
                    <v-col>
                        <h4 class="text-secondary">Sector</h4>
                        <!-- <h5>3,652 Responses</h5> -->
                        <Pie class="mt-10" />
                    </v-col>
                    <v-col>
                        <h4 class="text-secondary">Gender</h4>
                        <!-- <h5>3,652 Responses</h5> -->
                        <WiseChart5 class="mt-10" />
                    </v-col>
                    <v-col>
                        <h4 class="text-secondary">Position</h4>
                        <!-- <h5>3,652 Responses</h5> -->
                        <WiseChart6 class="mt-10" />
                    </v-col>
                </v-row>
            </div>
        </div>
        <evaluation-data :values="evaluationData"></evaluation-data>
    </admin>
</template>
