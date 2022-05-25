<!-- eslint-disable -->
<template>
  <div class="container form-wrap">
      <form @submit.prevent="signIn" name="login" action="POST" class="login">
          <h2>Login to Recipes</h2>
          <div class="inputs">
                <div class="input">
                  <input type="email" name="email" placeholder="Email" required>
                  <i class="icon fa-solid fa-envelope"></i>
                </div>
                <div class="input">
                  <input type="password" name="password" placeholder="Password" required>
                  <i class="icon fa-solid fa-lock"></i>
                </div>
                <div class="error" v-show="error">{{this.errorMsg}}</div>
          </div>
          <button type="submit">Log in</button>
          <!-- <button type="submit" @click.prevent="signIn">Log in</button> -->
          <p class="login-register">Don't have an account? 
              <router-link class="router-link" :to="{name: 'Register'}">Register</router-link>
          </p>
      </form>
  </div>
</template>

<script>
/*eslint-disable*/

export default {
    name: 'Login',
    data(){
        return{
            error: null,
            errorMsg: '',

        }
    },
    methods:{
        signIn(e){
            let formData = new FormData(e.target);
            //REVIEW FORM SOLUTION
        }
    }
}
</script>

<style lang="scss">
.form-wrap{
    overflow: hidden;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    
    .login-register{
        margin-top: 2rem;

        .router-link{
            color: #80B700;
        }
    }

    form{
        padding: 1rem;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        flex: 1;
        width: 100%;

        position: absolute;
        inset: 0;

        h2{
            text-align: center;
            margin-bottom: 2rem;
        }

        .inputs{
            width: 100%;
            max-width: 350px;

            .input{
                position: relative;
                display: flex;
                justify-content: center;
                align-items: center;
                margin-bottom: .5rem;

                input{
                    width: 100%;
                    border: none;
                    background: #f2F7F6;
                    padding: 1rem;
                    padding-left: 3rem;
                    border-radius: .25rem;

                    &:focus{
                        outline: #80B700 solid 2px;
                        
                    }
                }

                .icon{
                    width: 1rem;
                    position: absolute;
                    left: 1rem;
                }
            }
        }

        button{
            padding: 1rem;
            width: 100%;
            border: none;
            color: #fff;
            background: #80B700;
            font-weight: bold;
            border-radius: .25rem;
            max-width: 350px;
        }
    }
}
</style>