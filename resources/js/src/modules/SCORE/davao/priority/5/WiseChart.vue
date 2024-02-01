<template>
  <div>
    <canvas id="davao-5"></canvas>
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
    const ctx = document.getElementById('davao-5');
    new Chart(ctx, this.WiseChartData);
  }
}
</script>
