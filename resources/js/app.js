import './bootstrap';
import { createApp } from 'vue';
import UserRecords from './components/UserRecords.vue';
import Unsub from './components/Unsubscribe.vue';
import Register from './components/Register.vue';

const app = createApp({});
app.component('user-records', UserRecords);
app.component('unsubscribe', Unsub);
app.component('register', Register);

app.mount('#app');
