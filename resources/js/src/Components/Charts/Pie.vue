<template>
    <div>
        <!-- <canvas width="300" height="300" id="pie-chart"></canvas> -->
        <canvas
            id="pie-chart"
            height="50"
            options="{options}"
            width="50"
        ></canvas>
    </div>
</template>

<script>
import Chart from "chart.js/auto";

export default {
    name: "WiseChart",

    props: ["values", "labels"],
    data() {
        return {
            WiseChartData: {
                type: "pie",
                data: {
                    labels: this.labels,
                    datasets: [
                        {
                            label: "My First Dataset",
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
                        },
                    },
                },
            },
        };
    },
    // mounted() {
    //     const ctx = document.getElementById("pie-chart");
    //     new Chart(ctx, this.WiseChartData);
    // },
    watch: {
        values(val) {
            this.WiseChartData.data.datasets[0].data = val;
            this.WiseChartData.data.labels = this.labels;
            const ctx = document.getElementById("pie-chart");
            new Chart(ctx, this.WiseChartData);
        },
    },
};
</script>
