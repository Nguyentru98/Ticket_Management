import { defineStore } from "pinia";
import api from "@/plugins/api";
import router from "@/router";

export const departmentStore = defineStore("department", {
    state: () => ({
        listDepartment: [],
        isLoading: false,
        departmentName: "",
    }),
    actions: {
        async getData() {
            const res = await api.get("/listDepartment");
            console.log(res.data);
            return (this.listDepartment = res.data);
        },
        async getDepartMentById($id) {
            const res = await api.get("/getDepartMentById/" + $id);
            const department = res.data;
            this.departmentName = department.department_name
            return department;
        },
    },
});
