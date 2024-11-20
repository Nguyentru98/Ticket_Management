<script setup>

</script>

<template>
    <div class="container">
        <div class="p-2 list-ticket">
            <!--search-->
            <div class="d-flex">
                <div class="mb-3">
                    <input type="email" class="form-control" placeholder="Từ khóa tìm kiếm...">
                </div>
                <div class="px-3">
                    <button class="btn btn-primary">Tìm kiếm</button>
                </div>
            </div>
            <!--table-->
            <table class="table table-bordered border-primary">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tiêu đề</th>
                        <th>Người yêu cầu</th>
                        <th>Chủ đề</th>
                        <th>Bộ phận xử lý</th>
                        <th>Người xử lý</th>
                        <th>Độ ưu tiên</th>
                        <th>Ngày cập nhật</th>
                        <th>Trạng thái</th>
                        <th>Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>01</td>
                        <td>Sửa lỗi đơn hàng</td>
                        <td>Trụ</td>
                        <td>Lỗi phần mềm</td>
                        <td>P.CN</td>
                        <td>Tru</td>
                        <td></td>
                        <td></td>
                        <td>Chờ duyệt</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>

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
</style>
