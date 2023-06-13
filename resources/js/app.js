import './bootstrap';
import { createApp } from 'vue';
import { createRouter, createWebHistory } from 'vue-router';
import Welcome from './Welcome.vue';
import Records from './Components/Records.vue';
import App from './Components/App.vue';
import Login from './Components/Login.vue';
import Register from './Components/Register.vue';

import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

const router = createRouter({
    history: createWebHistory(),
    routes: [
        { path: '/', component: Welcome },
        { path: '/records', component: Records },
        { path: '/login', component: Login, name: 'Login' },
        { path: '/register', component: Register, name: 'Register' }
    ]
})
const app = createApp(App);
app.use(router);
app.use(VueSweetalert2);
app.mount('#app');