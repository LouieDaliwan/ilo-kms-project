<template>
  <div>
    <canvas id="wise-chart8"></canvas>
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
    const ctx = document.getElementById('wise-chart8');
    new Chart(ctx, this.WiseChartData);
  }
}
</script>
