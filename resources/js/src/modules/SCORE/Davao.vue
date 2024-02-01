<script setup>
import EmployeeTurnOver from "./davao/priority/1/WiseChart.vue";
import Accident from "./davao/priority/4/WiseChart.vue";
import RejectRate from "./davao/priority/5/WiseChart.vue";
import ImproveWorkerFacility from "./davao/priority/9/WiseChart.vue";
import ImproveSocialSecurity from "./davao/priority/11/WiseChart.vue";
import PowerEfficiency from "./davao/priority/12/WiseChart.vue";
import AbsentesmRate from "./davao/priority/14/WiseChart.vue";
import MachineBreakdown from "./davao/priority/17/WiseChart.vue";
import OntimeDelivery from "./davao/priority/19/WiseChart.vue";
import TrainingHours from "./davao/not-priority/2/WiseChart.vue";
import EmployeeSuggestionIdea from "./davao/not-priority/3/WiseChart.vue";
import Rework from "./davao/not-priority/6/WiseChart.vue";
import EquipmenLabel from "./davao/not-priority/7/WiseChart.vue";
import ProtectiveEquipmentPurchase from "./davao/not-priority/8/WiseChart.vue";
import ImproveCommunicationTools from "./davao/not-priority/10/WiseChart.vue";
import EmployeeMinimumWage from "./davao/not-priority/13/WiseChart.vue";
import NumberOfWorkerIncrease from "./davao/not-priority/15/WiseChart.vue";
import FiveSAudit from "./davao/not-priority/16/WiseChart.vue";
import SquareMeterFreed from "./davao/not-priority/18/WiseChart.vue";
import WaterCost from "./davao/not-priority/20/WiseChart.vue";

</script>

<template>
    <admin>
        <metatag :title="'Wise Activity'"></metatag>

        <page-header>
            <template v-slot:title>Davao</template>
        </page-header>

        <v-card class="score-bg">
            <v-container fluid>
                <!-- 1, 4, 5 -->
                    <v-row class="mt-5">
                        <v-col cols="12" md="4">
                            <v-card class="pa-5">
                                <div class="chart-title-score mb-8">
                                    <h4>Employee Turn Over (Decrease in %)</h4>
                                </div>
                                <EmployeeTurnOver />
                            </v-card>
                        </v-col>
                        <v-col cols="12" md="4">
                            <v-card class="pa-5">
                                <div class="chart-title-score mb-8">
                                    <h4>Accident (decrease in %)</h4>
                                </div>
                                <Accident />
                            </v-card>
                        </v-col>
                        <v-col cols="12" md="4">
                            <v-card class="pa-5">
                                <div class="chart-title-score mb-8">
                                    <h4>Reject rate (decrease in %)</h4>
                                </div>
                                <RejectRate />
                            </v-card>
                        </v-col>
                    </v-row>

                    <!-- 9, 11, 12 -->
                    <v-row class="mt-5">
                        <v-col cols="12" md="4">
                            <v-card class="pa-5">
                                <div class="chart-title-score mb-8">
                                    <h4>Improve worker facility (in %)</h4>
                                </div>
                                <ImproveWorkerFacility />
                            </v-card>
                        </v-col>
                        <v-col cols="12" md="4">
                            <v-card class="pa-5">
                                <div class="chart-title-score mb-8">
                                    <h4>Improve Social security (contract, health,etc in %)</h4>
                                </div>
                                <ImproveSocialSecurity />
                            </v-card>
                        </v-col>
                        <v-col cols="12" md="4">
                            <v-card class="pa-5">
                                <div class="chart-title-score mb-8">
                                    <h4>Power Efficiency (in %)</h4>
                                </div>
                                <PowerEfficiency />
                            </v-card>
                        </v-col>
                    </v-row>

                    <!-- 14, 17, 19 -->
                    <v-row class="mt-5">
                        <v-col cols="12" md="4">
                            <v-card class="pa-5">
                                <div class="chart-title-score mb-8">
                                    <h4>Absentesm rate (decrease in %)</h4>
                                </div>
                                <AbsentesmRate />
                            </v-card>
                        </v-col>
                        <v-col cols="12" md="4">
                            <v-card class="pa-5">
                                <div class="chart-title-score mb-8">
                                    <h4>Machine breakdown (in %)</h4>
                                </div>
                                <MachineBreakdown />
                            </v-card>
                        </v-col>
                        <v-col cols="12" md="4">
                            <v-card class="pa-5">
                                <div class="chart-title-score mb-8">
                                    <h4>Ontime delivery</h4>
                                </div>
                                <OntimeDelivery />
                            </v-card>
                        </v-col>
                    </v-row>


                    <!-- Non prio 2, 3, 6 -->
                    <v-row class="mt-5">
                        <v-col cols="12" md="4">
                            <v-card class="pa-5">
                                <div class="chart-title-score mb-8">
                                    <h4>Training hours (increase in %)</h4>
                                </div>
                                <TrainingHours />
                            </v-card>
                        </v-col>
                        <v-col cols="12" md="4">
                            <v-card class="pa-5">
                                <div class="chart-title-score mb-8">
                                    <h4>Employee Suggestion Idea (in number)</h4>
                                </div>
                                <EmployeeSuggestionIdea />
                            </v-card>
                        </v-col>
                        <v-col cols="12" md="4">
                            <v-card class="pa-5">
                                <div class="chart-title-score mb-8">
                                    <h4>Rework (decrease in %)</h4>
                                </div>
                                <Rework />
                            </v-card>
                        </v-col>
                    </v-row>

                    <!-- Non prio 7, 8, 10 -->
                    <v-row class="mt-5">
                        <v-col cols="12" md="4">
                            <v-card class="pa-5">
                                <div class="chart-title-score mb-8">
                                    <h4>Equipment label (5S in number)</h4>
                                </div>
                                <EquipmenLabel />
                            </v-card>
                        </v-col>
                        <v-col cols="12" md="4">
                            <v-card class="pa-5">
                                <div class="chart-title-score mb-8">
                                    <h4>Protective Equipment Purchase (in number)</h4>
                                </div>
                                <ProtectiveEquipmentPurchase />
                            </v-card>
                        </v-col>
                        <v-col cols="12" md="4">
                            <v-card class="pa-5">
                                <div class="chart-title-score mb-8">
                                    <h4>Improve communication tools (in %)</h4>
                                </div>
                                <ImproveCommunicationTools />
                            </v-card>
                        </v-col>
                    </v-row>

                    <!-- Non prio 13, 15, 16 -->
                    <v-row class="mt-5">
                        <v-col cols="12" md="4">
                            <v-card class="pa-5">
                                <div class="chart-title-score mb-8">
                                    <h4>Employee Minimum Wage (in %)</h4>
                                </div>
                                <EmployeeMinimumWage />
                            </v-card>
                        </v-col>
                        <v-col cols="12" md="4">
                            <v-card class="pa-5">
                                <div class="chart-title-score mb-8">
                                    <h4>Number of worker increase (in number)</h4>
                                </div>
                                <NumberOfWorkerIncrease />
                            </v-card>
                        </v-col>
                        <v-col cols="12" md="4">
                            <v-card class="pa-5">
                                <div class="chart-title-score mb-8">
                                    <h4>5S Audit (increase in %)</h4>
                                </div>
                                <FiveSAudit />
                            </v-card>
                        </v-col>
                    </v-row>

                    <!-- Non prio 18, 20 -->
                    <v-row class="mt-5">
                        <v-col cols="12" md="4">
                            <v-card class="pa-5">
                                <div class="chart-title-score mb-8">
                                    <h4>Square meter freed (after 5s, in m2)</h4>
                                </div>
                                <SquareMeterFreed />
                            </v-card>
                        </v-col>
                        <v-col cols="12" md="4">
                            <v-card class="pa-5">
                                <div class="chart-title-score mb-8">
                                    <h4>Water cost</h4>
                                </div>
                                <WaterCost />
                            </v-card>
                        </v-col>
                    </v-row>

            </v-container>
        </v-card>
    </admin>
</template>
