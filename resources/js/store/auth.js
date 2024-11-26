import { defineStore } from "pinia";
import api from "@/plugins/api";
import router from "@/router";

export const useAuthStore  = defineStore('auth', {
    state: () => ({
        token: localStorage.getItem('authToken') || '',
        activeUser: localStorage.getItem('user') || '',
        permissions: localStorage.getItem('permissions') || [],// Mảng chứa các quyền của người dùng
        isLoading: false
    }),
    getters: {
        user: (state) => state.authUser,
        hasPermission: (state) => (permission) => state.permissions.includes(permission)
    },
    actions: {
        async login(credentials) {
            console.log(credentials)
            const res = await api.post('/login', credentials);
            console.log(res);
            let {data} = res
            this.token = data.token;
            this.activeUser = data.user;
            // this.permissions = data.permissions;
            localStorage.setItem('authToken', this.token)
            localStorage.setItem('user', JSON.stringify(data.user))
            router.push('/'); // Chuyển hướng sau khi đăng nhập thành công
        },
        logout() {
            this.token = '';
            this.activeUser = '';
            this.permissions = [];
            localStorage.removeItem('access_token');
            localStorage.removeItem('user');
        }
    }
})
