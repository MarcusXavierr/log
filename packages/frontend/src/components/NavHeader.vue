<template>
  <nav class="bg-primary">
    <img :src="logo" alt="a beautiful logo"/>
  </nav>
</template>

<script lang="ts">
import logo from '../assets/logo.svg'

export default {
  name: 'NavHeader',
  data() {
    return {
      logo
    }
  }
}
</script>

<style scoped>
nav {
  padding: 1rem;
  display: flex;
  justify-content: center;
}
</style>
