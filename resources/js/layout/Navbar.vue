<script setup>
import { RouterLink } from "vue-router";
import { useAuthStore } from "../store/auth";

const authStore = useAuthStore();
const user = JSON.parse(localStorage.getItem('user'))
const roles = user.roles;
const isAdmin = roles.find(role => role.name === 'admin') !== undefined;

const logout = () => {
    authStore.logout();
};
</script>

<template>
  <nav class="p-4 border-bottom">
      <ul>
        <li>
          <img src="/images/logo.png" alt="" style="width: 100px" />
        </li>
        <li>
          <router-link to="/">Trang chủ</router-link>
        </li>
        <li>
          <router-link to="/ticket">Ticket</router-link>
        </li>
        <li>
          <router-link to="/report">Báo cáo</router-link>
        </li>
        <li v-if="isAdmin">
          <router-link to="/user">Quản trị người dùng</router-link>
        </li>
      </ul>
      <div class="d-flex align-items-center">
        <span class="pi pi-bell"></span>
      <div class="user">
        <div class="dropdown">
          <a
            class="btn btn-dropdown bg-white dropdown-toggle d-flex align-items-center px-0"
            href="#"
            role="button"
            id="dropdownMenuLink"
            data-bs-toggle="dropdown"
            aria-expanded="false"
          >
          <span class="px-3">{{ user?.name }}</span>
          <span class="pi pi-user"></span>
          </a>
          <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <li>
              <a class="dropdown-item">
                <div class="d-flex align-items-center">
                  <div class="dropdown-item-icon">
                  </div>
                  <span>Thông tin người dùng</span>
                </div>
              </a>
            </li>
           
            <li>
                <button class="dropdown-item" @click="logout">
                  <div class="d-flex align-items-center">
                    <div class="dropdown-item-icon">
                    </div>
                    <span class="text-item-dropdown" >Đăng xuất</span>
                  </div>
                </button>
            </li>
          </ul>
        </div>
      </div>
    </div>
    </nav>
  <div class="container">
    
  </div>
</template>

<style>
a {
  text-decoration: none;
}
nav {
  display: flex;
  justify-content: space-between;
}
ul {
  list-style: none;
  margin: 0;
  padding: 0;
  display: flex;
  align-items: center;
  font-weight: bold;
}
li {
  padding: 0 10px;
}
</style>
