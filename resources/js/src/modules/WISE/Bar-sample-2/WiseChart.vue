<template>
    <div>
        <canvas id="wise-chart2" height="40" width="70"></canvas>
    </div>
</template>

<script>
import Chart from "chart.js/auto";
import WiseChartData from "./wise-data";

export default {
    props: ["evaluationData"],
    name: "WiseChart2",
    data() {
        return {
            WiseChartData: WiseChartData,
        };
    },
    mounted() {
        const ctx = document.getElementById("wise-chart2");
        new Chart(ctx, this.WiseChartData);
    },
    watch: {
        evaluationData(value) {
            this.updateChart(_.values(value));
        },
    },
    methods: {
        updateChart(value) {
            this.WiseChartData.data.datasets[0].data = value;
            new Chart(this.ctx, this.WiseChartData);
        },
    },
};
</script>
