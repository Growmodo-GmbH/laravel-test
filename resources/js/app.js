import './bootstrap';
import { createApp } from 'vue';
import { createRouter, createWebHistory } from 'vue-router';
import Welcome from './Welcome.vue';
import Records from './Components/Records.vue';
import App from './Components/App.vue';

const router = createRouter({
    history: createWebHistory(),
    routes: [
        { path: '/', component: Welcome },
        { path: '/records', component: Records }
    ]
})
const app = createApp(App);
app.use(router);
app.mount('#app');