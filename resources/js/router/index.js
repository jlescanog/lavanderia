import { createRouter, createWebHistory } from 'vue-router';
import login from '../pages/login.vue';
import home from '../pages/home.vue';
import admin from '../pages/adminPanel.vue';
import crudOrders from '../pages/crudOrders.vue'
import formOrders from '../pages/formOrders.vue'
import managementOrders from '../pages/managementOrders.vue';

const routes = [
    { path: '/login', component: login },
    { path: '/adminPanel', component: admin},
    { path: '/crudOrders', component: crudOrders},
    { path: '/formOrders', component: formOrders},
    { path: '/managementOrders', component: managementOrders},
    { path: '/', component: home },
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;
