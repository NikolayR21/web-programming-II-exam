<!-- eslint-disable -->
<template>
  <nav class="nav-container">
    <ul class="nav-links">
      <router-link class="link" :to="{name: 'HomeRecipes'}"><i class="fa-solid fa-house icon"></i>Home</router-link>
      <router-link class="link" :to="{name: 'Recipes'}"><i class="fa-solid fa-list icon"></i>Recipes</router-link>
      <router-link class="link" :to="{name: 'Shopping'}"><i class="fa-solid fa-cart-shopping icon"></i>Shopping</router-link>
      <router-link class="link" :to="{name: 'Profile'}"><i class="fa-solid fa-user icon"></i>Profile</router-link>
    </ul>
  </nav>
</template>

<script>
/* eslint-disable */
export default {
  name: "Navigation",
  components: {
  }
};
</script>

<style lang="scss" scoped>
  .nav-container{
    //padding: 0 1rem;
    width: 100%;
    position: sticky;
    background: #fff;
    bottom: 0;
    left: 0;
    box-shadow: 0px -2px 4px rgba(0, 0, 0, 0.08);
    max-height: 3.5rem;
    min-height: 3.5rem;

    .nav-links{
      display: flex;
      justify-content: center;
      align-items: center;
      flex: 1;
      width: 100%;

      .link{
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: .5rem 0;
        width: 100%;
        text-align: center;
        text-decoration: none;
        font-size: 12px;
        font-weight: 400;
        color: rgba($color: #000000, $alpha: .48);

        &.router-link-exact-active {
          color: #80B700;

          .icon{
          fill: #80B700;

          }
        }

        .icon{
          fill: rgba($color: #000000, $alpha: .48);
          font-size: 1rem;
          margin: .25rem 0;
          height: auto;
        }
      }
    }
  }
</style>