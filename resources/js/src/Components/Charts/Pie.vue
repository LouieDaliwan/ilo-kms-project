<script>
import Chart from "chart.js/auto";
import { shallowRef } from "vue";

export default {
    name: "Pie",
    props: ["values", "labels", "name"],

    data() {
        return {
            chart: null,
        };
    },
    mounted() {
        this.initChart();
    },

    watch: {
        values(val) {
            this.chart.data.datasets[0].data = this.values;
            this.chart.update();
        },
    },
    methods: {
        initChart() {
            const ctx = document.getElementById(this.name);
            this.chart = shallowRef(
                new Chart(ctx, {
                    type: "pie",
                    data: {
                        labels: this.labels,
                        datasets: [
                            {
                                data: this.values,
                                backgroundColor: [
                                    "rgb(48,61,195)",
                                    "rgba(135,233,233,255)",
                                    "rgba(140,225,100,255)",
                                    "rgba(150,10,85,255)",
                                    "rgba(250,60,75,255)",
                                ],
                                borderColor: [
                                    "rgb(48,61,195)",
                                    "rgba(135,233,233,255)",
                                    "rgba(140,225,100,255)",
                                    "rgba(150,10,85,255)",
                                    "rgba(250,60,75,255)",
                                ],
                                hoverOffset: 4,
                            },
                        ],
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                display: true,
                                position: "bottom",
                                paddingTop: 20,
                                    labels: {
                                    padding: 35,
                                    usePointStyle: true,
                                    fontFamily: "Overpass, sans-serif",
                                    },
                            },
                        },
                    },
                }),
            );
        },
    },
};
</script>
<template>
    <div>
        <canvas :id="name" height="100" width="100"></canvas>
    </div>
</template>
