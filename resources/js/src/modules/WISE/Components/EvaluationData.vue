<script setup>
import { defineProps } from "vue";

defineProps(["values"]);
</script>

<template>
    <div class="mt-10">
        <h3 class="text-tertiary-color">OSH Knowledge Assessment</h3>
        <p>
            The percentage of workers reporting an improved understanding of
            their rights and duties related to OSH issues.
        </p>
        <v-row class="mt-5">
            <v-col>
                <v-card class="pa-5">
                    <div class="chart-title">
                        <p>The training objectives were met</p>
                    </div>
                    <Bar
                        :name="'evaluation-chart-1'"
                        :values="values.first_question"
                    />
                </v-card>
            </v-col>
            <v-col>
                <v-card class="pa-5">
                    <div class="chart-title">
                        <p>
                            As an employer, I have an improved understanding of
                            my legal duties and responsibilities related to OSH.
                        </p>
                    </div>
                    <Bar
                        :name="'evaluation-chart-2'"
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
                            As a worker, I have an improved understanding of my
                            legal duties and responsibilities related to OSH.
                        </p>
                    </div>
                    <Bar
                        :name="'evaluation-chart-3'"
                        :values="values.third_question"
                    />
                </v-card>
            </v-col>
            <v-col>
                <v-card class="pa-5">
                    <div class="chart-title">
                        <p>
                            I have learned how to conduct hazard and risk
                            assessment.
                        </p>
                    </div>

                    <Bar
                        :name="'evaluation-chart-4'"
                        :values="values.fourth_question"
                    />
                </v-card>
            </v-col>
        </v-row>
        <v-row class="mt-5">
            <v-col>
                <v-card class="pa-5">
                    <div class="chart-title">
                        <p>
                            I have acquired new knowledge on how to prevent and
                            mitigate COVID-19 and other health hazards in the
                            workplace.
                        </p>
                    </div>
                    <Bar
                        :name="'evaluation-chart-5'"
                        :values="values.fifth_question"
                    />
                </v-card>
            </v-col>
            <v-col>
                <v-card class="pa-5">
                    <div class="chart-title">
                        <p>
                            I will recommend this training to other MSMEs and
                            informal business.
                        </p>
                    </div>
                    <Bar
                        :name="'evaluation-chart-6'"
                        :values="values.sixth_question"
                    />
                </v-card>
            </v-col>
        </v-row>
    </div>
</template>
