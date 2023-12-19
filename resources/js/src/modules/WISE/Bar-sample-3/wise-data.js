export const wiseChartData = {
    type: "bar",
    data: {
      labels: ["Strongly Agree", "", "", "", "Strongly Disagree"],
      datasets: [{
        // label: 'My First Dataset',
        data: [65, 59, 80, 81, 56],
        backgroundColor: [
          'rgb(48,61,195)'
        ],
        borderColor: [
          'rgb(48,61,195)'
        ],
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
  };

  export default wiseChartData;
