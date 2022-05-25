<!-- eslint-disable -->
<template>
  <div class="container form-wrap">
      <form class="register">
          <h2>Register to Recipes</h2>
          <div class="inputs">
              <div class="input">
                  <input type="text" name="firstName" placeholder="First name" required>
                  <i class="icon fa-solid fa-user icon"></i>
                </div>
                <div class="input">
                  <input type="text" name="lastName" placeholder="Last name" required>
                  <i class="icon fa-solid fa-user icon"></i>
                </div>
                <div class="input">
                  <input type="email" name="email" placeholder="Email" required>
                  <i class="icon fa-solid fa-envelope"></i>
                </div>
                <div class="input">
                  <input type="password" name="password" placeholder="Password" required>
                  <i class="icon fa-solid fa-lock"></i>
                </div>
                <div class="input">
                  <input type="password" name="password_confirmation" placeholder="Confirm password" required>
                  <i class="icon fa-solid fa-lock"></i>
                </div>
                <div class="error" v-show="error">{{this.errorMsg}}</div>
          </div>
          <button @click.prevent="register">Register</button>
          <p class="login-register">Already have an account? 
              <router-link class="router-link" :to="{name: 'Login'}">Login</router-link>
          </p>
      </form>
  </div>
</template>

<script>
/*eslint-disable*/
export default {
    name: 'Register',
    data(){
        return{
            error: null,
            errorMsg: '',

        }
    },
    methods:{
        async register(){

        }
    }
}
</script>

<style lang="scss">

</style>