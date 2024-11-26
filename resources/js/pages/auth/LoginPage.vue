<template>
    <div>
        <h1>Login</h1>
        <form @submit.prevent="handleLogin">
            <input v-model="email" type="email" placeholder="Email" required />
            <input v-model="password" type="text" placeholder="Password" required />
            <button type="submit">Login</button>
            <button @click="handleLogout">logout</button>
        </form>
        <p v-if="error">{{ error }}</p>
    </div>
</template>

<script setup>
import axios from 'axios';
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import {useAuthStore} from '@/store/auth'
const store = useAuthStore();
const email = ref('tru@gmail.com');
const password = ref('password');
const error = ref(null);
const router = useRouter();

const handleLogin = () => {
    try {
        let payload = {
            email: email.value,
            password: password.value,
        }
        store.login(payload);
    } catch (err) {
        error.value = err.response?.data?.message || 'Login failed'; // Lưu lỗi
    }
};

const handleLogout = async () => {
    try {
        await apiClient.post('/logout'); // Đăng xuất
        alert('Logout successful'); // Thông báo thành công
        router.push('/loginForm'); // Chuyển hướng về login
    } catch (err) {
        console.error('Logout failed', err); // Log lỗi
    }
};
</script>


