import './bootstrap';
import { createApp } from 'vue';
import store from './store';
import router from './router';
import Notifications from '@kyvg/vue3-notification'
import App from './components/App.vue';

createApp(App)
  .use(store)
  .use(router)
  .use(Notifications)
  .mount('#app')
