import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/Home.vue'
import Recipes from '../views/Recipes.vue'
import Shopping from '../views/Shopping.vue'
import Profile from '../views/Profile.vue'
import Login from '../views/Login.vue'
import Register from '../views/Register.vue'
import HomeRecipes from '../views/HomeRecipes.vue'
import HomeVideos from '../views/HomeVideos.vue'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    //name: 'Home',
    component: Home,
    children: [
      {
        path: '',
        name: 'HomeRecipes',
        component: HomeRecipes,
        meta: {
          title: 'Home Recipes'
        }
      },
      {
        path: 'videos',
        name: 'HomeVideos',
        component: HomeVideos,
        meta: {
          title: 'Home Videos'
        }
      }
    ],
    meta: {
      title: 'Home'
    }
  },
  {
    path: '/recipes',
    name: 'Recipes',
    component: Recipes,
    meta: {
      title: 'Recipes'
    }
  },
  {
    path: '/shopping',
    name: 'Shopping',
    component: Shopping,
    meta: {
      title: 'Shopping list'
    }
  },
  {
    path: '/profile',
    name: 'Profile',
    component: Profile,
    meta: {
      title: 'Profile'
    }
  },
  {
    path: '/login',
    name: 'Login',
    component: Login,
    meta: {
      title: 'Login'
    }
  },
  {
    path: '/register',
    name: 'Register',
    component: Register,
    meta: {
      title: 'Register'
    }
  },


]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

router.beforeEach((to, from, next) => {
  document.title = `${to.meta.title} | Recipes`;
  next();
});

export default router
