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
                    <h1>Quản lý tài khoản quản trị </h1>
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluit">
            <div class="row">
                <!-- left column -->
                
                    <div class="col-md-3">
                        <div class="text-center">
                            <img src="<?= BASE_URL . $thongTin['anh_dai_dien']?>" style = "width: 100px" class="avatar img-circle" alt="avatar"
                            onerror="this.onerror=null; this.src='https://t3.ftcdn.net/jpg/05/53/79/60/360_F_553796090_XHrE6R9jwmBJUMo9HKl41hyHJ5gqt9oz.jpg'">
                            <h6 class="mt-2">Họ tên: <?= $thongTin['ho_ten'] ?> </h6>
                            <h6 class="mt-2">Chức vụ: <?= $thongTin['chuc_vu_id'] ?> </h6>

                            
                        </div>
                    </div>

                    <!-- edit form column -->
                    <div class="col-md-9 personal-info">
                    <form action="<?= BASE_URL_ADMIN . '?act=sua-thong-tin-ca-nhan-quan-tri' ?>" method="post">
                    <input type="hidden" name="ca_nhan_id" value="<?= $thongTin['id'] ?>">
                        <hr>
                        <h3>Thông tin cá nhân</h3>


                        <div class="form-group">
                            <label class="col-lg-3 control-label">Họ tên:</label>
                            <div class="col-lg-12">
                                <input class="form-control" type="text" name="ho_ten" value="<?= $thongTin['ho_ten'] ?>" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Email:</label>
                            <div class="col-lg-12">
                                <input class="form-control" type="email" name="email" value="<?= $thongTin['email'] ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Số điện thoại:</label>
                            <div class="col-lg-12">
                                <input class="form-control" type="text" name="so_dien_thoai" value="<?= $thongTin['so_dien_thoai'] ?>">
                            </div>
                        </div>
                        <div class="form-group">
                                 <label class="col-lg-3 control-label" for="inputStatus">Trạng thái:</label>
                                 <div class="col-lg-12">
                                  <select id=" inputStatus" name="trang_thai" class="form-control custom-select" > 
                                    <option <?= $thongTin['trang_thai'] == 1 ? 'seleted' : '' ?> value="1">Active</option>
                                      <option  <?= $thongTin['trang_thai'] !== 1 ? 'selected' : '' ?> value="2"> Inactive</option>
                                  </select>
                                </div>
                        </div>
                        
                        <div class="col-md-12">
                            <input type="submit" class="btn btn-primary" value="Save Changes">

                        </div>
                </form>
                <hr>
                <h3>Đổi mật khẩu</h3>
                <form action="<?= BASE_URL_ADMIN . '?act=sua-mat-khau-ca-nhan-quan-tri' ?>" method="post">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Mật khẩu cũ:</label>
                        <div class="col-md-12">
                            <input class="form-control" type="password" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Mật khẩu mới:</label>
                        <div class="col-md-12">
                            <input class="form-control" type="password" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Nhập lại mật khẩu mới:</label>
                        <div class="col-md-12">
                            <input class="form-control" type="password" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div class="col-md-12">
                            <input type="submit" class="btn btn-primary" value="Save Changes">
                        </div>
                    </div>
                </form>

            </div>
        </div>
</div>
<hr>
<!-- /.row -->
</div>
<!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include './views/layout/footer.php'; ?>
<!-- Page specific script -->

</body>

</html>