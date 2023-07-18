import axios from 'axios';
import Cookies from 'js-cookie';
import toast from '@store/modules/toast';
import router from '@/router';

export default {
  namespaced: true,
  state() {
    return {
      authenticated: false,
      user: null,
      roles: {
        admin: false,
        user: false,
      },
      token: Cookies.get('token'),
    };
  },
  getters: {
    user(state) {
      return state.user;
    },
    roles(state) {
      return state.roles;
    },
    id(state) {
      if (state.user) return state.user.id;
      return null;
    },
    authenticated(state) {
      return state.authenticated;
    },
    token(state) {
      return state.token;
    },
  },
  mutations: {
    SET_AUTHENTICATION(state, value = false) {
      state.authenticated = value;
    },
    SET_USER(state, payload = null) {
      state.user = payload;
      if (payload && payload.roles && payload.roles.length > 0) {
        payload.roles.forEach((role, index) => {
          if (role.name == 'Admin') {
            state.roles.admin = true;
          }
          if (role.name == 'User') {
            state.roles.user = true;
          }
        });
      } else {
        state.roles = {
          admin: false,
          user: false,
        };
      }
    },
    SET_TOKEN(state, token) {
      state.token = token;
      Cookies.set('token', token, { expires: null });
    },
    LOGOUT(state) {
      state.authenticated = false;
      state.user = null;
      state.roles = {
        admin: false,
        user: false,
      };
      state.token = null;
      Cookies.remove('token');
      window.sessionStorage.clear();
    },
  },
  actions: {
    async login({ dispatch }, payload) {
      try {
        await axios.get('/sanctum/csrf-cookie');
        await axios
          .post('/api/login', payload)
          .then(async (res) => {
            await dispatch('saveToken', res.data.access_token);
            await dispatch('getUser');

            return res;
          })
          .catch((err) => {
            throw err.response;
          });
      } catch (e) {
        throw e;
      }
    },
    async register({ commit, dispatch }, payload) {
      await axios.get('/sanctum/csrf-cookie');
      const res = await axios.post('/api/register', payload);
      if (
        res.status == 201 &&
        res &&
        res.data &&
        res.data.user &&
        res.data.user.id
      ) {
        await dispatch('saveToken', res.data.token);
        await dispatch('getUser');

        return res;
      }

      commit('LOGOUT');
      throw res.response;
    },
    async toggleSubscribe({ dispatch, state }, action) {
      const res = await axios.post(`/api/users/toggle-subscribe`, {
        action,
        user: state.user,
      });
      if (res.status != 200) throw res;
      dispatch('getUser');
      dispatch(
        'toast/popToast',
        {
          message: 'User successfully ' + action,
          timer: 5000,
          icon: 'success',
        },
        { root: true },
      );
      return res;
    },
    async logout({ commit }) {
      await axios
        .post('/api/logout')
        .then((res) => {
          commit('LOGOUT');
        })
        .catch((err) => {});

      router.push({ name: 'home' });
    },
    async getUser({ commit }) {
      await axios
        .get('/api/user')
        .then((res) => {
          if (res && res.data && res.data.id) {
            commit('SET_USER', res.data);
            commit('SET_AUTHENTICATION', true);
          } else {
            commit('LOGOUT');
          }
        })
        .catch((err) => {
          commit('LOGOUT');
          throw err.response;
        });
    },
    async getUserByToken({ commit, dispatch }, payload) {
      await axios
        .post('/api/user-by-token', { token: payload.token })
        .then((res) => {
          if (res && res.data && res.data.id) {
            commit('SET_USER', res.data);
            commit('SET_AUTHENTICATION', true);
          } else {
            commit('LOGOUT');
          }
        })
        .catch((err) => {
          commit('LOGOUT');
          throw err.response;
        });
    },
    async saveToken({ commit, dispatch }, payload) {
      commit('SET_TOKEN', payload);
    },
  },
};
