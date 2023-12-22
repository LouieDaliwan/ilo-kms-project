export const wiseChartData = {
    type: "bar",
    data: {
        labels: ["Male", "Female"],
        datasets: [{
          backgroundColor: "rgb(48,61,195)",
          label: "Male",
          barThickness: 40,
          data: [321, null]
        }, {
          backgroundColor: "rgb(250,60,75)",
          label: "Female",
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
        // scales: {
        //     xAxes: [{
        //         barThickness: 2,  // number (pixels) or 'flex'
        //         maxBarThickness: -100 // number (pixels)
        //     }]
        // }
      }
  };

  export default wiseChartData;
