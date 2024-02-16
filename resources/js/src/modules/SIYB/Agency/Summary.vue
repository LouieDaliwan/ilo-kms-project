<script setup>
import { onMounted, ref } from "vue";
import $api from "../routes/api.js";
import BarHorizontal from "@components/Charts/BarHorizontal.vue";

onMounted(() => {
    getData();
});

const labelTOE = ref(["Total Planned TOE", "Total Conducted TOE"]);
const labelMSME = ref(["Total Planned MSME", "Total Conducted MSME"]);
const totalTOE = ref([0, 0]);
const totalMSME = ref([0, 0]);

const entrepeneurDataPlanned = ref([]);
const entrepeneurDataConducted = ref([]);
const entrepeneurLabel = ref([]);

const msmeDataPlanned = ref([]);
const msmeDataConducted = ref([]);
const msmeLabel = ref([]);

const getData = () => {
    axios
        .get($api.summaryAgency(), {})
        .then(({ data }) => {
            const entrepeneur = data.entrepreneur;
            const msme = data.msme;

            totalTOE.value = [
                entrepeneur.total_planned_toe,
                entrepeneur.total_conducted_toe,
            ];

            totalMSME.value = [
                msme.total_planned_msme,
                msme.total_conducted_msme,
            ];

            delete entrepeneur.total_planned_toe;
            delete entrepeneur.total_conducted_toe;
            delete msme.total_conducted_msme;
            delete msme.total_planned_msme;

            window._.map(entrepeneur, (value, key) => {
                entrepeneurLabel.value.push(key);
                entrepeneurDataPlanned.value.push(value.planned_toe);
                entrepeneurDataConducted.value.push(value.conducted_toe);
            });

            window._.map(msme, (value, key) => {
                msmeLabel.value.push(key);
                msmeDataPlanned.value.push(value.planned_msme);
                msmeDataConducted.value.push(value.conducted_msme);
            });
        })
        .catch((err) => {})
        .finally(() => {});
};
</script>
<template>
    <admin>
        <metatag :title="'Agencies Summary'"></metatag>

        <page-header>
            <template v-slot:title>Summary Report</template>
        </page-header>

        <div class="mt-10">
            <v-row class="mt-5">
                <v-col>
                    <h4 class="text-secondary">
                        <p>Total Training of Entrepreneurs</p>
                    </h4>
                    <Pie
                        :labels="labelTOE"
                        :name="'siyb-toe'"
                        :values="totalTOE"
                        class="mt-10"
                    />
                </v-col>
                <v-col>
                    <h4 class="text-secondary">
                        <p>Total Training of MSME's</p>
                    </h4>
                    <Pie
                        :labels="labelMSME"
                        :name="'siyb-msme'"
                        :values="totalMSME"
                        class="mt-10"
                    />
                </v-col>
            </v-row>
            <v-row class="mt-12">
                <v-col cols="12" md="6">
                    <h4 class="text-secondary">
                        <p>Training of Entrepreneurs</p>
                    </h4>
                    <BarHorizontal
                        v-if="entrepeneurLabel.length > 0"
                        :labels="entrepeneurLabel"
                        :name="'toe-bar'"
                        :values="entrepeneurDataPlanned"
                        :values2="entrepeneurDataConducted"
                    />
                </v-col>
                <v-col cols="12" md="6">
                    <h4 class="text-secondary">
                        <p>Training of MSME's</p>
                    </h4>
                    <BarHorizontal
                        v-if="msmeLabel.length > 0"
                        :labels="msmeLabel"
                        :name="'msme-bar'"
                        :values="msmeDataPlanned"
                        :values2="msmeDataConducted"
                    />
                </v-col>
            </v-row>
        </div>
    </admin>
</template>
