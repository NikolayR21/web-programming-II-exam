<template>
  <div class="app-wrapper">
    <div id="app">
      <AppBarTop />
      <transition name="slide">
        <router-view />
      </transition>
      <RecipeAddBtn v-if="addRecipeDisabled"/>
      <Navigation v-if="!navigationDisabled" />
    </div>
  </div>
</template>

<script>
import AppBarTop from "./components/AppBarTop.vue";
import Navigation from "./components/Navigation.vue";
import RecipeAddBtn from "./components/RecipeAddBtn.vue";

export default {
  name: "App",
  components: {
    AppBarTop,
    Navigation,
    RecipeAddBtn,
  },
  data() {
    return {
      navigationDisabled: null,
      addRecipeDisabled: null,
    };
  },
  created() {
    this.addRecipe();
    this.checkRoute();
    if (window.localStorage.getItem("token")) {
      if (!this.$store.state.user.user && !this.$store.state.user.authenticated)
        this.$store.dispatch("getProfile");
    }
    this.$store.dispatch("getRecipes");
    this.$store.dispatch("getIngredients");
  },
  methods: {
    checkRoute() {
      if (this.$route.name === "Login" || this.$route.name === "Register") {
        this.navigationDisabled = true;
        return;
      }
      this.navigationDisabled = false;
    },
    addRecipe() {
      if (this.isAuth) {
        if (
          this.$route.name === "Recipes" ||
          this.$route.name === "HomeRecipes"
        ) {
          this.addRecipeDisabled = true;
          return;
        }
      }

      this.addRecipeDisabled = false;
      return;
    },
  },
  computed: {
    isAuth(){
      return this.$store.state.user.authenticated
    }
  },
  watch: {
    $route() {
      this.checkRoute();
      this.addRecipe();
    },
  },
};
</script>

<style lang="scss">
@import url("https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&display=swap");

.overflow-hidden {
  overflow: hidden;
}

* {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
  font-family: "DM Sans", sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}

::-webkit-scrollbar {
  width: 6px;
  padding: 1px;
}
::-webkit-scrollbar-track {
  border-radius: 8px;
  background: transparent;
}
::-webkit-scrollbar-thumb {
  border-radius: 8px;
  width: 4px;
  background: #888;
}
::-webkit-scrollbar-thumb:hover {
  background: #555;
}

@media (min-width: 900px) {
  .app-wrapper {
    display: flex;
    justify-content: center;
    align-items: center;
    background: gray;
    width: 100%;
    height: 100vh;
  }

  #app {
    overflow: auto;
    width: 375px;
    height: 667px;
  }
}

#app {
  background: #fff;
  position: relative;
}

.container {
  padding: 1rem;
  min-height: calc(100vh - 7rem);

  & > h2 {
    font-size: 1.5rem;
    font-weight: bold;
  }
}

// .slide-enter-active {
//   transition: all .3s ease;
// }
// .slide-leave-active {
//   transition: all cubic-bezier(1.0, 0.5, 0.8, 1.0);
// }
// .slide-enter, .slide-leave-to {
//   transform: translateX(10px);
//   opacity: 0;
// }
</style>
