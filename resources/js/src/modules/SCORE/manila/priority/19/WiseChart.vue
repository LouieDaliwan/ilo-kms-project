<template>
  <div>
    <canvas id="manila-19"></canvas>
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
    const ctx = document.getElementById('manila-19');
    new Chart(ctx, this.WiseChartData);
  }
}
</script>
