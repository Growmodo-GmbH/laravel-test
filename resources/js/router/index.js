import { createRouter, createWebHistory } from 'vue-router';
import store from '../store';

import HomePage from '../components/pages/HomePage.vue';
import ViewRecordsPage from '../components/pages/ViewRecordsPage.vue';
import WelcomePage from '../components/pages/WelcomePage.vue';

const routes = [
    {
        path: '/',
        name: 'Home',
        component: HomePage
    },
    {
        path: '/view-records',
        name: 'ViewRecords',
        component: ViewRecordsPage,
        meta: { requiresAuth: true, requiresAdmin: true }
    },
    {
        path: '/welcome',
        name: 'Welcome',
        component: WelcomePage,
        meta: { requiresAuth: true }
    },
    {
        path: '/:pathMatch(.*)*',
        redirect: '/'
    }
];

const appUrl = new URL(import.meta.env.VITE_APP_URL);
const router = createRouter({
    history: createWebHistory(appUrl.pathname),
    routes
});

router.beforeEach(async (to, from, next) => {
    // if user is not authenticated, check the auth state
    if (!store.getters.isAuthenticated) {
        await store.dispatch('checkAuth');
    }
    // if user tries to access any route that requires authentication and they are not authenticated, they will be redirected to Home
    if (to.matched.some(record => record.meta.requiresAuth) && !store.getters.isAuthenticated) {
        next({ name: 'Home' });
    }
    // if an authenticated user (not admin) tries to access a route that requires admin, they will be redirected to Welcome
    else if (to.matched.some(record => record.meta.requiresAuth && record.meta.requiresAdmin) && (!store.getters.isAdmin)) {
        next({ name: 'Welcome' });
    }
    // if an authenticated user tries to access the Home page, they will be redirected to Welcome
    else if (to.name === 'Home' && store.getters.isAuthenticated) {
        next({ name: 'Welcome' });
    }
    else {
        next();
    }
});


export default router;
