import { defineStore } from "pinia";
import api from "@/plugins/api";
import router from "@/router";

export const userStore  = defineStore('user', {
    state: () => ({
        listUser: [],
        isLoading: false
    }),
    actions: {
        async getAllUser() {
            this.listUser = [];
            const res = await api.get('/getUser');
            let { data } = res
            this.listUser = data.original;
            console.log(this.listUser,"listUser")
        },
        async getUser() {
            const res = await api.get('/getUser',{
              params: { 
                id: 1, 
                fields: ['name'] // Lấy chỉ trường 'name'
            }
            });
            let { data } = res
            this.list = data;
        },
        async getUserPCN() {
            const res = await api.get('/getUserPCN');
            
            let { data } = res
            this.listUser = data;
        },
        async assignTo(event, ticket_id) {
            const selectedUserId = event.target.value; // Lấy user_id từ option được chọn
            // Hiển thị hộp thoại xác nhận
            const confirmAssign = confirm(
              'Bạn có chắc chắn muốn thực hiện thao tác này ?'
            );
          
            if (confirmAssign) {
              // Nếu người dùng xác nhận
              await api.post('/assignTo', {
                ticket_id: Number(ticket_id),
                assigned_to: Number(selectedUserId)
              });
              window.location.reload();
            } else {
              event.target.value = ""; // Reset lại giá trị trong select
            }
        },
    }

})