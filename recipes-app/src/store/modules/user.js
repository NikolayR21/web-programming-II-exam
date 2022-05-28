import api from '../../api/api'
import router from '@/router/index'

const state = () => ({
    user: null,
    authenticated: false
})

const getters = {
    user: store => store.user
}

const mutations = {
    updateUser(state, payload){
        state.user = payload
    },
    updateAuthenticated(state, payload){
        state.authenticated = payload
    }
}

const actions = {
    async register({commit}, payload){
        await api.auth().register(payload)
        .then((res) => {
            commit('updateUser', res.data.user)
            commit('updateAuthenticated', true)
            window.localStorage.setItem('token', res.data.access_token)
        })
    },
    async login({commit}, payload){
        await api.auth().login(payload)
        .then((res) => {
            commit('updateUser', res.data.user)
            commit('updateAuthenticated', true)
            window.localStorage.setItem('token', res.data.access_token)
        })
    },
    async logout({commit}){
        commit("updateUser", null)
        commit("updateAuthenticated", false)
        router.push({name: "HomeRecipes"})
        await api.auth().logout()
        .then(() => {
            window.localStorage.removeItem('token')
        })
    }
}

export default {
    state,
    getters,
    mutations,
    actions
}