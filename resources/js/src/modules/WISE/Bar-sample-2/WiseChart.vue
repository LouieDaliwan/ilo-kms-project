<template>
  <div>
    <canvas id="wise-chart2" height="40" width="70"></canvas>
  </div>
</template>

<script>
import Chart from 'chart.js/auto';
import WiseChartData from './wise-data'

export default {
  name: 'WiseChart',
    data() {
    return {
      WiseChartData: WiseChartData
    }
  },
    mounted() {
    const ctx = document.getElementById('wise-chart2');
    new Chart(ctx, this.WiseChartData);
  }
}
</script>
