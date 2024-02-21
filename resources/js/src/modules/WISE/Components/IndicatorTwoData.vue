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

        <v-row class="mt-5">
            <v-col cols="12" md="6">
                <v-card class="pa-5">
                    <div class="chart-title mb-8">
                        <p>
                            I know my legal duties and responsibilities related
                            to OSH as an employer
                        </p>
                    </div>
                    <Bar
                        :name="'indicator-two-chart-1'"
                        :values="values.first_question"
                    />
                </v-card>
            </v-col>
            <v-col cols="12" md="6">
                <v-card class="pa-5">
                    <div class="chart-title mb-8">
                        <p>
                            I am able to carry out my legal duties and
                            responsibilities related to OSH as an employer
                        </p>
                    </div>
                    <Bar
                        :name="'indicator-two-chart-2'"
                        :values="values.second_question"
                    />
                </v-card>
            </v-col>
        </v-row>
        <div class="mt-5">
            <v-row class="mt-5">
                <v-col cols="12" md="8">
                    <v-card class="pa-5">
                    <h4 class="text-secondary mb-5">Gender</h4>
                        <Bar
                            :name="'gender_indicator_two'"
                            :values="values.gender"
                        ></Bar>
                    </v-card>
                </v-col>
            </v-row>
        </div>
        <v-row class="mt-5">
            <v-col>
                <v-row>
                    <v-col cols="12" md="9">
                        <v-card class="pa-5">
                            <div class="chart-title mb-5">
                                <!-- <p>
                                    Can you note any concrete example(s) of an
                                    initiative you took towards better execution of your
                                    OSH-related duties/responsibilities as an employer
                                    in the last two years?
                                </p> -->
                                <p>
                                    Can you note any concrete example(s) of an
                                </p>
                            </div>
                                <Bar
                                    :name="'indicator-two-chart-3'"
                                    :values="values.third_question"
                                />
                        </v-card>
                    </v-col>
                </v-row>
            </v-col>
        </v-row>
    </div>
</template>
