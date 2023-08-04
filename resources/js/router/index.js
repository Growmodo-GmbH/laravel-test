import { createRouter, createWebHistory } from "vue-router";

import home from '../components/home.vue'

import notFound from '../components/notFound.vue'

import login from '../components/login.vue'

import register from '../components/register.vue'

import users from '../components/users.vue'

import userEdit from '../components/userEdit.vue'


const routes = [
    {
        path: '/',
        name: 'Home',
        component: home
    },
    {
        path: '/login',
        name: 'Login',
        component: login
    },
    {
        path: '/register',
        name: 'Register',
        component: register
    },
    {
        path: '/admin/users',
        name: 'Users',
        component: users
    },
    {
        path: '/:pathMatch(.*)*',
        name: 'NotFound',
        component: notFound
    },
    {
      path: '/user/edit',
      name: 'userEdit',
      component: userEdit
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router