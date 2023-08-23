import { createApp } from 'vue';
import App from '@views/App.vue';
import router from '@router';
import store from '@store';
import Cookies from 'js-cookie';
import axios from 'axios';
import VueSweetalert2 from 'vue-sweetalert2';
import { plugin as VueTippy } from 'vue-tippy';
import AppButton from '@components/common/AppButton.vue';
import AppToast from '@components/common/AppToast.vue';
import '@fortawesome/fontawesome-free/css/all.min.css';
import { ServerTable, ClientTable, EventBus } from 'v-tables-3';
import toasty from 'toasty';

axios.defaults.withCredentials = true;
axios.interceptors.request.use(function (config) {
  const accessToken = Cookies.get('token');
  config.headers.Authorization = accessToken ? `Bearer ${accessToken}` : '';
  return config;
});

const app = createApp(App);
const VUE_APP_URL = APP_URL; // eslint-disable-line
const VUE_ENVIRONMENT = ENVIRONMENT; // eslint-disable-line

store.dispatch('auth/getUser').then(() => {
  app
    .use(store)
    .use(router)
    .use(VueSweetalert2)
    .use(ClientTable, {}, 'tailwind')
    .use(VueTippy, {
      directive: 'tippy',
      component: 'tippy',
      componentSingleton: 'tippy-singleton',
      defaultProps: {
        arrow: true,
        theme: 'material',
        animation: 'perspective',
        placement: 'auto-end',
        allowHTML: true,
      },
    })
    .component('AppButton', AppButton)
    .component('AppToast', AppToast);

  app.mount('#app');
});
