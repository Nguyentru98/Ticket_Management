<template>
    <div>
      <h1>Login</h1>
      <form @submit.prevent="handleLogin">
        <input v-model="email" type="email" placeholder="Email" required />
        <input v-model="password" type="password" placeholder="Password" required />
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

const apiClient = axios.create({
  baseURL: 'http://127.0.0.1:8000/api', // Thay bằng URL của backend
  withCredentials: true, // Cần thiết để gửi cookie
});

const email = ref('');
const password = ref('');
const error = ref(null);
const router = useRouter();

const handleLogin = async () => {
  try {
    error.value = null; // Xóa thông báo lỗi
    await apiClient.post('/login', {
      email: email.value,
      password: password.value,
    });
    alert('Login successful'); // Hiển thị thông báo thành công
    router.push('/'); // Chuyển hướng tới dashboard
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

  