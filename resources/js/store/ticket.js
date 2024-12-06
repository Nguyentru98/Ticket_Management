import { defineStore } from "pinia";
import api from "@/plugins/api";

export const ticketStore = defineStore("ticket", {
    state: () => ({
        list: [],
        isLoading: false,
    }),
    actions: {
        async loadData() {
            const res = await api.get("/listTicket");
            let { data } = res;
            this.list = data;
            console.log("list ticket", this.list)
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
