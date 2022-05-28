<template>
  <nav class="nav-container">
      <ul v-if="currentRouteName === `HomeRecipes`||'HomeVideos'" class="nav-links">
        <router-link class="link" :to="{name: 'HomeRecipes'}">Recipes</router-link>
        <router-link class="link" :to="{name: 'HomeVideos'}">Videos</router-link>
      </ul>
  </nav>
</template>

<script>
export default {
    name: "NavigationTop",
    computed: {
    currentRouteName() {
      return this.$route.name;
    }
}
}
</script>

<style lang="scss" scoped>
.nav-container{
  position: sticky;
  top: 0;
  z-index: 100;
  background: #fff;
  box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.08);
  
  .nav-links{
    display: flex;

    .link{
      display: flex;
      justify-content: center;
      align-items: center;
      width: 100%;
      font-weight: bold;
      text-decoration: none;
      color: rgba($color: #000000, $alpha: .48);
      max-height: 3rem;
      min-height: 3rem;

      &.router-link-exact-active{
        color: #000;
        box-shadow: inset 0 -4px 0 rgba($color: #80B700, $alpha: .48);
      }
    }
  }
}

</style>