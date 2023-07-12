import './bootstrap'
import { createApp } from 'vue'
import Router from '@/router'
import store from '@/store'

const app = createApp({});

app.use(Router)
app.use(store)
app.mount('#app')
