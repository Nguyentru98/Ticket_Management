import './bootstrap';
import 'bootstrap/dist/css/bootstrap.css'
import { createApp } from 'vue';
import app from './App.vue';
import router from "./router/index";
import 'bootstrap/dist/js/bootstrap'
createApp(app).use(router).mount('#app');
