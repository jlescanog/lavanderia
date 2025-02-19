import './bootstrap';
import '../scss/app.scss';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';


import { createApp } from 'vue'
import App from './components/App.vue'
import router from './router/index';

import navBar from './components/navBar.vue'

const app = createApp(App)

app.component('navBar', navBar)

app.use(router)

app.mount('#app')
