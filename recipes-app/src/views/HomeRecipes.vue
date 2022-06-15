<!-- eslint-disable -->
<template>
  <div class="container">
    <h2>Most Popular</h2>
    <ul class="card-wrapper">
      <li class="loader" v-if="!this.$store.state.recipe.recipesLoaded">
        <Loader />
      </li>
      <li class="item" v-for="recipe in recipes" :key="recipe.id">
        <RecipeCard
          :image="recipe.image"
          :title="recipe.title"
          :source="recipe.sourceUrl"
          :user="recipe.user"
          :likes="recipe.likes"
        />
      </li>
    </ul>
  </div>
</template>

<script>
/* eslint-disable */
import RecipeCard from "../components/RecipeCard.vue";
import Loader from "../components/Loader.vue";

export default {
  name: "HomeRecipes",
  components: {
    RecipeCard,
    Loader
  },
  computed: {
    recipes() {
      const recipes = this.$store.state.recipe.recipes;
      return _.orderBy(recipes, "likes", "desc");
    },
  },
};
</script>

<style lang="scss" scoped>
h2 {
  margin-bottom: 1rem;
}
.card-wrapper {
  list-style: none;
  display: flex;
  flex-wrap: wrap;
  gap: 1rem;
  justify-content: space-between;

  .loader{
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 5rem;
    height: 5rem;
  }

  .item {
    overflow: hidden;
    width: calc(50% - 0.5rem);
    border-radius: 4px;
    box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.16);

    display: flex;
    flex-direction: column;
  }
}
</style>