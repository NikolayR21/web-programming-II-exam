<!-- eslint-disable -->
<template>
  <div class="container">
    <h2>Yesterday’s Most Viewed</h2>
    <div class="card-wrapper">
      <div class="item"></div>
      <div class="item"></div>
      <div class="item"></div>
      <div class="item"></div>
      <div class="item"></div>
    </div>
  </div>
</template>

<script>
/* eslint-disable */
export default {

}
</script>

<style lang="scss" scoped>
.card-wrapper{
  display: flex;
  flex-wrap: wrap;
  gap: 1rem;
  justify-content: space-between;

  .item{
    background: greenyellow;
    flex: 1 1 50%;
    height: 2rem;
  }
}
</style>