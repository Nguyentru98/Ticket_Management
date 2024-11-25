import { createMemoryHistory, createRouter } from 'vue-router';
import homePage from '../pages/HomePage.vue';
import report from "../pages/Report.vue";
import CreateTicket from "../pages/CreateTicket.vue";
import Login from '../pages/Login.vue';
import Register from '../pages/Register.vue';
const routes = [
    {
        path: '/',
        component: homePage,
    },
    {
        path: '/createTicket',
        component: CreateTicket,
    },
    {
        path: '/report',
        component: report,
    },
    {
        path: '/loginForm',
        component: Login,
    },
    {
        path: '/register',
        component: Register,
    }
]

const router = createRouter({
    history: createMemoryHistory(),
    routes,
})

export default router;
