<script setup>
import { onMounted, ref } from "vue";
import $api from "../routes/api.js";
import BusinessStarters from "../Components/BusinessStarters.vue";
import EntryForm from "../Components/EntryForm.vue";
import ExistingBusinessOwners from "../Components/ExistingBusinessOwners.vue";

const components = [BusinessStarters, EntryForm, ExistingBusinessOwners];

const tab = ref(null);
const dataSummary = ref(null);

const getData = async () => {
    const response = await axios.get($api.summaryClients(), {});
    dataSummary.value = await response.data;
};

onMounted(() => {
    getData();
});
</script>

<template>
    <admin>
        <metatag :title="'Client Summary'"></metatag>

        <page-header>
            <template v-slot:title>Summary Report</template>
        </page-header>

        <div class="mt-10">
            <v-tabs
                v-model="tab"
                align-tabs="center"
                color="deep-purple-accent-4"
            >
                <v-tab :value="1">Business Starters</v-tab>
                <v-tab :value="2">Entry Form</v-tab>
                <v-tab :value="3">Existing Owners</v-tab>
            </v-tabs>
            <v-window v-if="dataSummary" v-model="tab">
                <v-window-item v-for="n in 3" :key="n" :value="n">
                    <component
                        :is="components[n - 1]"
                        :dataSummary="dataSummary"
                    />
                </v-window-item>
            </v-window>
        </div>
    </admin>
</template>
