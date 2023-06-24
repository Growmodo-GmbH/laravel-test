import { createStore } from "vuex";
import createPersistedState from 'vuex-persistedstate';
import axiosClient from "../axios";

const store = createStore({
    plugins: [createPersistedState()],
    state: {
        user: {
            data: sessionStorage.getItem('user'),
            token: sessionStorage.getItem('token')
        }
    },
    getters: {},
    actions: {
        register({ commit }, user){
            return axiosClient.post('/register', user)
                        .then(({data}) => {
                            commit('setUser', data);
                            return data;
                        })
                        .catch((error) => {
                            return error;
                        });
        },
        login({ commit }, user){
            return axiosClient.post('/login', user)
                        .then(({data}) => {
                            commit('setUser', data);
                            return data;
                        })
                        .catch((error) => {
                            return error;
                        });
        },
        logout({ commit }){
            return axiosClient.post('/logout')
                        .then(response => {
                            commit('logout');
                            return response;
                        });
        },
    },
    mutations: {
        logout: (state) => {
            state.user.data = {};
            state.user.token = null;
        },
        setUser: (state, UserData) => {
            state.user.data = UserData.user;
            state.user.token = UserData.token;
            sessionStorage.setItem('token', UserData.token);
            sessionStorage.setItem('user', UserData.user);
        }
    },
    modules: {}
})

export default store;