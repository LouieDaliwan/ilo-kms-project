<script setup>
import { ref } from "vue";
import BarHorizontal from "@components/Charts/BarHorizontal.vue";

const labelGender = ref(["Male", "Female"]);
const labelAge = ref(["16-25", "26-35", "36-45", "46-60", "60>"]);
const labelGadgets = ref([
    "Desktop Computer",
    "Tablet",
    "Laptop",
    "Smartphone",
]);

const labelConnection = ref([
    "Constant high-speed connection",
    "Constant but low-speed or unstable connection",
    "Buy load as needed",
    "Connect through providers outside household",
    "No internet at all",
]);
</script>

<template>
    <div class="mt-10">
        <h1>Business Starters</h1>

        <v-row class="mt-5">
            <v-col>
                <h4 class="text-secondary">
                    <p>Gender</p>
                </h4>
                <Pie
                    :labels="labelGender"
                    :name="'siyb-client-gender'"
                    :values="totalTOE"
                    class="mt-10"
                />
            </v-col>
            <v-col>
                <h4 class="text-secondary">
                    <p>Age</p>
                </h4>
                <Pie
                    :labels="labelAge"
                    :name="'siyb-client-age'"
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
</template>
