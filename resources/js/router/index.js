import { createRouter, createWebHistory } from 'vue-router';
import login from '../pages/login.vue';
import home from '../pages/home.vue';

const routes = [
    { path: '/login', component: login },
    { path: '/', component: home }
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;
