<template>
  <div class="container form-wrap">
    <form @submit.prevent="register" class="register">
      <h2>Register to Recipes</h2>
      <div class="inputs">
        <div class="input">
          <input
            type="text"
            name="firstName"
            v-model="userData.firstName"
            placeholder="First name"
            required
          />
          <i class="icon fa-solid fa-user icon"></i>
        </div>
        <div class="input">
          <input
            type="text"
            name="lastName"
            v-model="userData.lastName"
            placeholder="Last name"
            required
          />
          <i class="icon fa-solid fa-user icon"></i>
        </div>
        <div class="input">
          <input
            type="email"
            name="email"
            v-model="userData.email"
            placeholder="Email"
            required
          />
          <i class="icon fa-solid fa-envelope"></i>
        </div>
        <div class="input">
          <input
            type="password"
            name="password"
            v-model="userData.password"
            placeholder="Password"
            required
          />
          <i class="icon fa-solid fa-lock"></i>
        </div>
        <div class="input">
          <input
            type="password"
            name="password_confirmation"
            v-model="userData.password_confirmation"
            placeholder="Confirm password"
            required
          />
          <i class="icon fa-solid fa-lock"></i>
        </div>
        <div
          class="error"
          v-for="(errorMsg, i) in errorMsgs"
          :key="i"
          v-show="error"
        >
          {{ errorMsg[0] }}
        </div>
      </div>
      <button :disabled="processing" type="submit">
        {{ processing ? "Please wait.." : "Register" }}
      </button>
      <p class="login-register">
        Already have an account?
        <router-link class="router-link" :to="{ name: 'Login' }"
          >Login</router-link
        >
      </p>
    </form>
  </div>
</template>

<script>
/*eslint-disable*/
//import axios from 'axios';
export default {
  name: "Register",
  data() {
    return {
      error: null,
      errorMsgs: null,
      processing: false,
      userData: {
        firstName: "",
        lastName: "",
        email: "",
        password: "",
        password_confirmation: "",
      },
    };
  },
  methods: {
    async register(e) {
      const formData = new FormData(e.target);
      this.processing = true;
      this.$store
        .dispatch("register", formData || this.userData)
        .then(() => {
          this.processing = false;
          this.$router.push({ name: "Profile" });
        })
        .catch((err) => {
          this.processing = false;
          this.error = true;
          this.errorMsgs = err.response.data.errors;
        });
    },
  },
  computed: {},
};
</script>

<style lang="scss">
</style>