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
            <v-col>
                <v-card class="pa-5">
                    <div class="chart-title">
                        <p>
                            The training enhanced my knowledge of the topic
                            covered
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
                            The training provided information that is relevant
                            to my work
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
                    <div class="chart-title mb-8">
                        <p>
                            The instructor provided clear information, answered
                            questions, was approachable, and encouraged
                            interaction and participation
                        </p>
                    </div>
                    <Bar
                        :name="'indicator-one-chart-3'"
                        :values="values.third_question"
                    />
                </v-card>
            </v-col>
            <v-col>
                <v-card class="pa-5">
                    <div class="chart-title mb-8">
                        <p>
                            The practical tools, learning materials and
                            takeaways shared in the training contributed to its
                            usefulness
                        </p>
                    </div>

                    <Bar
                        :name="'indicator-one-chart-4'"
                        :values="values.fourth_question"
                    />
                </v-card>
            </v-col>
        </v-row>
        <v-row class="mt-12">
            <v-col>
                <v-card class="pa-5">
                    <div class="chart-title mb-8">
                        <p>
                            I am going to use at least one of the aspects I
                            learned during the training in my work
                        </p>
                    </div>
                    <Bar
                        :name="'indicator-one-chart-5'"
                        :values="values.fifth_question"
                    />
                </v-card>
            </v-col>
            <v-col>
                <v-card class="pa-5">
                    <div class="chart-title mb-8">
                        <p>I would recommend this training to others</p>
                    </div>
                    <Bar
                        :name="'indicator-one-chart-6'"
                        :values="values.sixth_question"
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
                            :name="'gender_indicator_one'"
                            :values="values.gender"
                        ></Bar>
                    </v-card>
                </v-col>
            </v-row>
        </div>
    </div>
</template>
