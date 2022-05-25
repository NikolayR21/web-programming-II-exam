<template>
  <div>
    <nav class="nav-container">
      <ul class="nav-links">
        <router-link class="link" :to="{name: 'HomeRecipes'}">Recipes</router-link>
        <router-link class="link" :to="{name: 'HomeVideos'}">Videos</router-link>
      </ul>
    </nav>
    <router-view />
  </div>
</template>

<script>
/* eslint-disable */
export default {
  name: 'Home',
  components: {
  }
}
</script>

<style lang="scss" scoped>
.nav-container{
  position: sticky;
  top: 0;
  background: #fff;
  box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.08);
  
  .nav-links{
    position: sticky;
    top: 0;
    left: 0;
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