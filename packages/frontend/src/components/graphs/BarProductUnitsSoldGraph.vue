<template>
  <canvas id="bar-product-units-sold-chart"></canvas>
</template>

<script lang="ts">
import Chart from 'chart.js/auto'
export default {
  name: 'BarProductUnitsSoldGraph',
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
    const ctx = document.getElementById('bar-product-units-sold-chart') as any
    new Chart(ctx, {
      type: 'bar',
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
