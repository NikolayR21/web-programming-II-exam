import Vue from 'vue'
import Vuex from 'vuex'
import user from './modules/user'
import recipe from './modules/recipe'
import ingredients from './modules/ingredients'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    
  },
  getters: {},
  mutations: {
    
  },
  actions: {},
  modules: {
    user,
    recipe,
    ingredients
  }
})
