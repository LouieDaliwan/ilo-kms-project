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
    data() {
        return {
            WiseChartData: {
                type: "pie",
                data: {
                    labels: [
                        "Agriculture",
                        "Manufacturing",
                        "Small Construction",
                        "Services",
                        "Others",
                    ],
                    datasets: [
                        {
                            label: "My First Dataset",
                            data: [50, 25, 25, 25, 25],
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
    mounted() {
        const ctx = document.getElementById("pie-chart");
        new Chart(ctx, this.WiseChartData);
    },
};
</script>
