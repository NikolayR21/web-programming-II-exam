const state = () => ({
    shoppingList: []
})

const getters = {
    shoppingList: store => store.shoppingList
}
const mutations = {
    addItem(state, payload){
        state.shoppingList.push(payload)
    }
}
const actions = {
    
}

export default {
    state,
    getters,
    mutations,
    actions
}