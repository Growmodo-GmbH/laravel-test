import { createRouter, createWebHistory } from "vue-router";
import Login from "../pages/Login.vue";
import Register from "../pages/Register.vue";
import store from "../store";

const routes = [
    {
        path: '/',
        name: 'Login',
        component: Login
    },
    {
        path: '/register',
        name: 'Register',
        component: Register
    },
    {
        path: '/home',
        name: 'Home',
        meta: { requiresAuth: true },
        component: () => {
            const userType = store.state.user.data['user_type'];

            return (userType === 'Admin') ? import('../pages/Home-Admin.vue') :  import('../pages/Home-User.vue');
        }
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes
});

router.beforeEach((to, from, next) => {
    if(to.meta.requiresAuth && !store.state.user.token){
        next({
            name: 'Login'
        })
    }else{
        next();
    }
})

function checkAuthenticationStatus() {
    const token = localStorage.getItem('token');
    return !!token;
  }

export default router;