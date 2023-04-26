<template>
  <canvas id="pie-product-revenue-chart"></canvas>
</template>

<script lang="ts">
import Chart from 'chart.js/auto'
export default {
  name: 'PieProductRevenueGraph',
  props: {
    label: {
      type: String,
      required: true
    },
    names: {
      type: Array,
      required: true
    },
    data: {
      required: true
    }
  },
  mounted() {
    const ctx = document.getElementById('pie-product-revenue-chart') as any
    new Chart(ctx, {
      type: 'pie',
      data: {
        labels: this.names,
        datasets: [
          {
            label: this.label,
            data: this.data,
            borderWidth: 1
          }
        ]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    })
  }
}
</script>
