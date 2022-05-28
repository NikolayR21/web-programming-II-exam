<!-- eslint-disable -->
<template>
  <div class="container form-wrap">
      <NavigationTop />
    <form @submit.prevent="login" name="login" action="POST" class="login">
      <h2>Login to Recipes</h2>
      <div class="inputs">
        <div class="input">
          <input type="email" name="email" placeholder="Email" required />
          <i class="icon fa-solid fa-envelope"></i>
        </div>
        <div class="input">
          <input
            type="password"
            name="password"
            placeholder="Password"
            required
          />
          <i class="icon fa-solid fa-lock"></i>
        </div>
        <div class="error" v-show="error">
          {{ errorMsg }}
        </div>
      </div>
      <button :disabled="processing" type="submit">
        {{ processing ? "Please wait.." : "Log in" }}
      </button>
      <p class="login-register">
        Don't have an account?
        <router-link class="router-link" :to="{ name: 'Register' }"
          >Register</router-link
        >
      </p>
    </form>
  </div>
</template>

<script>
/*eslint-disable*/
import NavigationTop from '../components/NavigationTop.vue'
export default {
  name: "Login",
  components: {
      NavigationTop
    },
  data() {
    return {
      error: null,
      errorMsg: null,
      processing: false,
      userData: {
        email: "",
        password: "",
      },
    };
  },
  methods: {
    async login(e) {
      const formData = new FormData(e.target);
      this.processing = true;
      this.$store
        .dispatch("login", formData || this.userData)
        .then(() => {
          this.processing = false;
          this.$router.push({ name: "Profile" });
        })
        .catch((err) => {
          this.processing = false;
          this.error = true;
          this.errorMsg = err.response.data.message;
        });
    },
  },
};
</script>

<style lang="scss">
.form-wrap {
  overflow: hidden;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;

  .login-register {
    margin-top: 2rem;

    .router-link {
      color: #80b700;
    }
  }

  form {
    padding: 1rem;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    flex: 1;
    width: 100%;

    position: absolute;
    inset: 0;

    h2 {
      text-align: center;
      margin-bottom: 2rem;
    }

    .inputs {
      width: 100%;
      max-width: 350px;

      .input {
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 0.5rem;

        input {
          width: 100%;
          border: none;
          background: #f2f7f6;
          padding: 1rem;
          padding-left: 3rem;
          border-radius: 0.25rem;

          &:focus {
            outline: #80b700 solid 2px;
          }
        }

        .icon {
          width: 1rem;
          position: absolute;
          left: 1rem;
        }
      }

      .error {
        color: red;
        font-size: 0.8rem;
        margin: 0.5rem 0;
      }
    }

    button {
      padding: 1rem;
      width: 100%;
      border: none;
      color: #fff;
      background: #80b700;
      font-weight: bold;
      border-radius: 0.25rem;
      max-width: 350px;

      &:disabled {
        background: #fff;
        color: #80b700;
        border: solid 2px #80b700;
      }
    }
  }
}
</style>