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

const routes = [
    {
        path: '/login',
        component: LoginPage, // Trang login
        meta: { requiresAuth: false },
    },
    {
        path: '/',
        component:index,
        redirect:'ticket',
        children: [

            {
                path: 'homePage', // Đường dẫn đầy đủ: "/"
                component: HomePage,
            },
            {
                path: 'report', // Đường dẫn đầy đủ: "/report"
                component: Report,
            },
            {
                path: 'user', // Đường dẫn đầy đủ: "/report"
                component: UserList,
            },
            {
                path: 'ticket',
                redirect : 'ticket/list',
                children: [
                    {
                        path: 'list',
                        component: TicketList,
                    },
                    {
                        path: 'create', 
                        component: TicketCreate,
                    },
                    {
                        path: 'edit', 
                        component: TicketEdit,
                    },
                    {
                        path: 'detail', 
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
