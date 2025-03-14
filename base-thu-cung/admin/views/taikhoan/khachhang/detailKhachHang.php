<?php include './views/layout/header.php'; ?>
<!-- Navbar -->
<?php include './views/layout/navbar.php'; ?>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<?php include './views/layout/sidebar.php'; ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Quản lý tài khoản khách hàng</h1>
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-6">
                    <img src="<?= BASE_URL . $khachHang['anh_dai_dien'] ?>" style="width: 70%" alt="" onerror="this.onerror=null; this.src='https://t3.ftcdn.net/jpg/05/53/79/60/360_F_553796090_XHrE6R9jwmBJUMo9HKl41hyHJ5gqt9oz.jpg'">

                </div>
                <div class="col-6">
                    <table class="table table-borderless">
                        <tbody style="font-size: large;">
                            <tr>
                                <th>Họ tên: </th>
                                <td><?= $khachHang['ho_ten'] ?? '' ?></td>
                            </tr>
                            <tr>
                                <th>Ngày sinh: </th>
                                <td><?= $khachHang['ngay-sinh'] ?? '' ?></td>
                            </tr>
                            <tr>
                                <th>Email: </th>
                                <td><?= $khachHang['email'] ?? '' ?></td>
                            </tr>
                            <tr>
                                <th>Số điện thoại: </th>
                                <td><?= $khachHang['so_dien_thoai'] ?? '' ?></td>
                            </tr>
                            <tr>
                                <th>Giới tính: </th>
                                <td><?= $khachHang['gioi_tinh'] == 1 ? 'Nam' : 'Nữ' ?></td>
                            </tr>
                            <tr>
                                <th>Địa chỉ: </th>
                                <td><?= $khachHang['dia_chi'] ?? '' ?></td>
                            </tr>
                            <tr>
                                <th>Trạng thái: </th>
                                <td><?= $khachHang['trang_thai'] == 1 ? 'Active' : 'Inactive' ?></td>
                            </tr>

                        </tbody>
                    </table>
                </div>

            </div>
            <div class="col-12">
                <hr>
                <h2>Lịch sử bình luận</h2>
                <div>
                    <table id="example2" class="table table-bordered table-striped">

                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Sản phẩm</th>
                                <th>Nội dung</th>
                                <th>Ngày bình luận</th>
                                <th>Trạng thái</th>
                                <th>Thao Tác</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($listBinhLuan as $key => $binhLuan) : ?>
                                <tr>
                                    <td><?= $key + 1 ?></td>
                                    <td><a target="_blank" href="<?= BASE_URL_ADMIN . '?act=chi-tiet-san-pham&id_san_pham=' . $binhLuan['san_pham_id']; ?>"><?= $binhLuan['ten_san_pham'] ?></a></td>
                                    <td><?= $binhLuan['noi_dung'] ?></td>
                                    <td><?= $binhLuan['ngay_dang'] ?></td>
                                    <td><?= $binhLuan['trang_thai'] == 1 ? 'Hiển thị' : 'Bị ẩn' ?></td>
                                    <td>
                                   

                                    <form action="<?= BASE_URL_ADMIN . '?act=update-trang-thai-binh-luan'?>" method="post">
                                        <input type="hidden" name="id_binh_luan" value="<?= $binhLuan['id']?>">
                                        <input type="hidden" name="name_view" value="detail_khach">
                                        <button onclick="return confirm('Bạn muốn ẩn bình luận này không?')" class="btn btn-danger">
                                            <?= $binhLuan['trang_thai'] == 1 ? 'Ẩn' : 'Bỏ ẩn' ?>
                                        </button>
                                    </form>
                                    </td>
                                </tr>

                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>

                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include './views/layout/footer.php'; ?>
<!-- Page specific script -->
<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>
</body>

</html>