import { createStore } from "vuex";
import axiosClient from '../axios';

const store = createStore({
  state: {
    user: {
      data: JSON.parse(sessionStorage.getItem('USER')) || {},
      token: sessionStorage.getItem('TOKEN') || null
    },
    users: [],
  },
  getters: {
    getUsers(state) {
      return state.users;
    },
    getUser(state) {
      return state.user;
    },
  },
  actions: {
    async register({ commit }, user) {
      return await axiosClient.post('/register', user)
        .then(({data}) => {
          commit('setUser', data);
          return data;
        })
    },
    async login({ commit }, user) {
      return await axiosClient.post('/login', user)
        .then(({data}) => {
          commit('setUser', data);
          return data;
        })
    },
    async logout({commit}) {
      return await axiosClient.post('/logout')
        .then(response => {
          commit('logout');
          sessionStorage.clear();
          return response;
        })
    },
    async users({commit}) {
      return await axiosClient.get('/users')
        .then(({data}) => {
          commit('setUsers', data.users);
        });
    },
    async createUser({commit}, user) {
      return await axiosClient.post('/users/create', user)
        .then(({data}) => {
          commit('updateUsers', data.user)

          return {
            'user': data.user, 
            'showModal': false,
          }
        })
    },
    async editUser({commit}, payload) {
      return await axiosClient.put(`/users/${payload.user.id}`, payload.user)
        .then(({data}) => {
          commit('updateUsers', {
            user: data.user, 
            index: payload.index
          })

          return {
            'user': data.user, 
            'showModal': false,
          }
        })
    },
    async deleteUser({commit}, id) {{
      return await axiosClient.delete(`/users/${id}`)
        .then(() => {
          commit('updateUsers', id)
        });
    }}
  },
  mutations: {
    logout: (state) => {
      state.user.data = {};
      state.user.token = null;
    },
    setUser: (state, data) => {
      state.user.token = data.token;
      state.user.data = data.user;
      if (data.token && data.user) {
        sessionStorage.setItem('TOKEN', data.token);
        sessionStorage.setItem('USER', JSON.stringify(data.user));
      }
    },
    setUsers: (state, data) => {
      state.users = data;
    },
    updateUsers: (state, data) => {
      if (typeof data === 'object' && !data.hasOwnProperty('index')) {
          state.users = [...state.users, data];  // creating
      } else if (typeof data.user === 'object' && data.hasOwnProperty('index')) {
          state.users.splice(data.index, 1, data.user)  // updating
      } else {
        state.users = state.users.filter((user) => user.id !== data)  // deleting
      }
    },
  },
});

export default store;
