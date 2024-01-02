<script setup>
import { onMounted, ref } from "vue";
import $api from "./routes/api.js";
import { useRouter } from "vue-router";

const router = useRouter();
const dataParticipant = ref([]);
const fullname = ref("");

onMounted(() => {
    console.log("test");
    getParticipant();
});

const getParticipant = () => {
    console.log(router.currentRoute.value.params.id);
    axios
        .get($api.participant(router.currentRoute.value.params.id))
        .then(({ data }) => {
            dataParticipant.value = data.data;
            fullname.value = dataParticipant.value.fullname;
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
    <admin>
        <metatag title="Participant" />

        <page-header>
            <template v-slot:title>Participant {{ fullname }}</template>
        </page-header>

        <v-row>
            <v-col cols="12" md="12">
                <v-card class="mb-3">
                    <v-card-title>Account Information</v-card-title>
                    <v-card-text>
                        <v-row>
                            <v-col cols="12" md="4">
                                <text-field
                                    v-model="dataParticipant.first_name"
                                    :disabled="false"
                                    :label="'First Name'"
                                    :name="'first_name'"
                                ></text-field>
                            </v-col>
                            <v-col cols="12" md="4">
                                <text-field
                                    v-model="dataParticipant.middle_name"
                                    :disabled="false"
                                    :label="'Middle Name'"
                                    :name="'middle_name'"
                                ></text-field>
                            </v-col>
                            <v-col cols="12" md="4">
                                <text-field
                                    v-model="dataParticipant.last_name"
                                    :disabled="false"
                                    :label="'Last Name'"
                                    :name="'last_name'"
                                ></text-field>
                            </v-col>
                            <v-col cols="12" md="4">
                                <text-field
                                    v-model="dataParticipant.suffix"
                                    :disabled="false"
                                    :label="'Suffix'"
                                    :name="'suffix'"
                                ></text-field>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col cols="12">
                                <text-field
                                    v-model="dataParticipant.email"
                                    :disabled="false"
                                    :label="'Email'"
                                    :name="'email'"
                                ></text-field>
                            </v-col>
                            <v-col cols="12">
                                <text-field
                                    v-model="dataParticipant.nickname"
                                    :disabled="false"
                                    :label="'Nickname'"
                                    :name="'username'"
                                ></text-field>
                            </v-col>
                        </v-row>
                        <v-row align="center">
                            <v-col cols="12" md="4">
                                <text-field
                                    v-model="dataParticipant.phone_number"
                                    :disabled="false"
                                    :label="'Phone Number'"
                                    :name="'phone_number'"
                                ></text-field>
                            </v-col>
                            <v-col cols="12" md="4">
                                <text-field
                                    v-model="dataParticipant.position"
                                    :disabled="false"
                                    :label="'Position'"
                                    :name="'position'"
                                ></text-field>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col cols="12" md="4">
                                <text-field
                                    v-model="dataParticipant.member_of"
                                    :disabled="false"
                                    :label="'Group Member'"
                                    :name="'member_of'"
                                ></text-field>
                            </v-col>
                            <v-col cols="12" md="4">
                                <text-field
                                    v-model="dataParticipant.type_of_business"
                                    :disabled="false"
                                    :label="'Type of Business'"
                                    :name="'type_of_business'"
                                ></text-field>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col cols="12" md="4">
                                <text-field
                                    v-model="dataParticipant.business_sector"
                                    :disabled="false"
                                    :label="'Business Sector'"
                                    :name="'business_sector'"
                                ></text-field>
                            </v-col>
                            <v-col cols="12" md="4">
                                <text-field
                                    v-model="
                                        dataParticipant.isBusinessRegistered
                                    "
                                    :disabled="false"
                                    :label="'Is Business Registered'"
                                    :name="'isBusinessRegistered'"
                                ></text-field>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col cols="12" md="4">
                                <text-field
                                    v-model="dataParticipant.registered_to"
                                    :disabled="false"
                                    :label="'Business Sector'"
                                    :name="'business_sector'"
                                ></text-field>
                            </v-col>
                            <v-col cols="12" md="4">
                                <text-field
                                    v-model="
                                        dataParticipant.beneficiary_of_gov_project
                                    "
                                    :disabled="false"
                                    :label="'Beneficiary of Gov Project'"
                                    :name="'Beneficiary of Gov Project'"
                                ></text-field>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col cols="12">
                                <text-field
                                    v-model="dataParticipant.government_agency"
                                    :disabled="false"
                                    :label="'Government Agency'"
                                    :name="'government_agency'"
                                ></text-field>
                            </v-col>
                        </v-row>
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>
    </admin>
</template>
