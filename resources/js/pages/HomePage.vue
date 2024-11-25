<script setup>
import axios from "axios";
import { ref } from "vue";
import { onMounted } from "vue";

const listTicket = ref([]);
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
const fetchData = async () => {
  const res = await axios.get("http://127.0.0.1:8000/api/listTicket");
  listTicket.value = res.data;
  console.log(res);
};
onMounted(() => {
  fetchData();
});
</script>

<template>
  <div class="container">
    <div class="p-2 list-ticket">
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
          <tr v-for="(ticket, index) in listTicket" :key="ticket.id">
            <td>{{ index + 1 }}</td>
            <td>{{ ticket.title }}</td>
            <td>{{ ticket.user?.name || "" }}</td>
            <td>{{ ticket.category?.categories_name || "" }}</td>
            <td>{{ ticket.department?.department_name || "" }}</td>
            <td>{{ ticket.assigned_to?.name || "null" }}</td>
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
</style>
