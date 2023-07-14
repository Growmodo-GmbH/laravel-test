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
        meta: { requiresAuth: true }
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

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth) && !store.getters.isAuthenticated) {
        next({ name: 'Home' });
    } else {
        next();
    }
});

export default router;
