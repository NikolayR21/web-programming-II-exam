<template>
  <router-link class="addBtn" :to="{name: 'AddRecipe'}">
    <i class="icon fa-solid fa-plus"></i> Add
  </router-link>
</template>

<script>
export default {
    name: "RecipeAddBtn"
}
</script>

<style lang="scss" scoped>
    .addBtn{
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        width: 3.5rem;
        height: 3.5rem;
        text-decoration: none;
        font-size: 12px;
        font-weight: bold;
        position: fixed;
        border-radius: 50%;
        bottom: 4.5rem;
        right: 1rem;
        @media (min-width: 900px) {
          bottom: 12.5rem;
          right: 19.5rem;
        }
        z-index: 100;
        color: #fff;
        background: #80b700;
        .icon{
            font-size: 1.2rem;
        }
    }
</style>