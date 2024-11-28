<script setup>
import axios from "axios";
import { ref } from "vue";
import { onMounted } from "vue";
import {ticketStore} from '@/store/ticket'
import { userStore } from "../store/user";

const ticket = ticketStore();
const user = userStore();
const statusTexts = {
  0: "Pending",
  1: "In Progress",
  2: "Completed",
  3: "Cancelled",
};
const priority_level = {
  0: "low",
  1: "medium",
  2: "high",
};

onMounted(() => {
  ticket.loadData();
  user.getUserPCN();
});
</script>

<template>
  <div class="container">
    <div class="p-2 list-ticket border">
      <!--search-->
      <div class="d-flex">
        <div class="mb-3">
          <input
            type="email"
            class="form-control"
            placeholder="Từ khóa tìm kiếm..."
          />
        </div>
        <div class="px-3">
          <button class="btn btn-primary">Tìm kiếm </button>
        </div>
      </div>
      <!--table-->
      <table class="table table-bordered border-primary">
        <thead>
          <tr>
            <th>STT</th>
            <th>Tiêu đề</th>
            <th>Người yêu cầu</th>
            <th>Danh mục</th>
            <th>Bộ phận xử lý</th>
            <th>Người xử lý</th>
            <th>Độ ưu tiên</th>
            <th>Ngày cập nhật</th>
            <th>Trạng thái</th>
            <th>Chức năng</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(ticket, index) in ticket.list" :key="ticket.id">
            <td>{{ index + 1 }}</td>
            <td>{{ ticket.title }}</td>
            <td>{{ ticket.user?.name || "" }}</td>
            <td>{{ ticket.category?.categories_name || "" }}</td>
            <td>{{ ticket.department?.department_name || "" }}</td>
            <td>
              <div v-if="ticket.assigned_to">
                {{ ticket.assigned_to?.name || "null" }}
              </div>
              <div v-else>
                <select class="form-select" @change="user.assignTo($event, ticket.id)">
                  <option disabled selected>Assign to</option>
                  <option v-for="(user) in user.listUser" :key="user.id" :value="user.id">
                    {{ user.name }}
                  </option>
                </select>
              </div>
            </td>
            <td>{{ priority_level[ticket.priority]}}</td>
            <td>{{ ticket.updated_at }}</td>
            <td>{{ statusTexts[ticket.status] }}</td>
            <td></td>
          </tr>
        </tbody>
      </table>

      <div class="d-flex justify-content-center align-items-center">
        <nav aria-label="Page navigation example">
          <ul class="pagination">
            <li class="page-item">
              <a class="page-link" href="#" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
              </a>
            </li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
              <a class="page-link" href="#" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </div>
  </div>
</template>

<style scoped>
.page-item {
  padding: 0;
}
td,th {
  text-align: center;
 
}
</style>
