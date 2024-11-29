import axios from "axios"
import router from "./../router/route";
const api = axios.create({
    baseURL: 'http://127.0.0.1:8000/api/',
    timeout: 30000,
    headers: {
        'Content-Type': 'application/json',
        Accept: "application/json",
    },
})
api.interceptors.request.use(
    config => {
        const accessToken = localStorage.getItem('authToken');
        if (accessToken) {
            config.headers['Authorization'] = "Bearer " + accessToken;
        }
        if (typeof config.form_data !== 'undefined') {
            config.headers["content-type"] = "multipart/form-data";
        }
        return config;
    },
    error => {
        // Xử lý lỗi xảy ra trong request interceptor
        return Promise.reject(error);
    }
);
api.interceptors.response.use(
    response => response,
    error => {
        if (error.response && error.response.status === 401) {
            // Chuyển hướng đến trang đăng nhập
            localStorage.removeItem("activeUser");
            localStorage.removeItem("authToken");
            router.push({ name: 'Login' });
        }
        if (error.response && error.response.status === 403) {
            window.location.href = '/forbidden';
        }
        return Promise.reject(error);
    }
);

export default api
