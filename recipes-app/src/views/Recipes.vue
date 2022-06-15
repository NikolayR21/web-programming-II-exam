<!-- eslint-disable -->
<template>
  <div class="container">
    <div class="search">
      <form method="get">
        <div>
          <i class="fa-solid fa-magnifying-glass icon"></i>
          <input
            type="text"
            name="search"
            class="search-bar"
            id="search"
            placeholder="Search for a recipe..."
          />
        </div>
      </form>
      <button @click="filtersOpen = !filtersOpen" class="filters">
        {{ filtersOpen ? "Cancel" : "Filters" }}
      </button>
    </div>
    <div class="results">
      <p>{{ recipes.length }} results</p>
      <div>
        <label for="order">Order by </label>
        <select name="order" v-model="orderBy">
          <option v-for="(opt, i) in orderOptions" :key="i" :value="opt.value">
            {{ opt.name }}
          </option>
        </select>
      </div>
    </div>
    <ul class="card-wrapper">
      <li class="loader" v-if="!this.$store.state.recipe.recipesLoaded">
        <Loader />
      </li>
      <li class="item" v-for="recipe in order" :key="recipe.id">
        <router-link class="recipe-link" :to="{name: 'ViewRecipe', params: {recipeId: recipe.id}}">
        <RecipeCard
          :image="recipe.image"
          :title="recipe.title"
          :source="recipe.sourceUrl"
          :user="recipe.user"
        />
        </router-link>
      </li>
    </ul>
  </div>
</template>

<script>
/* eslint-disable */
import _ from "lodash";
import RecipeCard from "../components/RecipeCard.vue";
import Loader from "../components/Loader.vue";

export default {
  name: "Recipes",
  components: {
    RecipeCard,
    Loader,
  },
  data() {
    return {
      filtersOpen: false,
      orderOptions: [
        {
          name: "Newest",
          value: ["updated_at", "asc"],
        },
        {
          name: "Popularity",
          value: ["likes", "desc"],
        },
        {
          name: "Name ASC",
          value: ["title", "asc"],
        },
        {
          name: "Name DSC",
          target: "title",
          value: ["title", "desc"],
        },
      ],
      orderBy: ["updated_at", "asc"],
    };
  },
  methods: {},
  computed: {
    recipes() {
      return this.$store.state.recipe.recipes;
    },
    order() {
      return _.orderBy(this.recipes, this.orderBy[0], this.orderBy[1]);
    },
  },
};
</script>

<style lang="scss" scoped>
.container {
  .search {
    position: relative;

    .icon {
      position: absolute;
      top: 50%;
      left: 1rem;
      transform: translate(0, -50%);
      color: rgba(0, 0, 0, 0.56);
    }
    .search-bar {
      border: none;
      padding: 1rem;
      padding-left: 2.5rem;
      width: 100%;
      border-radius: 1.5rem;
      background-color: rgba($color: #c4c4c4, $alpha: 0.32);
    }

    .filters {
      position: absolute;
      font-size: 0.75rem;
      font-weight: bold;
      border: none;
      border-radius: 1rem;
      padding: 0.5rem 1rem;
      background: rgba($color: #80b700, $alpha: 0.48);
      right: 1.5rem;
      top: 50%;
      transform: translate(1rem, -50%);
    }
  }

  .results {
    margin: 1rem 0;
    display: flex;
    justify-content: space-between;
    align-items: center;

    select {
      border: none;
    }
  }

  .card-wrapper {
    list-style: none;
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
    justify-content: space-between;

    .recipe-link{
      text-decoration: none;
      color: #000;
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
}
</style>