<!-- eslint-disable -->
<template>
  <div class="recipe-container">
    <Loader v-if="!recipe" />
    <div v-if="recipe" class="recipe">
      <img :src="recipe.image">
      <div class="recipe-info">
        <h2>{{recipe.title}}</h2>
        <p v-if="!recipe.sourceUrl && recipe.user">{{recipe.user.firstName}} {{recipe.user.lastName}}</p>
        <a v-if="recipe.sourceUrl" :href="recipe.sourceUrl">Source: {{recipe.sourceUrl}}</a>
      </div>
    </div>
  </div>
</template>

<script>
/*eslint-disable*/
import Loader from "../components/Loader.vue";

export default {
    name: "ViewRecipe",
    components: {
      Loader
    },
    computed:{
      recipe(){
        return this.$store.state.recipe.selectedRecipe;
      },
      recipeId(){
        console.log(this.$route.params.recipeId)
        return this.$route.params.recipeId
      }
    },
    mounted(){
      this.$store.dispatch('getRecipe', this.recipeId)
    },
    beforeDestroy(){
      this.$store.dispatch('getRecipe', null)
    }
}
</script>

<style lang="scss" scoped>
.recipe-container{
  min-height: calc(100vh - 7rem);
  
  .recipe{
    width: 100%;

    img{
      aspect-ratio: 16/9;
      width: 100%;
    }

    &-info{
      padding: 1rem;
    }
  }
}
</style>