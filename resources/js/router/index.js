import { createRouter, createWebHistory } from "vue-router";

import Login from '../components/Login.vue'
import Register from '../components/Register.vue'
import Users from '../components/UsersTable.vue'
import Home from '../components/Home.vue'
import EditUser from '../components/EditUser.vue'

const routes = [
    {
      path: '/home',
      name: 'Home',
      component: Home
    },
    {
      path: '/register',
      name: 'Register',
      component: Register
    },
    {
      path: '/login',
      name: 'Login',
      component: Login
    },
    {
      path: '/admin/users',
      name: 'Users',
      component: Users
    },
    {
      path: '/edit/user',
      name: 'EditUser',
      component: EditUser
    }
]

const router = createRouter({
    base: process.env.APP_URL,
    history: createWebHistory(),
    routes
})

export default router