<script setup>

</script>

<template>
    <div class="d-flex " style="min-height: 100vh">
        <div class="col-lg-4 border" style="background-color: #f4f4f4;">
            <div class="p-3">
                <div class="select-input mb-2">
                    <label class="py-2">Phòng ban <span class="obligatory">*</span></label>
                    <select class="form-select" aria-label="Default select example">
                        <option value="" disabled selected>-- Select an option --</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
                <div class="select-input mb-2">
                    <label class="py-2">Người yêu cầu <span class="obligatory">*</span></label>
                    <select class="form-select" aria-label="Default select example">
                        <option value="" disabled selected>-- Select an option --</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
                <div class="select-input mb-2">
                    <label class="py-2">Độ ưu tiên <span class="obligatory">*</span></label>
                    <select class="form-select" aria-label="Default select example">
                        <option value="" disabled selected>-- Select an option --</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
                <div class="select-input mb-2">
                    <label class="py-2">Độ ưu tiên <span class="obligatory">*</span></label>
                    <select class="form-select" aria-label="Default select example">
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
                        <label class="py-2">Tiêu đề <span class="obligatory">*</span></label>
                        <input class="form-control" placeholder="Tiêu đề">
                    </div>
                    <div class="">
                        <label class="mb-2">Mô tả</label>
                        <div>
                            <textarea class="form-control" placeholder="Nội dung..."></textarea>
                        </div>
                    </div>
                </div>

                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">
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
