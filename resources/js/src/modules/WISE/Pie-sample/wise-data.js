export const wiseChartData = {
    type: "pie",
    data: {
        labels: ["Agriculture", "Manufacturing", "Small Construction", "Services", "Others"],
        datasets: [{
          label: 'My First Dataset',
          data: [50, 25, 25, 25, 25],
        backgroundColor: [
          'rgb(48,61,195)',
          'rgba(135,233,233,255)',
          'rgba(140,225,100,255)',
          'rgba(150,10,85,255)',
          'rgba(250,60,75,255)'
        ],
        borderColor: [
            'rgb(48,61,195)',
            'rgba(135,233,233,255)',
            'rgba(140,225,100,255)',
            'rgba(150,10,85,255)',
            'rgba(250,60,75,255)'
        ],
          hoverOffset: 4
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: {
              display: true,
              position: 'bottom'
          },
        }
      }
  };

  export default wiseChartData;
