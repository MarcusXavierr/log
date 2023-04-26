<template>
  <section class="flex flex-col gap-8">
    <BarProductRevenueGraph
      chart-type="bar"
      chart-id="bar-chart"
      label="Valor de vendas por produto"
      :data="totalRevenueProducts.data"
      :names="totalRevenueProducts.labels"
      :key="chartKey"
      @click="goToDetailPage()"
    />
    <PieProductRevenueGraph
      chart-type="pie"
      chart-id="pie-chart"
      label="Valor de vendas por produto"
      :data="totalRevenueProducts.data"
      :names="totalRevenueProducts.labels"
      :key="chartKey"
      @click="goToDetailPage()"
    />
    <BarProductUnitsSoldGraph
      chart-type="bar"
      chart-id="bar-chart"
      label="Valor de vendas por produto"
      :data="totalRevenueProducts.data"
      :names="totalRevenueProducts.labels"
      :key="chartKey"
      @click="goToDetailPage()"
    />
  </section>
</template>

<script lang="ts">
import { mapActions, mapMutations, mapState } from 'vuex'
import BarProductRevenueGraph from './graphs/BarProductRevenueGraph.vue'
import BarProductUnitsSoldGraph from './graphs/BarProductUnitsSoldGraph.vue'
import PieProductRevenueGraph from './graphs/PieProductRevenueGraph.vue'

export default {
  name: 'DashboardGraphs',
  components: {
    BarProductRevenueGraph,
    PieProductRevenueGraph,
    BarProductUnitsSoldGraph
  },
  data() {
    return {
      salesData: [],
      productsData: [],
      chartKey: 1,
      chartData: {
        labels: ['January', 'February', 'March'],
        datasets: [{ data: [40, 20, 12] }]
      },
      chartOptions: {
        responsive: true
      }
    }
  },

  computed: {
    ...mapState(['filter']),
    totalRevenueProducts() {
      return {
        labels: this.productsData.map((product: any) => product.name),
        data: this.productsData.map((product: any) => product.total_revenue / 100)
      }
    },
    totalUnitsSoldPerProduct() {
      return {
        labels: this.productsData.map((product: any) => product.name),
        data: this.productsData.map((product: any) => product.units_sold)
      }
    }
  },
  methods: {
    ...mapActions(['getDashboardData']),
    ...mapMutations(['goToDetailPage']),
    populateCharts(data: any) {
      ;(this.salesData = data.sales_data), (this.productsData = data.products_data)
      this.chartKey++
    }
  },
  watch: {
    filter: {
      handler() {
        this.getDashboardData().then(this.populateCharts)
      },
      deep: true,
      immediate: true
    }
  }
}
</script>

<style></style>
