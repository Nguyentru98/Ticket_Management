<script setup>
import { onMounted } from 'vue';
import { reactive } from 'vue';
import { ticketStore } from '../../store/ticket';

const ticketSt = ticketStore()
const params = reactive({
    page: 1,
    key: '',
    current_page: 1,
    sort_column: 'id',
    direction: 'desc',
})
const buildParams = (params) => {
  if (!params) {
    return '';
  }
  let arr = [];
  Object.keys(params).forEach((key) => {
    if (params[key] !== undefined && params[key] !== '') { // Bỏ qua undefined và rỗng
      arr.push(`${key}=${params[key]}`);
    }
  });
  return '?' + arr.join('&');
};
onMounted( ()=> {
    const payload = buildParams(params)
    ticketSt.loadData(payload);
})
</script>

<template>
    <div class="list">
        <!--table list ticket-->
        <div class="list-ticket">
            <div>
                <div class="d-flex my-4">
                    <div class="mb-3">
                        <input
                        type="email"
                        class="form-control"
                        placeholder="Từ khóa tìm kiếm..."
                        />
                    </div>
                    <div class="px-3">
                        <button class="btn btn-primary">Tìm kiếm</button>
                    </div>  
                </div>
                <table class="table">
                    <thead>
                        <tr>
                        <th>STT</th>
                        <th>Tiêu đề</th>
                        <th>Người yêu cầu</th>
                        <th>Danh mục</th>
                        <th>Người xử lý</th>
                        <th>Độ ưu tiên</th>
                        <th>Ngày tạo</th>
                        <th>Trạng thái</th>
                        <th v-if="isAdmin && isSuport">Xác nhận hoàn thành</th>
                        <th>Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(ticket, index) in ticketSt.list" :key="ticket.id">
                            <td>{{ index + 1 }}</td>
                            <td>{{ ticket.title }}</td>
                            <td>{{ ticket.user?.name || "" }}</td>
                            <td>{{ ticket.category?.categories_name || "" }}</td>
                            <!-- <td>
                                <div class="" v-if="!isAdmin">
                                {{ ticket.assigned_to?.name || "Chờ xét duyệt" }}
                                </div>
                                <div class="" v-else-if="isAdmin &&  (!ticket.status == 0 && !ticket.status == 1)">
                                {{ ticket.assigned_to?.name}}
                                </div>
                                <div v-if="(ticket.status == 0 || ticket.status == 1) && isAdmin ">
                                <select class="form-select" @change="assignTo($event, ticket.id)">
                                    <option disabled selected>Assign to</option>
                                    <option v-for="user in user.listUser" :key="user.id" :value="user.id" :selected="ticket.assigned_to?.id === user.id">
                                    {{ user.name }}
                                    </option>
                                </select>
                                </div>
                            </td> -->
                            <!-- <td>
                                <span class="pi pi-star-fill priority_level"></span>
                                <span 
                                class="pi pi-star-fill" 
                                :class="{ 'priority_level': priority_level[ticket.priority-1]?.id == 2 || priority_level[ticket.priority-1]?.id == 3 }">
                                </span>
                                <span 
                                class="pi pi-star-fill" 
                                :class="{ 'priority_level': priority_level[ticket.priority-1]?.id == 3 }">
                                </span>
                            </td> -->
                            <!-- <td>{{ formatDate(ticket.updated_at) }}</td> -->
                            <!-- <td>{{ statusTexts[ticket.status] }}</td> -->
                            <!-- <td v-if="isAdmin && isSuport">
                                <div class="form-check d-flex justify-content-center">
                                <input class="form-check-input" type="checkbox" :checked="ticket.status === 3" value="" id="flexCheckIndeterminate" @click="completedHandle(ticket.id) ">
                                </div>
                            </td> -->
                            <!-- <td>
                                <span class="pi pi-trash px-2" @click="deleteTicket(ticket.id)"></span>
                                <span class="pi pi-file-edit px-2" @click="findTicketById(ticket.id,'form')"></span>
                                <span class="pi pi-eye px-2" @click="findTicketById(ticket.id,'detail')"></span>
                            </td> -->
                        </tr>
                        <tr>
                            <td>
                                <div @click="openCreateForm" class="btn-create-ticket p-2" style="cursor: pointer;">
                                <span class="pi pi-plus "><strong class="p-2">Tạo ticket</strong></span>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <!-- phân trang -->
                <div class="d-flex justify-content-center align-items-center">
                <!-- <nav aria-label="Page navigation example" v-if="ticket.totalRecords > 2  ">
                    <ul class="pagination">
                    <li class="page-item">
                        <button class="page-link" aria-label="Previous" @click="prev" :disabled="params.page === 1">
                        <span aria-hidden="true">&laquo;</span>
                        </button>
                    </li>
                    <li class="page-item" v-for="page in ticket.totalPages" :key="page" @click="goToPage(page)" :class="{ active: params.page === page }">
                        <a class="page-link" >
                        {{ page }}
                        </a>
                    </li>
                    
                    <li class="page-item">
                        <button class="page-link"  aria-label="Next" @click="next" :disabled="params.page === ticket.totalPages">
                        <span aria-hidden="true">&raquo;</span>
                        </button>
                    </li>
                    </ul>
                </nav> -->
            </div>
        </div>
    </div>
</div>
</template>