import HomePage from '@/pages/HomePage.vue';
import Report from "@/pages/Report.vue";
import LoginPage from "@/pages/auth/LoginPage.vue";
import UserList from '@/pages/UserList.vue';
import Error from '@/pages/Error.vue';

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
                path: 'report', // Đường dẫn đầy đủ: "/report"
                component: Report,
            },
            {
                path: 'listUser', // Đường dẫn đầy đủ: "/report"
                component: UserList,
            },
            {
                path: 'forbidden', // Đường dẫn đầy đủ: "/report"
                name: 'Forbidden',
                component: Error,
            },
        ]
    },
];
export default routes;
