<script setup>
import { ref } from "vue";

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

const gender = ref([10, 30]);
const age = ref([10, 20, 30, 40, 50]);

const connection = ref({
    "Constant high-speed connection": 20,
    "Constant but low-speed or unstable connection": 30,
    "Buy load as needed": 10,
    "Connect through providers outside household": 0,
    "No internet at all": 0,
});
</script>

<template>
    <div class="mt-10">
        <h1>Entry Form</h1>

        <v-row class="mt-5">
            <v-col>
                <h4 class="text-secondary">
                    <p>Gender</p>
                </h4>
                <Pie
                    :labels="labelGender"
                    :name="'siyb-client-gender'"
                    :values="gender"
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
                    :values="age"
                    class="mt-10"
                />
            </v-col>
        </v-row>
    </div>
</template>
