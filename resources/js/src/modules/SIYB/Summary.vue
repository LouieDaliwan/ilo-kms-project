<script setup>
import { onMounted, ref } from "vue";
import $api from "./routes/api.js";
import BarHorizontal from "@components/Charts/BarHorizontal.vue";

onMounted(() => {
    getData();
});

const labelTOE = ref(["Total Planned TOE", "Total Conducted TOE"]);
const labelMSME = ref(["Total Planned MSME", "Total Conducted MSME"]);
const valueTOE = ref([30, 100]);
const valueMSME = ref([20, 100]);

const getData = () => {
    axios
        .get($api.summaryAgency(), {})
        .then(({ data }) => {
            console.log(data);
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
                        :values="valueTOE"
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
                        :values="valueMSME"
                        class="mt-10"
                    />
                </v-col>
            </v-row>
            <v-row class="mt-5">
                <v-col>
                    <h4 class="text-secondary">
                        <p>Training of Entrepreneurs</p>
                    </h4>
                    <BarHorizontal :name="'toe-bar'" />
                </v-col>
                <v-col>
                    <h4 class="text-secondary">
                        <p>Training of MSME's</p>
                    </h4>
                    <BarHorizontal :name="'msme-bar'" />
                </v-col>
            </v-row>
        </div>
    </admin>
</template>
