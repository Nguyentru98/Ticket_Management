<template>
  <div>
    <div class="d-flex justify-content-center align-items-center vh-100">
      <div class="card shadow-lg p-4" style="max-width: 400px; width: 100%; border-radius: 10px;">
        <h2 class="text-center mb-4">{{ isLogin ? 'Login' : 'Register' }}</h2>
        <form v-if="isLogin" @submit.prevent="handleLogin">
          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" placeholder="Enter username" required v-model="email">
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" placeholder="Enter password" required v-model="password">
          </div>
          <button type="submit" class="btn btn-primary w-100">Login</button>
          <p class="text-center mt-3">
            Don't have an account? 
            <a href="#" @click.prevent="toggleForm">Register</a>
          </p>
        </form>

        <form v-else @submit.prevent="submitRegister">
          <div class="mb-3">
            <label for="register-username" class="form-label">Username</label>
            <input type="text" id="register-username" class="form-control" placeholder="Enter username" v-model="registerData.name" required>
          </div>
          <div class="mb-3">
            <label for="register-email" class="form-label">Email</label>
            <input type="email" id="register-email" class="form-control" placeholder="Enter email" v-model="registerData.email" required>
          </div>
          <div class="mb-3">
            <label for="register-password" class="form-label">Password</label>
            <input type="password" id="register-password" class="form-control" placeholder="Enter password" v-model="registerData.password" required>
          </div>
          <div class="mb-3">
            <label for="register-password" class="form-label">phone number</label>
            <input type="number" id="register-password" class="form-control" placeholder="Enter phone" v-model="registerData.phone" required>
          </div>
          <div class="mb-3">
            <label for="register-password" class="form-label">departments</label>
            <select class="form-select" v-model="registerData.department">
              <option disabled selected>---select---</option>
              <option v-for="(department) in department.listDepartment" :key="department.id" :value="department.id">
                {{ department.department_name }}
              </option>
            </select>
          </div>
          <button type="submit" class="btn btn-success w-100">Register</button>
          <p class="text-center mt-3">
            Already have an account? 
            <a href="#" @click.prevent="toggleForm">Login</a>
          </p>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from "vue";
import { useAuthStore } from "@/store/auth";
import { departmentStore } from "../../store/department";
import { userStore } from "../../store/user";

// State
const store = useAuthStore();
const department = departmentStore();
const userSt = userStore()
const email = ref("admin@gmail.com");
const password = ref("password");
const error = ref(null);
const isLogin = ref(true); // Sử dụng `ref` để làm trạng thái động
const registerData = ref({
  name: "",
  email: "",
  password: "",
  phone: "",
  department: "",
});
// Methods
const toggleForm = () => {
  isLogin.value = !isLogin.value; // Chuyển đổi giữa Login và Register
  if(isLogin.value === false) {
    department.getData()
    console.log(department.getData())
  }
};

const handleLogin = () => {
  try {
    let payload = {
      email: email.value,
      password: password.value,
    };
    store.login(payload);
  } catch (err) {
    error.value = err.response?.data?.message || "Login failed"; // Lưu lỗi
  }
};

const submitRegister = () => {
  try {
    let payload = {
      name: registerData.value.name,
      email: registerData.value.email,
      password: registerData.value.password,
      phone: registerData.value.phone,
      department: registerData.value.department,
    };
    userSt.register(payload);    
    toggleForm();
  } catch (err) {
    error.value = err.response?.data?.message || "Register failed"; // Lưu lỗi
  }
};



</script>
