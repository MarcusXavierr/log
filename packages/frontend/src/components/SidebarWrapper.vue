<template>
  <aside class="drawer drawer-mobile" data-theme="light">
    <input id="sidebar" type="checkbox" class="drawer-toggle" />
    <div class="drawer-content p-4">
      <label for="sidebar" class="btn btn-primary drawer-button lg:hidden">Open drawer</label>
      <slot>Void</slot>
    </div>
    <FilterSidebar />
  </aside>
</template>

<script lang="ts">
import FilterSidebar from '@/components/FilterSidebar.vue'
import { mapActions } from 'vuex'
export default {
  name: 'SidebarWrapper',
  components: {
    FilterSidebar
  },
  methods: {
    ...mapActions(['getDashboardData'])
  },
  mounted() {
    this.getDashboardData()
  }
}
</script>
