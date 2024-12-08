import { defineStore } from "pinia";
import { ref, computed } from "vue";
import api from "@/plugins/api";

export const ticketStore = defineStore("ticket", {
    state: () => ({
        list: [],
        isLoading: false,
        totalRecords: 0, // Tổng số bản ghi từ API
        recordsPerPage: 2, // Số bản ghi mỗi trang
        totalPages: 0, // Tổng số trang
    }),
    
    actions: {
        async loadData(params) {
            try {
              const res = await api.get("/listTicket" + params);
              this.list = res.data.data;
              this.totalRecords = res.data.total; // Cập nhật tổng số bản ghi
              this.totalPages = Math.ceil(this.totalRecords / this.recordsPerPage)
              console.log(this.totalRecords,this.totalPages,"kkkkkkkk")
            } catch (error) {
              console.error("Error loading data:", error);
            }
        },
        async createTicket(formData) {
            try {
                await api.post("/createTicket", formData);
                alert("Data added successfully");
                window.location.reload();
            } catch (error) {
                console.log(error);
            }
        },
        async deleteTicket(idTicket){
            await api.get("/delete/ticket/"+ idTicket);
            console.log("xóa thành công");
            window.location.reload();
        },
        async findById(idTicket){
           const response = await api.get("/find/ticket/"+ idTicket);
           return response.data; 
        },
        async updateTicket(ticket){
            try {
                await api.post("update/ticket", ticket);
                alert("Data update successfully");
                window.location.reload();
            } catch (error) {
                console.log(error);
            }
        },
        async updateStatus(ticket){
            try {
                await api.post("update/status/ticket", ticket);
                // window.location.reload();
            } catch (error) {
                console.log(error);
            }
        }
    },
});
