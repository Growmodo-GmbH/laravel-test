// import Vue from 'vue';
import { createStore } from 'vuex';
import sharedMutations from 'vuex-shared-mutations';
import auth from '@store/modules/auth';
import toast from '@store/modules/toast';
import persistedState from 'vuex-persistedstate';

export default createStore({
  state: {
    //
  },
  mutations: {
    //
  },
  actions: {
    //
  },
  modules: {
    auth,
    toast,
  },
  plugins: [
    sharedMutations({
      predicate: ['SET_USER', 'SET_AUTHENTICATION'],
    }),
    persistedState({
      storage: window.sessionStorage,
    }),
  ],
});
