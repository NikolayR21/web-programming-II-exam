<!-- eslint-disable -->
<template>
  <div class="recipe-card">
    <img :src="image" alt="">
    <div class="info">
      <h3>{{title}}</h3>
      <p v-if="source">{{source}}</p>
      <p v-if="user && !source">{{user.firstName}} {{user.lastName}}</p>
      <p>{{likes}}</p>
    </div>
  </div>
</template>

<script>
/* eslint-disable */
export default {
    name: 'RecipeCard',
    props: ['image', 'title', 'source', 'user', 'likes']
}
</script>

<style lang="scss" scoped>
  .recipe-card{
    width: 100%;
    height: 100%;

    img{
      aspect-ratio: 16/9;
      object-fit: cover;
      width: 100%;
    }

    .info{
      padding: .5rem;
      h3{
        font-size: 1rem;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;  
        overflow: hidden;
        }
      p{
        font-size: 0.85rem;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;  
        overflow: hidden;
        }
    }
  }
</style>