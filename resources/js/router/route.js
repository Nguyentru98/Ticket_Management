import homePage from '@/pages/HomePage.vue';
import report from "@/pages/Report.vue";
import CreateTicket from "@/pages/CreateTicket.vue";
import LoginPage from "@/pages/auth/LoginPage.vue";

const routes = [
    {
        path: '/login',
        component: LoginPage, // Trang login
        meta: { requiresAuth: false },
    },
    {
        path: '/',
        component: () => import("../layout/index.vue"),
        meta: { requiresAuth: true },
        redirect: '/', // Đường dẫn mặc định
        children: [
            {
                path: '/', // Đường dẫn đầy đủ: "/hrm/user"
                component: homePage,
            },
            {
                path: 'createTicket', // Đường dẫn đầy đủ: "/createTicket"
                component: CreateTicket,
            },
            {
                path: 'report', // Đường dẫn đầy đủ: "/report"
                component: report,
            },
        ]
    },
];
export default routes;
