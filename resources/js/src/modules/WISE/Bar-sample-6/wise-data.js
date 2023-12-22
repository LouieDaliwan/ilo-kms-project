export const wiseChartData = {
    type: "bar",
    data: {
        labels: ["Labor", "Management"],
        datasets: [{
          backgroundColor: "rgb(48,61,195)",
          label: "Labor",
          barThickness: 40,
          data: [321, null]
        }, {
          backgroundColor: "rgb(250,60,75)",
          label: "Management",
          barThickness: 40,
          data: [null, 123]
        }]
      },
      options: {
        indexAxis: 'x',
        skipNull: true,
        plugins: {
          legend: {
            display: true,
            position: "right",
          }
        },
      }
  };

  export default wiseChartData;
