<template>
    <div>
        <canvas :id="name" height="40" width="70"></canvas>
    </div>
</template>

<script>
import Chart from "chart.js/auto";
import { shallowRef } from "vue";

export default {
    name: "Bar",
    props: ["values", "name"],
    data() {
        return {
            chart: null,
        };
    },
    mounted() {
        this.initChart();
        this.updateChart();
    },
    watch: {
        values() {
            this.updateChart();
        },
    },
    methods: {
        updateChart() {
            this.chart.data.datasets[0].data = this.values;
            this.chart.update();
        },
        initChart() {
            const ctx = document.getElementById(this.name);
            this.chart = shallowRef(
                new Chart(ctx, {
                    type: "bar",
                    data: {
                        labels: [],
                        datasets: [
                            {
                                backgroundColor: ["rgb(48,61,195)"],
                                borderColor: ["rgb(48,61,195)"],
                                barThickness: 40,
                                borderWidth: 1,
                            },
                        ],
                    },
                    options: {
                        responsive: true,
                        lineTension: 1,
                        plugins: {
                            legend: {
                                display: false,
                            },
                        },
                    },
                }),
            );
        },
    },
};
</script>
