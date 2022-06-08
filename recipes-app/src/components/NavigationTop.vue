<template>
  <nav class="nav-container">
    <ul
      v-if="currentRouteName === 'Login' || currentRouteName === 'Register'"
      class="back"
    >
      <router-link :to="{ name: 'HomeRecipes' }" class="link"
        ><i class="icon fa-solid fa-chevron-left"></i
      ></router-link>
      <p>{{ currentRouteName }}</p>
    </ul>
    <ul v-else class="nav-links">
      <router-link class="link" :to="{ name: 'HomeRecipes' }"
        >Recipes</router-link
      >
      <router-link class="link" :to="{ name: 'HomeVideos' }"
        >Videos</router-link
      >
    </ul>
  </nav>
</template>

<script>
export default {
  name: "NavigationTop",
  data() {
    return {};
  },
  computed: {
    currentRouteName() {
      return this.$route.name;
    },
  },
};
</script>

<style lang="scss" scoped>
.nav-container {
  position: sticky;
  top: 0;
  z-index: 100;
  background: #fff;
  box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.08);

  .back {
    margin: -1rem -1rem 0;
    padding: 1rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: inset 0 -4px 0 rgba($color: #80b700, $alpha: 0.48);
    max-height: 3rem;
    min-height: 3rem;
    color: #000;
    font-weight: bold;

    .link {
      .icon {
        color: #000;
        font-size: 1.5rem;
      }
    }
    p {
      margin: 0 auto;
    }
  }

  .nav-links {
    display: flex;

    .link {
      display: flex;
      justify-content: center;
      align-items: center;
      width: 100%;
      font-weight: bold;
      text-decoration: none;
      color: rgba($color: #000000, $alpha: 0.48);
      max-height: 3rem;
      min-height: 3rem;

      &.router-link-exact-active {
        color: #000;
        box-shadow: inset 0 -4px 0 rgba($color: #80b700, $alpha: 0.48);
      }
    }
  }
}
</style>