import api from "@/api/api"

const state = () => ({
    ingredients: null
})

const getters = {
    ingredients: store => store.ingredients
}
const mutations = {
    updateIngredients(state, payload){
        state.ingredients = payload
    }
}
const actions = {
    async getIngredients({commit}){
        await api.ingredients().getIngredients()
        .then(res => {
            commit('updateIngredients', res.data)
            console.log(state.ingredients)
        })
    }
}

export default {
    state,
    getters,
    mutations,
    actions
}