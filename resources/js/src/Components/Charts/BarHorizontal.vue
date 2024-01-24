<template>
    <div>
        <canvas :id="name" height="40" width="70"></canvas>
    </div>
</template>

<script>
import Chart from "chart.js/auto";
import { shallowRef } from "vue";

export default {
    name: "BarHorizontal",
    props: ["values", "values2", "labels", "name"],
    data() {
        return {
            chart: null,
        };
    },
    mounted() {
        this.initChart();
    },
    watch: {
        values() {
            this.chart.data.datasets[0].data = this.values;
            this.chart.data.datasets[1].data = this.values2;
            this.chart.update();
        },
    },
    methods: {
        initChart() {
            const ctx = document.getElementById(this.name);
            this.chart = shallowRef(
                new Chart(ctx, {
                    type: "bar",
                    data: {
                        labels: ["DTI", "DOLE", "TESDA", "NCC"],
                        datasets: [
                            {
                                label: "Planned TOE's",
                                data: [65, 59, 80, 100],
                            },
                            {
                                label: "Conduct TOE's",
                                data: [100, 29, 82, 39],
                            },
                        ],
                    },
                    options: {
                        indexAxis: "y",
                        responsive: true,
                        lineTension: 1,
                        plugins: {
                            legend: {
                                display: true,
                                position: "right",
                            },
                        },
                        elements: {
                            bar: {
                                borderWidth: 2,
                            },
                        },
                    },
                }),
            );
        },
    },
};
</script>
