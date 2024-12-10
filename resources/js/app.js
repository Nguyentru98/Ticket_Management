import './bootstrap';
import 'bootstrap/dist/css/bootstrap.css' // bootstrap 5
import { createApp } from 'vue';
import App from './App.vue';
import router from "./router/index";
// import 'bootstrap/dist/js/bootstrap'
import 'primeicons/primeicons.css' // icon
import 'bootstrap/dist/js/bootstrap.bundle.min.js';
import { createPinia } from "pinia";
const pinia = createPinia();
const app = createApp(App);
app.use(router);
app.use(pinia);
app.mount('#app');

