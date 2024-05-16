<template>
  <div>
    <h1>My Component</h1>
    <div id="c3-chart"></div>
  </div>
</template>

<script>
import * as c3 from 'c3';

export default {
  data() {
    return {
      data: []
    };
  },
  mounted() {
    this.fetchData();
  },
  methods: {
    async fetchData() {
      try {
        const response = await fetch('http://localhost:81/api/products/1459/feedback');
        if (response.ok) {
          this.data = await response.json();
          this.renderChart();
        } else {
          console.error('Error fetching data:', await response.text());
        }
      } catch (error) {
        console.error('Error fetching data:', error);
      }
    },
    renderChart() {
      const startDate = new Date(Math.min(...this.data.map(item => new Date(item.recordDate))));
      const endDate = new Date(Math.max(...this.data.map(item => new Date(item.recordDate))));

      const feedbackCounts = {};
      while (startDate <= endDate) {
        const dateStr = startDate.toISOString().split('T')[0];
        feedbackCounts[dateStr] = 0;
        startDate.setDate(startDate.getDate() + 1);
      }

      this.data.forEach(item => {
        const dateStr = new Date(item.recordDate).toISOString().split('T')[0];
        feedbackCounts[dateStr] = (feedbackCounts[dateStr] || 0) + item.feedback_count;
      });

      const chartData = Object.entries(feedbackCounts);

      const columns = [
        ['x'].concat(chartData.map(item => item[0])),
        ['feedback_count'].concat(chartData.map(item => item[1])),
      ];

      const chartElement = document.getElementById('c3-chart');
      c3.generate({
        bindto: chartElement,
        data: {
          x: 'x',
          columns: columns,
          type: 'bar'
        },
        axis: {
          x: {
            type: 'category'
          }
        }
      });
    }
  }
};
</script>

<style scoped>

</style>