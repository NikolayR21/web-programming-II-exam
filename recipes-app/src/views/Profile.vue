<!-- eslint-disable -->
<template>
  <div class="container">Profile</div>
</template>

<script>
/* eslint-disable */
export default {
  name: 'Profile',
  data(){
    return{
    }
  },
  methods: {

  },
  computed:{
    
  },
  beforeCreate(){
    if(!this.$store.state.user){
      this.$router.push({ name: 'Login' })
    }
  }
  
  
}
</script>

<style lang="scss" scoped>

</style>