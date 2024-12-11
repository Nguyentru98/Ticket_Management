<script setup>
import { ref } from "vue";
import { onMounted } from "vue";
import { userStore } from "../store/user";

const users = userStore();
const listRole = [
  {id:1, name:"admin"},
  {id:2, name:"user"},
  {id:3, name:"suport"},
]
const role = ref()
const handleRole = (event)=>{
    console.log(event.target.value)
}
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
          <th>Tên người dùng</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Phòng ban</th>
          <th>Vai trò</th>
          <th>Chức năng</th>
          <th>Trạng thái</th>
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
            <div class="" v-if="Array.isArray(user.roles) && user.roles.length > 0">
              <div v-for="(role) in user.roles" :key="role.id" :value="role.id">
                {{ user.name }}
              </div>
            </div>
            <div v-else>
              <select class="form-select" @change="handleRole($event)">
                  <option disabled selected>-- Select an option --</option>
                  <option v-for="(role) in listRole" :key="role.id" :value="role.id">
                    {{ role.name }}
                  </option>
              </select>
            </div>
          </td>
          <td>
            <span class="pi pi-trash px-2"></span>
          </td>
          <td>
            <div class="form-check form-switch">
            <input class="form-check-input pt-2" type="checkbox" id="flexSwitchCheckDefault" style="margin: auto;">
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
.pi-trash:hover {
  color: blue;
  cursor: pointer;
}
</style>