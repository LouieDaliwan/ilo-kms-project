<script setup>
import { ref } from "vue";

const businessStart = ref({
    Yes: 20,
    No: 30,
});
</script>

<template>
    <div class="mt-10">
        <h1>Business Starters</h1>

        <v-row class="mt-5">
            <v-col>
                <h4>Do you have a concrete and feasible business idea</h4>
                <Bar :name="'starters-1'" :values="businessStart" />
            </v-col>

            <v-col>
                <h4>Do you have a business plan</h4>
                <Bar :name="'starters-2'" :values="businessStart" />
            </v-col>
        </v-row>

        <v-row class="mt-5">
            <v-col>
                <h4>Have you sold anything online?</h4>
                <Bar :name="'starters-3'" :values="businessStart" />
            </v-col>

            <v-col>
                <h4>
                    In your new business to be started, do you plan to sell
                    online?
                </h4>
                <Bar :name="'starters-4'" :values="businessStart" />
            </v-col>
        </v-row>

        <v-row class="mt-5">
            <v-col>
                <h4>
                    In your new business to be started, do you plan to use
                    e-wallets and digital financial services?
                </h4>
                <Bar :name="'starters-5'" :values="businessStart" />
            </v-col>

            <v-col>
                <h4>
                    In your new business to be started, do you plan to use
                    digital tools/apps to manage the business operations?
                </h4>
                <Bar :name="'starters-6'" :values="businessStart" />
            </v-col>
        </v-row>
    </div>
</template>
