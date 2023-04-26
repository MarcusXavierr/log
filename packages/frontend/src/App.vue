<template>
  <NavHeader />
  <SidebarWrapper>
    <DashboardGraphs v-if="!isOnDetailPage" />
    <DetailPage v-else />
  </SidebarWrapper>
</template>

<script lang="ts">
import NavHeader from './components/NavHeader.vue'
import SidebarWrapper from './components/SidebarWrapper.vue'
import DashboardGraphs from './components/DashboardGraphs.vue'
import DetailPage from './views/DetailPage.vue'
import { mapState } from 'vuex'

export default {
  name: 'App',
  components: {
    NavHeader,
    SidebarWrapper,
    DashboardGraphs,
    DetailPage
  },
  computed: {
    ...mapState(['isOnDetailPage'])
  }
}
</script>
