<script setup>
import { defineProps } from "vue";

defineProps(["values"]);
</script>

<template>
    <div class="mt-10">
        <h3 class="text-tertiary-color">SCORE Assessment</h3>
        <p>
            The percentage of workers reporting an improved understanding of
            their rights and duties related to OSH issues.
        </p>

        <div class="mt-15">
            <v-row class="mt-5">
                <v-col>
                    <h4 class="text-secondary">Sector</h4>
                    <Pie :labels="['Test1', 'Test2', 'Test3']" class="mt-10" />
                </v-col>
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
                        <p>
                            I know my legal duties and responsibilities related
                            to OSH as an employer
                        </p>
                    </div>
                    <Bar
                        :name="'indicator-one-chart-1'"
                        :values="values.first_question"
                    />
                </v-card>
            </v-col>
            <v-col>
                <v-card class="pa-5">
                    <div class="chart-title">
                        <p>
                            I am able to carry out my legal duties and
                            responsibilities related to OSH as an employer
                        </p>
                    </div>
                    <Bar
                        :name="'indicator-one-chart-2'"
                        :values="values.second_question"
                    />
                </v-card>
            </v-col>
        </v-row>
        <v-row class="mt-5">
            <v-col>
                <v-card class="pa-5">
                    <div class="chart-title">
                        <p>
                            Can you note any concrete example(s) of an
                            initiative you took towards better execution of your
                            OSH-related duties/responsibilities as an employer
                            in the last two years?
                        </p>
                    </div>
                    <Bar
                        :name="'indicator-one-chart-3'"
                        :values="values.third_question"
                    />
                </v-card>
            </v-col>
        </v-row>
    </div>
</template>
