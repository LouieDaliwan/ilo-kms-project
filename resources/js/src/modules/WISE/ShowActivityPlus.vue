<script setup>
import { onMounted, ref } from "vue";
import { useRouter } from "vue-router";
import $api from "./routes/api.js";

const activityPlus = ref([]);

const actionItems = ref([]);

const fullname = ref("");

const route = useRouter();

const getActivityPlus = () => {
    axios
        .get($api.activityReport(route.currentRoute.value.params.activity_id))
        .then(({ data }) => {
            activityPlus.value = data.data;
            actionItems.value = data
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

        <page-header>
            <template v-slot:title>Activity Plus </template>
        </page-header>

        <v-row class="txtfield-border">
            <v-col cols="12" md="12">
                <v-card class="mb-3">
                    <v-card-title>Account Information</v-card-title>
                    <v-card-text>
                        <v-row>
                            <v-col>
                                <text-field
                                    v-model="activityPlus.company_name"
                                    :disabled="false"
                                    :label="'Company Name'"
                                    class="mb-3"
                                ></text-field>
                                <text-field
                                    v-model="fullname"
                                    :disabled="false"
                                    :label="'Participant'"
                                    class="mb-3"
                                ></text-field>
                                <text-field
                                    v-model="activityPlus.action_checklist_type"
                                    :disabled="false"
                                    :label="'Action Checklist Type'"
                                    class="mb-3"
                                ></text-field>
                            </v-col>
                            <v-col>
                                <text-field
                                    v-model="activityPlus.venue"
                                    :disabled="false"
                                    :label="'Venue'"
                                    class="mb-3"
                                ></text-field>
                                <text-field
                                    v-model="activityPlus.dateOfTraining"
                                    :disabled="false"
                                    :label="'Date of Training'"
                                    class="mb-3"
                                ></text-field>
                                <text-field
                                    v-model="activityPlus.link_pictures"
                                    :disabled="false"
                                    :label="'Link Pictures'"
                                    class="mb-3"
                                ></text-field>
                            </v-col>
                        </v-row>
                    </v-card-text>
                </v-card>

                <v-card class="mb-3">
                    <v-card-title>Action items</v-card-title>
                    <v-card-text style="overflow-y: scroll; max-height: 25rem;">
                        <v-row>
                            <v-col>
                               <v-card class="mb-2">
                                    <v-card-item>
                                        <text-field
                                            v-if="activityPlus && activityPlus.action_item_1"
                                            v-model="activityPlus.action_item_1.question"
                                            :disabled="false"
                                            :label="'Action item #1 Question'"
                                        ></text-field>
                                    </v-card-item>
                                    <v-card-item>
                                        <text-field
                                            v-if="activityPlus && activityPlus.action_item_1"
                                            v-model="activityPlus.action_item_1.what"
                                            :disabled="false"
                                            :label="'What'"
                                        ></text-field>
                                    </v-card-item>
                                    <v-card-item>
                                        <text-field
                                            v-if="activityPlus && activityPlus.action_item_1"
                                            v-model="activityPlus.action_item_1.when"
                                            :disabled="false"
                                            :label="'When'"
                                        ></text-field>
                                    </v-card-item>
                                    <v-card-item>
                                        <text-field
                                            v-if="activityPlus && activityPlus.action_item_1"
                                            v-model="activityPlus.action_item_1.who"
                                            :disabled="false"
                                            :label="'Who'"
                                        ></text-field>
                                    </v-card-item>
                                </v-card>

                                <v-card class="mb-2">
                                    <v-card-item>
                                        <text-field
                                            v-if="activityPlus && activityPlus.action_item_2"
                                            v-model="activityPlus.action_item_2.question"
                                            :disabled="false"
                                            :label="'Action item #2 Question'"
                                        ></text-field>
                                    </v-card-item>
                                    <v-card-item>
                                        <text-field
                                            v-if="activityPlus && activityPlus.action_item_2"
                                            v-model="activityPlus.action_item_2.what"
                                            :disabled="false"
                                            :label="'What'"
                                        ></text-field>
                                    </v-card-item>
                                    <v-card-item>
                                        <text-field
                                            v-if="activityPlus && activityPlus.action_item_2"
                                            v-model="activityPlus.action_item_2.when"
                                            :disabled="false"
                                            :label="'When'"
                                        ></text-field>
                                    </v-card-item>
                                    <v-card-item>
                                        <text-field
                                            v-if="activityPlus && activityPlus.action_item_2"
                                            v-model="activityPlus.action_item_2.who"
                                            :disabled="false"
                                            :label="'Who'"
                                        ></text-field>
                                    </v-card-item>
                                </v-card>

                                <v-card class="mb-2">
                                    <v-card-item>
                                        <text-field
                                            v-if="activityPlus && activityPlus.action_item_3"
                                            v-model="activityPlus.action_item_3.question"
                                            :disabled="false"
                                            :label="'Action item #2 Question'"
                                        ></text-field>
                                    </v-card-item>
                                    <v-card-item>
                                        <text-field
                                            v-if="activityPlus && activityPlus.action_item_3"
                                            v-model="activityPlus.action_item_3.what"
                                            :disabled="false"
                                            :label="'What'"
                                        ></text-field>
                                    </v-card-item>
                                    <v-card-item>
                                        <text-field
                                            v-if="activityPlus && activityPlus.action_item_3"
                                            v-model="activityPlus.action_item_3.when"
                                            :disabled="false"
                                            :label="'When'"
                                        ></text-field>
                                    </v-card-item>
                                    <v-card-item>
                                        <text-field
                                            v-if="activityPlus && activityPlus.action_item_3"
                                            v-model="activityPlus.action_item_3.who"
                                            :disabled="false"
                                            :label="'Who'"
                                        ></text-field>
                                    </v-card-item>
                                </v-card>
                            </v-col>
                        </v-row>
                    </v-card-text>
                </v-card>

                <v-card>
                    <v-card-text>
                        <text-field
                        v-model="activityPlus.points_to_be_improved"
                        :disabled="false"
                        :label="'Points to be Improved'"
                    ></text-field>
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>
    </admin>
</template>
