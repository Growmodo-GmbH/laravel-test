import { createWebHistory, createRouter } from 'vue-router'

// import ExampleComponent from './components/ExampleComponent.vue';
const ExampleComponent = () => import('@/components/ExampleComponent.vue')

const routes = [
    {
        name: 'default',
        path: '/',
        component: ExampleComponent
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes, // short for `routes: routes`
})

export default router