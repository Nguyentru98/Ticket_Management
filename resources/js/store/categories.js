import { defineStore } from "pinia";
import api from "@/plugins/api";
import router from "@/router";

export const categoriesStore  = defineStore('categories', {
    state: () => ({
       list:[]
    }),

    actions: {
        async listCategories() {
            const res = await api.get("/listCategories");
            let { data } = res;
            this.list = data;
        },
    }
})
