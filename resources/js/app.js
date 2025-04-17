import './bootstrap';
import '../scss/app.scss';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';


import { createApp } from 'vue'
import home from './components/home.vue';
import navBar from './components/navBar.vue'
import loginForm from './components/login.vue'
import registerForm from './components/register.vue';
import formOrders from './components/formOrders.vue'
import managementOrders from './components/managementOrders.vue';
import ordenForm2 from './pages/ordenForm2.vue';

// Crear app para navbar si existe el div
const navbarElement = document.getElementById('navbar');
if (navbarElement) {
    createApp(navBar).mount('#navbar');
}

// Crear app para el contenido si existe el div
const appElement = document.getElementById('app');
if (appElement) {
    const app = createApp({});

    app.component('login-form', loginForm)
        .component('register-form', registerForm)
        .component('home', home)
        .component('form-orders', formOrders)
        .component('management-orders', managementOrders)
        .component('orden-form', ordenForm2)

    app.mount('#app');
}
