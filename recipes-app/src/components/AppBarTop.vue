<template>
  <header class="header-container">
      <img :src="logo" >
  </header>
</template>

<script>
export default {
    name: 'AppBarTop',
    data(){
        return{
            logo: require('../assets/Icons/recipes-logo.png'),
        }
    }
}
</script>

<style lang="scss" scoped>
.header-container{
    padding: 1rem 0;
    width: 100%;
    position: sticky;
    background: #fff;
    top: 0;
    left: 0;
    // box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.08);
    display: flex;
    justify-content: center;
    align-items: center;

    max-height: 3.5rem;
    min-height: 3.5rem;
}
</style>