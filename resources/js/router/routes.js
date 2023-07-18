// general routes
const Home = () => import('@pages/Home.vue');
const Dashboard = () => import('@pages/Dashboard.vue');
const Login = () => import('@pages/Login.vue');
const Register = () => import('@pages/Register.vue');
const NotFound = () => import('@pages/NotFound.vue');
const Users = () => import('@/views/admin/Users.vue');

import { defineAsyncComponent } from 'vue';

import auth from '@/middleware/auth';
import guest from '@/middleware/guest';
import roleAdmin from '@/middleware/roleAdmin';
import roleUser from '@/middleware/roleUser';

export default [
  {
    path: '/',
    component: Home,
    name: 'home',
    meta: {
      middleware: [guest],
    },
  },
  {
    path: '/dashboard',
    component: Dashboard,
    name: 'dashboard',
    meta: {
      middleware: [auth],
    },
  },
  {
    path: '/users',
    component: Users,
    name: 'users',
    meta: {
      middleware: [roleAdmin],
    },
  },
  {
    path: '/login',
    component: Login,
    name: 'login',
    meta: {
      middleware: [guest],
    },
  },
  {
    path: '/register',
    component: Register,
    name: 'register',
    meta: {
      middleware: [guest],
    },
  },
  {
    path: '/:pathMatch(.*)*',
    component: NotFound,
    name: 'NotFound',
  },
];
