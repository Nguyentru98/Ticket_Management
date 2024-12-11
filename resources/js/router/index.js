import { createWebHistory, createRouter } from 'vue-router';
import routes from "./route";

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach((to, from, next) => {
    if (to.meta.requiresAuth && !isAuthenticated()) {
        // Chuyển hướng đến trang login nếu chưa đăng nhập
        next('/login');
    } else {
        // Cho phép điều hướng
        next();
    }
});

// Hàm kiểm tra trạng thái đăng nhập (ví dụ)
function isAuthenticated() {
    return !!localStorage.getItem('authToken'); // Hoặc logic xác thực tùy ý
}

export default router;
