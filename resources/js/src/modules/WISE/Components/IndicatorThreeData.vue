<script setup>
import { defineProps } from "vue";

defineProps(["values"]);
</script>

<template>
    <div class="mt-10">
        <h3 class="text-tertiary-color">WISE Assessment</h3>
        <p>
            The percentage of workers reporting an improved understanding of
            their rights and duties related to OSH issues.
        </p>

        <div class="mt-15">
            <v-row class="mt-5">
                <v-col>
                    <h4 class="text-secondary">Gender</h4>
                    <Bar
                        :name="'gender_indicator_one'"
                        :values="values.gender"
                    ></Bar>
                </v-col>
            </v-row>
        </div>

        <v-row class="mt-5">
            <v-col>
                <v-card class="pa-5">
                    <div class="chart-title">
                        <p>I know my rights related to OSH</p>
                    </div>
                    <Bar
                        :name="'indicator-three-chart-1'"
                        :values="values.first_question"
                    />
                </v-card>
            </v-col>
            <v-col>
                <v-card class="pa-5">
                    <div class="chart-title">
                        <p>I know my duties related to OSH</p>
                    </div>
                    <Bar
                        :name="'indicator-three-chart-2'"
                        :values="values.second_question"
                    />
                </v-card>
            </v-col>
        </v-row>
        <v-row class="mt-5">
            <v-col>
                <v-card class="pa-5">
                    <div class="chart-title">
                        <p>I am able to use my rights related to OSH</p>
                    </div>
                    <Bar
                        :name="'indicator-three-chart-3'"
                        :values="values.third_question"
                    />
                </v-card>
            </v-col>
            <v-col>
                <v-card class="pa-5">
                    <div class="chart-title">
                        <p>I am able to carry out my duties related to OSH</p>
                    </div>
                    <Bar
                        :name="'indicator-three-chart-4'"
                        :values="values.fourth_question"
                    />
                </v-card>
            </v-col>
        </v-row>
    </div>
</template>
