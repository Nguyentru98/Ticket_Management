import { defineStore } from "pinia";
import api from "@/plugins/api";

export const ticketStore  = defineStore('ticket', {
    state: () => ({
        list: [],
        isLoading: false
    }),
    actions: {
        async loadData() {
            const res = await api.get('/listTicket');
            let { data } = res
            this.list = data;
            console.log(res,"ress")
        },
    }

})
