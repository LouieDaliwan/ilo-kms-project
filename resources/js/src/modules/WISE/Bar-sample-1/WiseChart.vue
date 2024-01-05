<template>
    <div>
        <!-- <canvas ref="chart" height="40" width="70"></canvas> -->
        <canvas id="chart-chart" height="40" width="70"></canvas>
    </div>
</template>

<script>
import Chart from "chart.js/auto";
// import WiseChartData, { wiseChartData } from "./wise-data";
import { shallowRef } from 'vue';
import $api from "../routes/api";

export default {
    // props: ["evaluationData"],
    // name: "WiseChart",
    data() {
        return {
            // WiseChartData: WiseChartData,
            chart: null,
        };
    },
    mounted() {
        // const ctx = document.getElementById("wise-chart2");
        // new Chart(ctx, this.WiseChartData);
        this.initChart()
        this.getResources()

    },
    // watch: {
    //     evaluationData(value) {
    //         this.updateChart(_.values(value));
    //     },
    // },
    methods: {
        // updateChart(value) {
        //     this.WiseChartData.data.datasets[0].data = value;
        //     console.log("geron"+value)
        // },
        initChart() {
            const ctx = document.getElementById("chart-chart");
            // this.chart = shallowRef(new Chart(this.$refs.chart, {
            this.chart = shallowRef(new Chart(ctx, {
                    type: "bar",
                    data: {
                    // labels: ["Strongly Agree", "Agree", "Neutral", "Disagree", "Strongly Disagree"],
                    datasets: [{
                        // label: 'My First Dataset',
                        // data: [65, 59, 80, 81, 56],
                        // data: [],
                        backgroundColor: [
                        'rgb(48,61,195)'
                        ],
                        borderColor: [
                        'rgb(48,61,195)'
                        ],
                        barThickness: 40,
                        borderWidth: 1
                    }]
                    },
                    options: {
                    responsive: true,
                    lineTension: 1,
                    scales: {
                        xAxes: [{
                            maxBarThickness: 1.5
                        }],
                        yAxes: [
                        {
                            ticks: {
                            beginAtZero: true,
                            padding: 25
                            }
                        }
                        ]
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                    }
                    }
            })

            );

        },
        getResources() {
            axios
                .get($api.evaluations())
                .then((response) => {
                    if (!response.data) return;
                    // console.log(_.values(response.data.first_question))

                    this.chart.data.datasets[0].data = response.data.first_question
                    // this.initChart()
                    // this.chart.data.datasets[0].data = _.values(response.data.first_question)
                    this.chart.update();
                    // console.log(this.chart.data.datasets[0].data)


                })
                .catch((error) => {
                    console.log(error);
                })
                .finally(() => {
                    console.log("finally");

                });
        },
    },
};
</script>
