<template>
  <div class="drawer-side">
    <label for="sidebar" class="drawer-overlay"></label>
    <ul class="menu p-6 w-80 bg-base-100 text-base-content flex flex-col gap-4">
      <h3 class="text-2xl">Filtros</h3>
      <div>
        <label for="">Nome do produto</label>
        <input
          type="text"
          class="input input-bordered w-full max-w-xs"
          v-model="filter.productName"
        />
      </div>
      <div class="flex flex-col gap-1">
        <label for="">Região</label>
        <div v-for="region in filter.regions" :key="region.value">
          <div class="box-input">
            <input
              type="checkbox"
              class="checkbox"
              v-model="region.checked"
              :id="region.value"
            />
            <span>{{ region.name }}</span>
          </div>
        </div>
      </div>

      <div>
        <label for=""> Data de criação </label>
        <Datepicker
          v-model="filter.date"
          range
          locale="pt-BR"
          cancel-text="Cancelar"
          select-text="Selecionar"
          :enable-time-picker="false"
        />
      </div>

      <div class="p-2">
        <label for="">Range de preços</label>
        <VueSlider v-model="filter.priceRange" />
      </div>

      <div class="flex gap-4 justify-between">
        <button class="btn" @click="clearFilter()">Limpar filtros</button>
        <button class="btn btn-primary" @click="setFilter()">Setar Filtro</button>
      </div>
    </ul>
  </div>
</template>

<script lang="ts">
import Datepicker from '@vuepic/vue-datepicker'
import '@vuepic/vue-datepicker/dist/main.css'
import VueSlider from 'vue-slider-component'
import 'vue-slider-component/theme/antd.css'
import moment from 'moment'
import { mapActions, mapMutations } from 'vuex'

export default {
  name: 'FilterSidebar',
  components: {
    Datepicker,
    VueSlider
  },
  data() {
    return {
      filter: {
        date: null,
        priceRange: [1, 100],
        productName: '',
        regions: [
          { name: 'Norte', value: 'N', checked: false },
          { name: 'Nordeste', value: 'NE', checked: false },
          { name: 'Centro-Oeste', value: 'CO', checked: false },
          { name: 'Sudeste', value: 'SE', checked: false },
          { name: 'Sul', value: 'S', checked: false }
        ]
      }
    }
  },
  methods: {
    ...mapActions([ 'getDashboardData' ]),
    ...mapMutations([ 'clearStoreFilter', 'setStoreFilter' ]),
    clearFilter() {
      this.filter.date = null
      this.filter.priceRange = [1, 100]
      this.filter.productName = ''
      this.filter.regions = this.filter.regions.map(region => ({ ...region, checked: false }))
      this.clearStoreFilter()
    },
    setFilter() {
      const [startDate, endDate] = this.getFormatedDate()
      const [minPrice, maxPrice] = this.getFormatedPriceRange()
      const regions = this.getFormatedRegions()

      this.setStoreFilter({ productName: this.filter.productName, startDate, endDate, minPrice, maxPrice, regions })
      this.getDashboardData()
    },
    getFormatedDate() {
      if (!this.filter.date) {
        return [null, null]
      }

      const startDate = moment(this.filter.date[0]).format('Y-MM-D')
      const endDate = moment(this.filter.date[1]).format('Y-MM-D')

      return [startDate, endDate]
    },
    getFormatedRegions() {
        return this.filter.regions.filter(region => region.checked).map(region => region.value)
    },
    getFormatedPriceRange() {
      return [this.filter.priceRange[0] * 100, this.filter.priceRange[1] * 100]
    }
  }
}
</script>

<style scoped>
.box-input {
  display: flex;
  gap: 1rem;
  align-items: center;
}
</style>
