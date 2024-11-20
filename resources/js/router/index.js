import { createMemoryHistory, createRouter } from 'vue-router';
import homePage from '../pages/HomePage.vue';
import report from "../pages/Report.vue";
import CreateTicket from "../pages/CreateTicket.vue";

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
    }
]

const router = createRouter({
    history: createMemoryHistory(),
    routes,
})

export default router;
