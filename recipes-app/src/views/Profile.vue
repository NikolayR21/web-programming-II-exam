<!-- eslint-disable -->
<template>
  <div class="container">
    <div class="profile">
      <div class="profile-card">
        <img src="" alt="">

      </div>
      <ul>
        <router-link to="#">My recipes</router-link>
        <router-link to="#">Saved recipes</router-link>
      </ul>
    </div>
    <div class="options">
      <ul>
        <router-link to="#">Edit</router-link>
        <li @click.prevent="logout">Log out</li>
      </ul>
    </div>
  </div>
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
    async logout(){
      this.$store.dispatch('logout')
      .catch((err) => {
        console.log(err)
      })
    }
  },
  computed:{

  },
  watch: {
    
  },
  beforeCreate(){
    if(!this.$store.state.user.authenticated &&
      !this.$store.state.user.user && 
      !window.localStorage.getItem('token')){
      this.$router.push({ name: 'Login' })
    }
  }
  
  
}
</script>

<style lang="scss" scoped>
.contaier{
  display: flex;
  flex-direction: column;
  justify-content: space-between;

  .profile{

  }
  .options{
    
  }
}
</style>