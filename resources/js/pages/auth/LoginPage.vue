<template>
  <div>
    <form @submit.prevent="handleLogin">
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email address</label>
        <input
          v-model="email"
          type="email"
          class="form-control"
          id="exampleInputEmail1"
          aria-describedby="emailHelp"
        />
        <div id="emailHelp" class="form-text">
          We'll never share your email with anyone else.
        </div>
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input
          v-model="password"
          type="password"
          class="form-control"
          id="exampleInputPassword1"
        />
      </div>
      <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1" />
        <label class="form-check-label" for="exampleCheck1">Check me out</label>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
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
        localStorage.setItem('authToken', '1234556');
        alert('Login successful'); // Hiển thị thông báo thành công
        router.push('/'); // Chuyển hướng tới dashboard
    } catch (err) {
        error.value = err.response?.data?.message || 'Login failed'; // Lưu lỗi
    }
};

const handleLogout = async () => {
  try {
    await apiClient.post("/logout"); // Đăng xuất
    alert("Logout successful"); // Thông báo thành công
    router.push("/loginForm"); // Chuyển hướng về login
  } catch (err) {
    console.error("Logout failed", err); // Log lỗi
  }
};

const logout = ()=> {
    emit('handleLogout')
}
</script>


