<template>
  <h2 class="text-4xl text-center">Página de detalhamento dos produtos</h2>
  <button class="btn btn-primary" @click="goToDashboard()">Voltar para o dashboard</button>
  <div class="overflow-x-auto">
    <table class="table w-full">
      <!-- head -->
      <thead>
        <tr>
          <th>Nome</th>
          <th>Preço</th>
          <th>Unidades vendidas</th>
          <th>Total Vendido</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="product in productsData" :key="product.id">
          <td>{{ product.name }}</td>
          <td>R${{ product.price / 100 }}</td>
          <td>{{ product.units_sold }}</td>
          <td>R${{ product.total_revenue }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script lang="ts">
import { mapState, mapActions, mapMutations } from 'vuex'
export default {
  name: 'DetailPage',
  data() {
    return {
      productsData: [] as any[]
    }
  },
  computed: {
    ...mapState(['filter'])
  },
  methods: {
    ...mapActions(['getProductsDetails']),
    ...mapMutations(['goToDashboard']),
    populateTable(response: any) {
      this.productsData = response.data.data
    }
  },
  watch: {
    filter: {
      handler() {
        this.getProductsDetails().then(this.populateTable)
      },
      deep: true,
      immediate: true
    }
  }
}
</script>
