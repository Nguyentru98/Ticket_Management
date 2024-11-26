import HomePage from '@/pages/HomePage.vue';
import Report from "@/pages/Report.vue";
import CreateTicket from "@/pages/CreateTicket.vue";
import LoginPage from "@/pages/auth/LoginPage.vue";
import UserList from '@/pages/UserList.vue';

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
                component: HomePage,
            },
            {
                path: 'createTicket', // Đường dẫn đầy đủ: "/createTicket"
                component: CreateTicket,
            },
            {
                path: 'report', // Đường dẫn đầy đủ: "/report"
                component: Report,
            },
            {
                path: '/listUser', // Đường dẫn đầy đủ: "/report"
                component: UserList,
            },
        ]
    },
];
export default routes;
