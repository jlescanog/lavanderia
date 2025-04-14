import { createRouter, createWebHistory } from 'vue-router';
import login from '../pages/login.vue';
import register from '../pages/register.vue';
import home from '../pages/home.vue';
import admin from '../pages/adminPanel.vue';
import crudOrders from '../pages/crudOrders.vue'
import formOrders from '../pages/formOrders.vue'
import managementOrders from '../pages/managementOrders.vue';

const routes = [
    { path: '/login', component: login },
    { path: '/register', component: register },
    { path: '/adminPanel', component: admin},
    { path: '/crudOrders', component: crudOrders},
    { path: '/formOrders', component: formOrders},
    { path: '/managementOrders', component: managementOrders},
    { path: '/dashboard', component: home },
    { path: '/:pathMatch(.*)*', redirect: '/dashboard' }
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;
