<script setup>
import Information from "./Components/ParticipantInformation.vue";
import Evaluation from "./Components/ParticipantEvaluation.vue";
import ActivityPlus from "./Components/ParticipantActivityPlus.vue";
</script>
<template>
    <admin>
        <metatag title="Participant" />

        <page-header>
            <template v-slot:title>Participant</template>
        </page-header>

        <Information />
        <ActivityPlus />
        <Evaluation />
    </admin>
</template>
