<template>
  <div class="container">
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
          type="text"
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
import { ref } from 'vue';
import {useAuthStore} from '@/store/auth'
const store = useAuthStore();
const email = ref('tru@gmail.com');
const password = ref('password');
const error = ref(null);

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

</script>


