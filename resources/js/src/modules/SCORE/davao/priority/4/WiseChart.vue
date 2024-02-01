<template>
  <div>
    <canvas id="davao-4"></canvas>
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
    const ctx = document.getElementById('davao-4');
    new Chart(ctx, this.WiseChartData);
  }
}
</script>
