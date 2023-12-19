export const wiseChartData = {
    type: "bar",
    data: {
        labels: ["Male", "Female"],
        datasets: [{
          backgroundColor: "rgb(48,61,195)",
          label: "Male",
          data: [321, null]
        }, {
          backgroundColor: "rgb(250,60,75)",
          label: "Female",
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
