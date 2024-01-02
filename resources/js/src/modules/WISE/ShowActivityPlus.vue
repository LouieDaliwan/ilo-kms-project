<script setup>
import { onMounted, ref } from "vue";
import { useRouter } from "vue-router";
import $api from "./routes/api.js";

const activityPlus = ref([]);

const fullname = ref("");

const route = useRouter();

const getActivityPlus = () => {
    axios
        .get($api.activityReport(route.currentRoute.value.params.activity_id))
        .then(({ data }) => {
            activityPlus.value = data.data;
            const participant = data.data.participant;
            fullname.value =
                participant.first_name + " " + participant.last_name;
        })
        .catch((error) => {
            console.log(error);
        })
        .finally(() => {
            console.log("finally");
        });
};

onMounted(() => {
    getActivityPlus();
});
</script>
<template>
    <admin>
        <metatag :title="'Activity Plus'"></metatag>

        <!--        top left-->
        <h5>Company Name:</h5>
        <p v-text="activityPlus.company_name"></p>

        <h5>Participant</h5>
        <p v-text="fullname"></p>

        <h5>Action Checklist Type</h5>
        <p v-text="activityPlus.action_checklist_type"></p>

        <!--        top right-->
        <h5>Venue:</h5>
        <p v-text="activityPlus.venue"></p>

        <h5>Date of Training</h5>
        <p v-text="activityPlus.dateOfTraining"></p>

        <h5>Link Pictures</h5>
        <p v-text="activityPlus.link_pictures"></p>

        <h5>Action Items 1</h5>
        <!--        Question:-->
        <!--        <p v-text="activityPlus.action_item_1.question"></p>-->
        <!--        What:-->
        <!--        <p v-text="activityPlus.action_item_1.what"></p>-->
        <!--        When:-->
        <!--        <p v-text="activityPlus.action_item_1.when"></p>-->
        <!--        Who:-->
        <!--        <p v-text="activityPlus.action_item_1.who"></p>-->

        <!--        <h5>Action Items 2</h5>-->
        <!--        Question:-->
        <!--        <p v-text="activityPlus.action_item_2.question"></p>-->
        <!--        What:-->
        <!--        <p v-text="activityPlus.action_item_2.what"></p>-->
        <!--        When:-->
        <!--        <p v-text="activityPlus.action_item_2.when"></p>-->
        <!--        Who:-->
        <!--        <p v-text="activityPlus.action_item_2.who"></p>-->

        <!--        <h5>Action Items 3</h5>-->
        <!--        Question:-->
        <!--        <p v-text="activityPlus.action_item_3.question"></p>-->
        <!--        What:-->
        <!--        <p v-text="activityPlus.action_item_3.what"></p>-->
        <!--        When:-->
        <!--        <p v-text="activityPlus.action_item_3.when"></p>-->
        <!--        Who:-->
        <!--        <p v-text="activityPlus.action_item_3.who"></p>-->

        <h5>Points to be Improved:</h5>
        <p v-text="activityPlus.points_to_be_improved"></p>
    </admin>
</template>
