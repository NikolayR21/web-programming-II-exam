/* eslint-disable */
import api from '../../api/api'

const state = () => ({
    recipes: [],
    recipesLoaded: null,
    selectedRecipe: null
})

const getters = {
    recipes: store => store.recipes
}
const mutations = {
    updateSelectedRecipe(state, payload){
        state.selectedRecipe = payload
    }
}
const actions = {
    async getRecipes({state}){
        const results = await api.recipe().getRecipes().then(res => res.data)
        results.forEach(result => {
            if(!state.recipes.some(recipe => recipe.id === result.id)){
                state.recipes.push(result);
            }
        })

      state.recipesLoaded = true;
    },
    async getRecipe({commit}, recipeId){
        if(this.selectedRecipe){
            commit('updateSelectedRecipe', null)
        }
        await api.recipe(recipeId).getRecipe()
        .then(res => {
            commit('updateSelectedRecipe', res.data[0])
        })
    }
}

export default {
    state,
    getters,
    mutations,
    actions
}