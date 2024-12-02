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
            <input type="text" id="register-username" class="form-control" placeholder="Enter username" v-model="registerData.name">
            <div v-if="errors.name" class="errors">
              {{ errors.name }}
            </div>
          </div>
          <div class="mb-3">
            <label for="register-email" class="form-label">Email</label>
            <input type="email" id="register-email" class="form-control" placeholder="Enter email" v-model="registerData.email">
            <div v-if="errors.email" class="errors">
              {{ errors.email }}
            </div>
          </div>
          <div class="mb-3">
            <label for="register-password" class="form-label">Password</label>
            <input type="password" id="register-password" class="form-control" placeholder="Enter password" v-model="registerData.password">
            <div v-if="errors.password" class="errors">
              {{ errors.password }}
            </div>
          </div>
          <div class="mb-3">
            <label for="register-password" class="form-label">phone number</label>
            <input type="number" id="register-password" class="form-control" placeholder="Enter phone" v-model="registerData.phone">
            <div v-if="errors.phone" class="errors">
              {{ errors.phone }}
            </div>
          </div>
          <div class="mb-3">
            <label for="register-password" class="form-label">departments</label>
            <select class="form-select" v-model="registerData.department">
              <option disabled selected>---select---</option>
              <option v-for="(department) in department.listDepartment" :key="department.id" :value="department.id">
                {{ department.department_name }}
              </option>
            </select>
            <div v-if="errors.department" class="errors">
              {{ errors.department }}
            </div>
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
import { ref, reactive } from "vue";
import { useAuthStore } from "@/store/auth";
import { departmentStore } from "../../store/department";
import { userStore } from "../../store/user";

// State
const store = useAuthStore();
const department = departmentStore();
const userSt = userStore()
const email = ref("admin@gmail.com");
const password = ref("password");
const isLogin = ref(true); // Sử dụng `ref` để làm trạng thái động
const registerData = ref({
  name: "",
  email: "",
  password: "",
  phone: "",
  department: "",
});
// Validation errors
const errors = reactive({
    name: null,
    email: null,
    password: null,
    phone: null,
    department: null
});
// chuyển đăng kí - đăng nhập
const toggleForm = () => {
  isLogin.value = !isLogin.value; // Chuyển đổi giữa Login và Register
  if(isLogin.value === false) {
    department.getData()
    console.log(department.getData())
  }
};
//đăng nhập
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
// đăng kí
const submitRegister = async () => {
  try {
    Object.keys(errors).forEach((field) => {
      errors[field] = null; // Đặt lại lỗi về null
    });
    let payload = {
      name: registerData.value.name,
      email: registerData.value.email,
      password: registerData.value.password,
      phone: registerData.value.phone,
      department: registerData.value.department,
    };

    // Sử dụng await để đảm bảo xử lý bất đồng bộ
    await userSt.register(payload); 
    if (!Object.values(errors).some((error) => error !== null)) {
      toggleForm();
    }
  } catch (error) {
    if (error.response && error.response.status === 422) {
      const validationErrors = error.response.data.errors;
      // Map lỗi đến các trường tương ứng
      Object.keys(validationErrors).forEach((field) => {
        errors[field] = validationErrors[field][0]; // Chỉ hiển thị lỗi đầu tiên
      });
    } else {
      console.error("Unexpected error:", error);
    }
  }
};
</script>

<style>
.errors {
  color: red !important;
}
</style>
