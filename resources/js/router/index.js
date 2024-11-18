import { createMemoryHistory, createRouter } from 'vue-router'
import AboutPage from "../components/AboutPage.vue";
import Home from "../page/home.vue";

const routes = [
    {
        path: '/',
        component: Home
    },
    {
        path: '/about',
        component: AboutPage
    },
]

const router = createRouter({
    history: createMemoryHistory(),
    routes,
})

export default router;
