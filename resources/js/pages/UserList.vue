<script setup>
import { ref } from "vue";
import { onMounted } from "vue";
import { userStore } from "../store/user";

const users = userStore();

onMounted(() => {
  users.getAllUser();
});
</script>
<template>
  <div class="container">
    <table class="table table-bordered border-primary">
      <thead>
        <tr>
          <th>STT</th>
          <th>Tên nguồi dùng</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Phòng ban</th>
          <th>Phân quyền</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(user, index) in users.listUser" :key="user.id">
          <td>{{ index + 1 }}</td>
          <td>{{ user.name }}</td>
          <td>{{ user.email }}</td>
          <td>{{ user.phone }}</td>
          <td>{{ user.department?.department_name || "No Department" }}</td>
          <td>
            <div v-if="user.role">
                {{ ticket.role?.name || "null" }}
              </div>
              <div v-else>
                <select class="form-select" @change="user.assignTo($event, ticket.id)">
                  <option disabled selected>--select--</option>
                  <option v-for="(user) in user.listUser" :key="user.id" :value="user.id">
                    {{ user.name }}
                  </option>
                </select>
              </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<style>
td,
th {
  text-align: center;
}
</style>