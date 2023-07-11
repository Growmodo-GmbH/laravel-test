import { createRouter, createWebHistory } from "vue-router";

import AuthLayout from '../components/pages/AuthLayout.vue';
import Login from '../views/auth/Login.vue';
import Register from '../views/auth/Register.vue';
import Welcome from '../views/Welcome.vue';
import UserIndex from '../views/users/index.vue'

import store from '../store';

const routes = [
  {
    path: '/',
    redirect: '/login',
    name: 'Auth',
    component: AuthLayout,
    meta: {
      isGuest: true
    },
    children: [
      {
        path: '/login',
        name: 'Login',
        component: Login
      },
      {
        path: '/register',
        name: 'Register',
        component: Register
      },
    ]
  },
  {
    path: '/welcome',
    name: 'Welcome',
    component: Welcome,
    meta: { requiresAuth: true },
  },
  {
    path: '/users',
    name: 'Users',
    component: UserIndex,
    meta: { isAdmin: true, requiresAuth: true }
  },
  {
    path: '/unsubscribe',
    name: 'Unsubscribe',
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes
})

router.beforeEach((to, from, next) => {
  if (to.meta.requiresAuth && !store.state.user.token) {
    next({name: 'Login'});
  } else if (store.state.user.token && to.meta.isGuest || (to.meta.isAdmin && store.state.user.data.is_admin === 0)) {
    next({name: 'Welcome'});
  } else {
    next();
  }
})

export default router;
