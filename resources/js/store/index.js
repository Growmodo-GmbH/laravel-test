import { createStore } from 'vuex';
import api from '../../utils/api';

const store = createStore({
    state() {
        return {
            user: JSON.parse(localStorage.getItem('user')) || null,
            isLoading: false
        }
    },
    getters: {
        isAuthenticated(state) {
            return !!state.user;
        },
        isAdmin(state) {
            return state.user && state.user.is_admin;
        }
    },
    mutations: {
        setUser(state, user) {
            state.user = user;
            if (user) {
                localStorage.setItem('user', JSON.stringify(user));
            } else {
                localStorage.removeItem('user');
            }
        },
        toggleLoading(state) {
            state.isLoading = !state.isLoading;
        },
        updateUser(state, payload) {
            if (state.user) {
                state.user.name = payload.name;
                state.user.email = payload.email;
                state.user.phone = payload.phone;
            }
        },
    },
    actions: {
        async checkAuth({ commit }) {
            if (!localStorage.getItem('user')) {
                try {
                    const response = await api.get('/api/user');
                    commit('setUser', response.data);
                } catch (error) {
                    commit('setUser', null);
                }
            }
        }
    }
});

export default store;
