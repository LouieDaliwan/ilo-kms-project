<script setup>
import { onMounted, ref } from "vue";
import $api from "../routes/api.js";
import { useRouter } from "vue-router";
import EvaluationData from "@modules/WISE/Components/EvaluationData.vue";

const router = useRouter();

const evaluationData = ref([]);

onMounted(() => {
    getEvaluation();
});

const getEvaluation = () => {
    axios
        .get($api.participantEvaluation(router.currentRoute.value.params.id))
        .then(({ data }) => {
            evaluationData.value = data.values;
        })
        .catch((error) => {})
        .finally(() => {});
};
</script>

<template>
    <div>
        <h1>Evaluation</h1>
        <evaluation-data :values="evaluationData" />
    </div>
</template>
