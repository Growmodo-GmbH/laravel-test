import axios from 'axios'

export default {
    namespaced: true,
    state: {
        user_data: {},
        token: "",
        authenticated: false,
        users: []
    },
    getters: {
        get_user_data : (state) => state.user_data,
        get_token : (state) => state.token,
        get_authenticated : (state) => state.authenticated,
        get_users : (state) => state.users
    },
    mutations: {
        set_user_data(state, payload){
            state.user_data = payload
        },
        set_token(state, payload){
            state.token = payload
        },
        set_authenticated(state, payload){
            state.authenticated = payload
        },
        set_users(state, payload){
            state.users = [...payload]
        },
        set_clear(state){
            state.user_data = {}
            state.token = ""
            state.authenticated = false
            state.users = []
        }
    },
    actions: {
        set_user_data({commit}, payload){
            commit('set_user_data', payload)
        },
        set_token({commit}, payload){
            commit('set_token', payload)
        },
        set_authenticated({commit}, payload){
            commit('set_authenticated', payload)
        },
        async fetch_records({commit}){
            await axios.get('/api/user/get_all_users')
            .then(({data}) => {
                commit('set_users', data.data)
            });
        },
        set_clear({commit}){
            commit('set_clear')
        },
        async remove_user({_}, payload){
            await axios.delete(`/api/user/delete_record/${payload.id}`)
        }
    }
}