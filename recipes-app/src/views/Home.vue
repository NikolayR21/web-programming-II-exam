<template>
  <div>
    <NavigationTop />
    <router-view />
  </div>
</template>

<script>
/* eslint-disable */
import NavigationTop from "../components/NavigationTop.vue"
export default {
  name: 'Home',
  components: {
    NavigationTop
  }
}
</script>

<style lang="scss" scoped>

</style>