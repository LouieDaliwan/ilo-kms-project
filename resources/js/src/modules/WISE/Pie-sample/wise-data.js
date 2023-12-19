export const wiseChartData = {
    type: "pie",
    data: {
      labels: ["Agriculture", "Manufacturing", "Small Construction", "Services", "Others"],
      datasets: [{
        // label: 'My First Dataset',
        data: [65, 59, 80, 81, 56],
        backgroundColor: [
          'rgb(48,61,195)',
          'rgb(255, 99, 132)',
          'rgb(54, 162, 235)',
          'rgb(255, 205, 86)',
          'rgba(255, 99, 132, 0.2)'
        ],
        borderColor: [
            'rgb(48,61,195)',
            'rgb(255, 99, 132)',
            'rgb(54, 162, 235)',
            'rgb(255, 205, 86)',
            'rgba(255, 99, 132, 0.2)'
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
    //   plugins: {
    //     legend: {
    //         display: false
    //     },
    // }
        plugins: {
            datalabels: {
            formatter: (value, ctx) => {

                let sum = ctx.dataset._meta[0].total;
                let percentage = (value * 100 / sum).toFixed(2) + "%";
                return percentage;

            },
            color: '#fff',
            }
        }
    }
  };

  export default wiseChartData;
