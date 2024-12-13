import HomePage from '../pages/HomePage.vue';
import Report from '../pages/Report.vue';
import UserList from '../pages/UserList.vue';
import Error from '../pages/Error.vue';
import LoginPage from '../pages/auth/LoginPage.vue'
import TicketList from '../pages/ticket/TicketList.vue';
import TicketCreate from '../pages/ticket/TicketCreate.vue';
import TicketDetail from '../pages/ticket/TicketDetail.vue';
import TicketEdit from '../pages/ticket/TicketEdit.vue';
import index from '../layout/index.vue';
import ticketParent from '../pages/ticket/ticketParent.vue';

const routes = [
    {
        path: '/login',
        component: LoginPage, // Trang login
        meta: { requiresAuth: false },
    },
    {
        path: '/',
        component: index, // Layout chung
        redirect: '/homePage', // Redirect rõ ràng đến homePage
        children: [
            {
                path: 'homePage', // Đường dẫn đầy đủ: "/homePage"
                component: HomePage,
            },
            {
                path: 'report', // Đường dẫn đầy đủ: "/report"
                component: Report,
            },
            {
                path: 'user', // Đường dẫn đầy đủ: "/user"
                component: UserList,
            },
            {
                path: 'ticket',
                component: ticketParent, // Layout cho ticket
                redirect: '/ticket/list', // Đảm bảo chỉ định đường dẫn chính xác
                children: [
                    {
                        path: 'list', // Đường dẫn đầy đủ: "/ticket/list"
                        component: TicketList,
                    },
                    {
                        path: 'create', // Đường dẫn đầy đủ: "/ticket/create"
                        component: TicketCreate,
                    },
                    {
                        path: 'edit', // Đường dẫn đầy đủ: "/ticket/edit"
                        component: TicketEdit,
                    },
                    {
                        path: 'detail', // Đường dẫn đầy đủ: "/ticket/detail"
                        component: TicketDetail,
                    },
                ],
            },
        ],
    },
    {
        path: '/:pathMatch(.*)*', // Route cho trang lỗi
        name: 'Error',
        component: Error,
    },
];

export default routes;
