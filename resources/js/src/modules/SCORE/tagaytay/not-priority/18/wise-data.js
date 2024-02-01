export const wiseChartData = {
    type: "bar",
    data: {
        labels: ["LFSI", "Gen Trias", "Tamagdo", "Payton", "Amira's"],
        datasets: [{
          // label: 'My First Dataset',
          data: [0, 70, 0, 0, 0],
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
      plugins: {
        legend: {
            display: false
        },
    }
    }
  };

  export default wiseChartData;
