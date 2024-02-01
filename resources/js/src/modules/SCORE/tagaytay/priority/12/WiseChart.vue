<template>
  <div>
    <canvas id="tagaytay-12"></canvas>
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
    const ctx = document.getElementById('tagaytay-12');
    new Chart(ctx, this.WiseChartData);
  }
}
</script>
