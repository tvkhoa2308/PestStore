<?php
class AdminTaiKhoanController
{
  public $modelTaiKhoan;
  public $modelSanPham;

  public function __construct()
  {
    $this->modelTaiKhoan = new AdminTaiKhoan();
    $this->modelSanPham = new AdminSanPham();
  }

  public function danhSachQuanTri()
  {
    $listQuanTri = $this->modelTaiKhoan->getAllTaiKhoan(1);
    // var_dump($listQuanTri);die();
    require_once './views/taikhoan/quantri/listQuanTri.php';
  }
  public function formAddQuanTri()
  {
    require_once './views/taikhoan/quantri/addQuanTri.php';

    deleteSessionError();
  }
  public function postAddQuanTri()
  {
    // var_dump($_POST);
    // dùng để thêm dữ liệu xử lý dữ liệu
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $ho_ten = $_POST['ho_ten'];
      $email = $_POST['email'];

      $errors = [];
      if (empty($ho_ten)) {
        $errors['ho_ten'] = 'Tên không được để trống';
      }
      if (empty($email)) {
        $errors['email'] = 'Email không được để trống';
      }

      $_SESSION['error'] = $errors;
      //nếu k có lỗi thì tiến hành thêm tài khoản
      if (empty($errors)) {
        //nếu k có lỗi thì tiến hành thêm tài khoản
        // var_dump('ac');die;
        //đặt password mặc định
        $password = password_hash('230805', PASSWORD_BCRYPT);
        //  var_dump($password);die();
        //khai báo chức vụ
        $chuc_vu_id = 1;

        $taikhoan = $this->modelTaiKhoan->insertTaiKhoan($ho_ten, $email, $password, $chuc_vu_id);
        // var_dump($taikhoan);die();
        header("Location: " . BASE_URL_ADMIN . '?act=list-tai-khoan-quan-tri');
        exit();
      } else {
        //trả lỗi
        $_SESSION['flash'] = true;

        header("Location: " . BASE_URL_ADMIN . '?act=form-them-quan-tri');
        exit();
      }
    }
  }
  public function formEditQuanTri()
  {
    $id_quan_tri = $_GET['id_quan_tri'];
    $quanTri = $this->modelTaiKhoan->getDetailTaiKhoan($id_quan_tri);
    // var_dump($quanTri);die();
    require_once './views/taikhoan/quantri/editQuanTri.php';
    deleteSessionError();
  }
  public function postEditQuanTri()
  {
    // var_dump($_POST);
    // dùng để thêm dữ liệu xử lý dữ liệu
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

      //lấy ra dữu liệu
      $quan_tri_id = $_POST['quan_tri_id'] ?? '';


      $ho_ten = $_POST['ho_ten'] ?? '';
      $email = $_POST['email'] ?? '';
      $so_dien_thoai = $_POST['so_dien_thoai'] ?? '';
      $trang_thai = $_POST['trang_thai'] ?? '';





      $errors = [];


      if (empty($ho_ten)) {
        $errors['ho_ten'] = 'Tên không được để trống';
      }
      if (empty($email)) {
        $errors['email'] = 'Email không được để trống';
      }
      if (empty($trang_thai)) {
        $errors['trang_thai'] = 'Vui lòng cập nhật trạng thái';
      }



      $_SESSION['error'] = $errors;
      // var_dump($errors);die();

      if (empty($errors)) {

        $this->modelTaiKhoan->updateTaiKhoan(
          $quan_tri_id,
          $ho_ten,
          $email,
          $so_dien_thoai,
          $trang_thai
        );
        // var_dump($status);die();                                 
        header("Location: " . BASE_URL_ADMIN . '?act=list-tai-khoan-quan-tri');
        exit();
      } else {
        //trả lỗi

        //đặt chỉ thị xóa session sau khi hiển thị form
        $_SESSION['flash'] = true;
        header("Location: " . BASE_URL_ADMIN . '?act=form-sua-quan-tri&id_quan_tri=' . $quan_tri_id);
        exit();
      }
    }
  }

  public function resetPassword()
  {
    $tai_khoan_id = $_GET['id_quan_tri'];
    $tai_khoan = $this -> modelTaiKhoan->getDetailTaiKhoan($tai_khoan_id);
    $password = password_hash('230805', PASSWORD_BCRYPT);

   $status = $this->modelTaiKhoan->resetPassword($tai_khoan_id, $password);
   if ($status && $tai_khoan['chuc_vu_id'] == 1) {
    header('Location: ' . BASE_URL_ADMIN . '?act=list-tai-khoan-quan-tri');
    exit();
   }elseif($status && $tai_khoan['chuc_vu_id'] == 2){
     header('Location: ' . BASE_URL_ADMIN . '?act=list-tai-khoan-khach-hang');
     exit();
   }else{
    var_dump('Loi khi reset taif khoan');die();
   }
  }
  public function danhSachKhachHang()
  {
    $listKhachHang = $this->modelTaiKhoan->getAllTaiKhoan(2);
    // var_dump($listQuanTri);die();
    require_once './views/taikhoan/khachhang/listKhachHang.php';
  }
  public function formEditKhachHang()
  {
    $id_khach_hang = $_GET['id_khach_hang'];
    $khachHang = $this->modelTaiKhoan->getDetailTaiKhoan($id_khach_hang);
   
    require_once './views/taikhoan/khachhang/editKhachHang.php';
    deleteSessionError();
  }
  public function postEditKhachHang()
  {
    // var_dump($_POST);
    // dùng để thêm dữ liệu xử lý dữ liệu
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

      //lấy ra dữu liệu
      $khach_hang_id = $_POST['khach_hang_id'] ?? '';


      $ho_ten = $_POST['ho_ten'] ?? '';
      $email = $_POST['email'] ?? '';
      $so_dien_thoai = $_POST['so_dien_thoai'] ?? '';
      $ngay_sinh = $_POST['ngay_sinh'] ?? '';
      $gioi_tinh = $_POST['gioi_tinh'] ?? '';
      $dia_chi = $_POST['dia_chi'] ?? '';
      $trang_thai = $_POST['trang_thai'] ?? '';





      $errors = [];


      if (empty($ho_ten)) {
        $errors['ho_ten'] = 'Tên không được để trống';
      }
      if (empty($email)) {
        $errors['email'] = 'Email không được để trống';
      }
      if (empty($ngay_sinh)) {
        $errors['ngay_sinh'] = 'Ngày sinh không được để trống';
      }
      if (empty($gioi_tinh)) {
        $errors['gioi_tinh'] = 'giới tính không được để trống';
      }
      
      if (empty($trang_thai)) {
        $errors['trang_thai'] = 'Vui lòng cập nhật trạng thái';
      }



      $_SESSION['error'] = $errors;
      // var_dump($errors);die();

      if (empty($errors)) {

        $this->modelTaiKhoan->updateKhachHang(
          $khach_hang_id,
          $ho_ten,
          $email,
          $so_dien_thoai,
          $ngay_sinh,
          $gioi_tinh,
          $dia_chi,
          $trang_thai
        );
        // var_dump($status);die();                                 
        header("Location: " . BASE_URL_ADMIN . '?act=list-tai-khoan-khach-hang');
        exit();
      } else {
        //trả lỗi

        //đặt chỉ thị xóa session sau khi hiển thị form
        $_SESSION['flash'] = true;
        header("Location: " . BASE_URL_ADMIN . '?act=form-sua-khach-hang&id_khach_hang=' . $khach_hang_id);
        exit();
      }
    }
  }
  public function deltailKhachHang(){
    $id_khach_hang = $_GET['id_khach_hang'];
    $khachHang = $this->modelTaiKhoan->getDetailTaiKhoan($id_khach_hang);

    $listBinhLuan = $this->modelSanPham->getBinhLuanFromKhachHang($id_khach_hang);
  

    require_once './views/taikhoan/khachhang/detailKhachHang.php';
  }



  public function formLogin(){
    require_once './views/auth/formLogin.php';
    deleteSessionError();
  }
  public function login(){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      //lấy email và pass gửi lên từ form
      $email = $_POST['email'];
      $password = $_POST['password'];
      // var_dump($password);die();

      //xử lý kiểm tra thông tin đăng nhập

      $user = $this -> modelTaiKhoan->checkLogin($email,$password);
      if ($user == $email) { //trường hợp đăng nhập thành công
        //lưu thông tin vào session
        $_SESSION['user_admin'] = $user;
        header('Location: ' . BASE_URL_ADMIN);
        exit();

      }else{
            //lỗi thì lưu lỗi vào session
            $_SESSION['error'] = $user;

            // var_dump($_SESSION['error']);die();
            $_SESSION['flash'] = true;

            header('Location: ' . BASE_URL_ADMIN . '?act=login-admin');
            exit();
      }
    }
  }
  public function logout(){
    if(isset($_SESSION['user_admin'])){
        unset($_SESSION['user_admin']);
        header('Location: '. BASE_URL_ADMIN .'?act=login-admin');
    }
}
public function formEditCaNhanQuanTri(){
  $email = $_SESSION['user_admin'];
  $thongTin = $this->modelTaiKhoan->getTaiKhoanformEmail($email);
  // var_dump($thongTin);die();
  require_once './views/taikhoan/canhan/editCaNhan.php';
  deleteSessionError();
}
  public function postEditCaNhanQuanTri(){
    // var_dump($_POST);
    // dùng để thêm dữ liệu xử lý dữ liệu
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

      //lấy ra dữu liệu
      $ca_nhan_id = $_POST['ca_nhan_id'] ?? '';


      $ho_ten = $_POST['ho_ten'] ?? '';
      $email = $_POST['email'] ?? '';
      $so_dien_thoai = $_POST['so_dien_thoai'] ?? '';
      $trang_thai = $_POST['trang_thai'] ?? '';





      $errors = [];


      if (empty($ho_ten)) {
        $errors['ho_ten'] = 'Tên không được để trống';
      }
      if (empty($email)) {
        $errors['email'] = 'Email không được để trống';
      }
      
      if (empty($trang_thai)) {
        $errors['trang_thai'] = 'Vui lòng cập nhật trạng thái';
      }



      $_SESSION['error'] = $errors;
      // var_dump($errors);die();

      if (empty($errors)) {

        $this->modelTaiKhoan->updateQuanTriCaNhan($ca_nhan_id,
          $ho_ten,
          $email,
          $so_dien_thoai,
          $trang_thai
        );
        // var_dump($status);die();                                 
        header("Location: " . BASE_URL_ADMIN . '?act=list-tai-khoan-quan-tri');
        exit();
      } else {
        //trả lỗi

        //đặt chỉ thị xóa session sau khi hiển thị form
        $_SESSION['flash'] = true;
        header("Location: " . BASE_URL_ADMIN . '?act=form-sua-quan-tri&quan_tri_id=' .  $ca_nhan_id);
        exit();
      }
    }
  }
}
