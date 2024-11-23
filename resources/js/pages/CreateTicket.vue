<script setup>
import { ref, reactive } from "vue";
import axios from "axios";

const formData = reactive({
  title: "",
  description: "",
  department_id: null,
  category_id: null,
  priority: null,
  user_id:1,
});
const errors = {};

const createTicket = async () => {
  try {
    console.log("FormData sent:", formData);
    await axios.post("http://127.0.0.1:8000/api/createTicket", formData);
    alert("Data added successfully");
    window.location.reload();
  } catch (error) {
    // console.error("Error adding data:", error.response?.data || error.message);
    // console.error("Error adding data:", error.response.data.errors);
    this.errors = error?.response?.data?.errors
  }
};
</script>


<template>
  <div class="d-flex" style="min-height: 100vh">
    <div class="col-lg-4 border" style="background-color: #f4f4f4">
      <div class="p-3">
        <div class="select-input mb-2">
          <label class="py-2"
            >Phòng ban <span class="obligatory">*</span></label
          >
          <select
            class="form-select"
            aria-label="Default select example"
            v-model="formData.department_id"
          >
            <option value="" disabled selected>-- Select an option --</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
          </select>
          <p v-if="errors.department_id" class="text-red">{{ errors.department_id[0]}}</p>
        </div>
        <div class="select-input mb-2">
          <label class="py-2"
            >Người yêu cầu<span class="obligatory">*</span></label
          >
          <select
            class="form-select"
            aria-label="Default select example"
            v-model="formData.user_id"
          >
            <option value="" disabled selected>-- Select an option --</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
          </select>
        </div>
        <div class="select-input mb-2">
          <label class="py-2"
            >Độ ưu tiên <span class="obligatory">*</span></label
          >
          <select
            class="form-select"
            aria-label="Default select example"
            v-model="formData.priority"
          >
            <option value="" disabled selected>-- Select an option --</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
          </select>
        </div>
        <div class="select-input mb-2">
          <label class="py-2">Danh mục<span class="obligatory">*</span></label>
          <select
            class="form-select"
            aria-label="Default select example"
            v-model="formData.category_id"
          >
            <option value="" disabled selected>-- Select an option --</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
          </select>
        </div>
      </div>
    </div>
    <div class="col-lg-8">
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
            <label class="mb-2">Mô tả</label>
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
          <button type="submit" @click="createTicket" class="btn btn-primary">
            Gửi yêu cầu
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.obligatory {
  color: red;
}
</style>
