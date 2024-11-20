<script setup>
import { RouterLink } from 'vue-router'

</script>

<template>
    <nav class="border p-3">
        <ul>
            <li>
                <img src="/images/logo.png" alt="" style="width: 100px" />
            </li>
            <li>
                <router-link to="/">Danh sách ticket</router-link>
            </li>
            <li>
                <router-link to="/createTicket">Tạo Ticket</router-link>
            </li>
            <li>
                <router-link to="/report">Báo cáo</router-link>
            </li>
        </ul>
        <div class="d-flex align-items-center">
            <span class="pi pi-bell"></span>
            <span class="px-3">Nguyễn Văn Trụ</span>
            <span class="pi pi-user"></span>
        </div>
    </nav>
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
