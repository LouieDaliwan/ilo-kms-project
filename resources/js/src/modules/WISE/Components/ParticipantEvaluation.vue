<script setup>
import { onMounted } from "vue";
import $api from "../routes/api.js";
import { useRouter } from "vue-router";

const router = useRouter();

onMounted(() => {
    console.log("test");
    console.log($api);

    // getActivity();
});

const getEvaluation = () => {
    axios
        .get($api.participantEvaluation(router.currentRoute.value.params.id))
        .then(({ data }) => {
            console.log(data);
        })
        .catch((error) => {
            console.log(error);
        })
        .finally(() => {
            console.log("Finally");
        });
};
</script>

<template>
    <h1>test</h1>
</template>
