import { createWebHistory, createRouter } from 'vue-router'
import store from '../store/index.js'

// import ExampleComponent from './components/ExampleComponent.vue';
const LoginComponent = () => import('@/components/auth/LoginComponent.vue')
const RegisterComponent = () => import('@/components/auth/RegisterComponent.vue')
const DashboardComponent = () => import('@/components/Dashboard/DashboardComponent.vue')

const routes = [
    {
        name: 'login',
        path: '/',
        component: LoginComponent,
        meta: {
            middleware: 'guest',
            title: 'login'
        }
    },
    {
        name: "registerv",
        path: '/registerv',
        component: RegisterComponent,
        meta: {
            middleware: 'guest',
            title: 'register'
        }
    },
    {
        path: "/",
        name: 'dashboard',
        component: DashboardComponent,
        meta: {
            middleware: "auth",
            title: 'dashbaord'
        },
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes, // short for `routes: routes`
})

router.beforeEach((to, from, next) => {
    document.title = to.meta.title
    if (to.meta.middleware == "guest") {
        if (store.state.auth.authenticated) {
            next({ name: "dashboard" })
        }
        next()
    } else {
        if (store.state.auth.authenticated) {
            next()
        } else {
            next({ name: "login" })
        }
    }
})

export default router