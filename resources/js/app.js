import './bootstrap';
import 'bootstrap/dist/css/bootstrap.css' // bootstrap 5
import { createApp } from 'vue';
import App from './App.vue';
import router from "./router/index";
import 'bootstrap/dist/js/bootstrap'
import 'primeicons/primeicons.css' // icon

const app = createApp(App);
app.use(router);
app.mount('#app');

