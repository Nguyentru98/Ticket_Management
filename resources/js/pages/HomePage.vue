<script setup>
import axios from "axios";
import { ref, reactive } from "vue";
import { onMounted } from "vue";
import { ticketStore } from "@/store/ticket";
import { userStore } from "../store/user";
import { categoriesStore } from "../store/categories";
import { departmentStore } from "../store/department";

const userLogin = JSON.parse(localStorage.getItem('user'))
const roles = userLogin.roles;
const ticket = ticketStore();
const user = userStore();
const categoriesSt = categoriesStore()
const departmentSt = departmentStore()
const isAdmin = roles.find(role => role.name === 'admin') !== undefined;
const isUser = roles.find(role => role.name === 'user') !== undefined;
const isSuport = roles.find(role => role.name === 'suport') !== undefined;

const statusTexts = {
  0: "Pending",
  1: "In Progress",
  2: "Completed",
  3: "Canceled",
};
const priority_level = [
  { id: 0, name: "Low" },
  { id: 1, name: "Medium" },
  { id: 2, name: "High" }
];
// form data
const formData = reactive({
  title: "",
  description: "",
  department_id: userLogin?.department_id || null,
  category_id: null ,
  priority: null,
  user_id: userLogin.id,
  id:null,
});
const activeTab = ref('list');
const isEditMode = ref(false); // false: Tạo mới, true: Chỉnh sửa

const resetForm = () => {
  formData.title = "";
  formData.description = "";
  formData.department_id = userLogin?.department_id || null;
  formData.category_id = null;
  formData.priority = null;
  formData.user_id = userLogin.id;
  formData.id = null;
};

// chuyển tab list - form ticket
const switchTab = (tab) => {
  activeTab.value = tab;
  if (tab === "list") resetForm();
};

// Hàm mở form tạo mới
const openCreateForm = () => {
  resetForm(); 
  isEditMode.value = false; // Chế độ tạo mới
  switchTab("form");
};

// Hàm mở form chỉnh sửa
const openEditForm = (ticket,idTicket) => {
  formData.title = ticket.title || "";
  formData.description = ticket.description || "";
  formData.department_id = ticket.department_id || null;
  formData.category_id = ticket.category_id || null;
  formData.priority = ticket.priority || null;
  formData.user_id = ticket.user_id || null;
  formData.id = idTicket || null;
  isEditMode.value = true; // Chế độ chỉnh sửa
  switchTab("form"); // Chuyển tab sang form
};

// lưu dữ liệu form ticket
const saveTicket = async () => {
  try {
    if (isEditMode.value) {
      await ticket.updateTicket(formData);
      console.log("Ticket updated successfully");
    } else {
      await ticket.createTicket(formData);
      console.log("Ticket created successfully");
    }
    switchTab("list");
  } catch (error) {
    if (error.response && error.response.status === 422) {
      console.error("Lỗi xác thực:", error.response.data.errors);
    } else {
      console.error("Lỗi không xác định:", error);
    }
  }
};


// lấy data ticket theo id
const findTicketById = async (idTicket) => {
  try {
    const result = await ticket.findById(idTicket);
    openEditForm(result,idTicket)
  } catch (error) {
    console.error("Error fetching ticket:", error);
  }
};

// xóa ticket
const deleteTicket = (idTicket) => {
  if (confirm("Bạn có chắc chắn muốn xóa không?")) {
        ticket.deleteTicket(idTicket);
      } else {
        console.log("Hủy xóa!");
      }
}
// format date
const formatDate = (dateString) => {
  const date = new Date(dateString);
  return date.toISOString().split('T')[0];
};
// assignTo
const assignTo = ($event, idTicket) => {
  user.assignTo($event, idTicket)
  const statusTicket = {
    "id":idTicket,
    "status":1
  }
  ticket.updateStatus(statusTicket)
};

// lấy danh sách phòng ban
const getDepartmentById = ($id) => {
  departmentSt.getDepartMentById($id)
}
onMounted(() => {
  ticket.loadData();
  user.getUserPCN();
  categoriesSt.listCategories();
  getDepartmentById(userLogin.department_id);
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
          <button class="btn btn-primary">Tìm kiếm</button>
          <button class="btn btn-primary mx-2" @click="switchTab('list')">Danh sách Ticket</button>
          <button class="btn btn-primary" @click="openCreateForm" >Tạo Ticket</button>
        </div>
      </div>
      <!--table list ticket-->
      <table v-if="activeTab === 'list'" class="table table-bordered border-primary">
        <thead>
          <tr>
            <th>STT</th>
            <th>Tiêu đề</th>
            <th>Người yêu cầu</th>
            <th>Danh mục</th>
            <th>Mô tả</th>
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
            <td>
              <div class="text-limited" data-bs-toggle="tooltip" data-bs-placement="top" :title="ticket.description">
                {{ ticket.description|| "" }}
              </div>
            </td>
            <td>{{ ticket.department?.department_name || "" }}</td>
            <td>
              <div class="" v-if="!isAdmin">
               {{ ticket.assigned_to?.name || "Chờ xét duyệt" }}
              </div>
              <div v-if="(ticket.status === 1 || ticket.status === 0) && isAdmin ">
                <select class="form-select" @change="assignTo($event, ticket.id)">
                  <option disabled selected>Assign to</option>
                  <option v-for="user in user.listUser" :key="user.id" :value="user.id" :selected="ticket.assigned_to?.id === user.id">
                    {{ user.name }}
                  </option>
                </select>
              </div>
            </td>
            <td>{{ priority_level[ticket.priority].name }}</td>
            <td>{{ formatDate(ticket.updated_at) }}</td>
            <td>{{ statusTexts[ticket.status] }}</td>
            <td>
              <span class="pi pi-trash px-2" @click="deleteTicket(ticket.id)"></span>
              <span class="pi pi-file-edit px-2" @click="findTicketById(ticket.id)"></span>
            </td>
          </tr>
        </tbody>
      </table>
      <!-- form tạo-edit ticket -->
      <div  v-if="activeTab === 'form'" class="form-ticket">
        <div class="border d-flex" style="min-height: 100vh">
          <div class="col-lg-4 border" style="background-color: #f4f4f4">
            <div class="p-3">
              <div class="select-input mb-2">
                <label class="py-2">Phòng ban <span class="obligatory">*</span></label>
                <div class="form-control">{{ departmentSt.departmentName }}</div>
              </div>
              <div class="select-input mb-2">
                <label class="py-2">Người yêu cầu<span class="obligatory">*</span></label>
               <div class="form-control">{{ userLogin?.name }}</div>
              </div>
              <div class="select-input mb-2">
                <label class="py-2">Độ ưu tiên <span class="obligatory">*</span></label>
                <select
                  class="form-select"
                  aria-label="Default select example"
                  v-model="formData.priority"
                >
                  <option value="" disabled>
                    -- Select an option --
                  </option>
                  <option 
                    v-for="(item) in priority_level" 
                    :key="item.id" 
                    :value="item.id">
                    {{ item.name }}
                  </option>
                </select>

              </div>
              <div class="select-input mb-2">
            <label class="py-2">Danh mục<span class="obligatory">*</span></label>
            <select
              class="form-select"
              aria-label="Default select example"
              v-model="formData.category_id"
            >
              <option value="" disabled>
                -- Select an option --
              </option>
              <option 
                v-for="(category) in categoriesSt.list" 
                :key="category.id" 
                :value="category.id">
                {{ category.categories_name }}
              </option>
            </select>
</div>

            </div>
          </div>
          <div class="col-lg-8 border">
            <div class="p-3 d-flex flex-column justify-content-between">
              <div class="">
                <div class="mb-2">
                  <label class="py-2"
                    >Tiêu đề <span class="obligatory">*</span></label
                  >
                  <input
                    class="form-control"
                    placeholder="Tiêu đề"
                    v-model="formData.title"
                  />
                </div>
                <div class="">
                  <label class="mb-2">Mô tả <span class="obligatory">*</span></label>
                  <div>
                    <textarea
                      class="form-control"
                      placeholder="Nội dung..."
                      v-model="formData.description"
                    ></textarea>
                  </div>
                </div>
              </div>

              <div class="mt-3">
                <button
                  type="submit"
                  @click="saveTicket"
                  class="btn btn-primary"
                >
                  {{isEditMode?'Cập nhật':'Tạo mới'}}
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- phân trang -->
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
td,
th {
  text-align: center;
}
.pi-file-edit:hover,
.pi-trash:hover {
  color: blue;
  cursor: pointer;
}
.obligatory {
  color: red;
}
.text-limited {
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  max-width: 150px; /* Giới hạn chiều rộng */
  cursor: pointer;
}
</style>
