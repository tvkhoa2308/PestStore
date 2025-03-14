<?php

class AdminDanhMucController{
  public $modelDanhMuc;
  public function __construct()
  {
    $this->modelDanhMuc = new AdminDanhMuc();
  }
  public function home(){
    echo 'hello';
  }
  
  public function danhSachDanhMuc()
  {
    $listDanhMuc = $this->modelDanhMuc->getAllDanhMuc();

    require_once './views/danhmuc/listDanhMuc.php';
  }
  public function formAddDanhMuc()
  {
    //dùng để hiển thị form nhập
    //echo 'hehe';
    require_once './views/danhmuc/addDanhMuc.php';

    deleteSessionError();
  
  }
  public function postAddDanhMuc(){ 
    // var_dump($_POST);
    // dùng để thêm dữ liệu xử lý dữ liệu
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $ten_danh_muc = $_POST['ten_danh_muc'] ?? '';
      $mo_ta = $_POST['mo_ta'];

      $errors = [];
      if (empty($ten_danh_muc)) {
        $errors['ten_danh_muc'] = 'Tên danh mục không được để trống';
      }
      if (empty($errors)) {
        // var_dump('ac');die;
       $this->modelDanhMuc->insertDanhMuc($ten_danh_muc,$mo_ta);
       header("Location: " .BASE_URL_ADMIN. '?act=danh-muc');
       exit();
      } else {
        //trả lỗi
        require_once './views/danhmuc/addDanhMuc.php';
      }
      
    
    }
   
  }
  public function formEditDanhMuc()
  {
    //dùng để hiển thị form nhập
    //echo 'hehe';
    //lấy ra thông tin danh mục cần sửa
    $id = $_GET['id_danh_muc'];
    $danhMuc = $this -> modelDanhMuc -> getDetailDanhMuc($id);
    // var_dump($danhMuc);
    // die();
    if ($danhMuc) {
      require_once './views/danhmuc/editDanhMuc.php';
    }else{
      header("Location: ". BASE_URL_ADMIN . '?act=danh-muc');
      exit();
    }
    
  
  }
  public function postEditDanhMuc(){ 
    // var_dump($_POST);
    // dùng để thêm dữ liệu xử lý dữ liệu
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $id = $_POST['id'];
      $ten_danh_muc = $_POST['ten_danh_muc'];
      $mo_ta = $_POST['mo_ta'];

      $errors = [];
      if (empty($ten_danh_muc)) {
        $errors['ten_danh_muc'] = 'Tên danh mục không được để trống';
      }
      if (empty($errors)) {
        // var_dump('ac');die;
       $this->modelDanhMuc->updateDanhMuc($id,$ten_danh_muc,$mo_ta);
       header("Location: " .BASE_URL_ADMIN. '?act=danh-muc');
       exit();
      } else {
        //trả lỗi
        $danhMuc = ['id' => $id,'ten_danh_muc' => $ten_danh_muc, 'mo_ta' => $mo_ta];
        require_once './views/danhmuc/editDanhMuc.php';
      }
      
    }
   
  }
  public function deleteDanhMuc(){
    $id = $_GET['id_danh_muc'];
    $danhMuc = $this -> modelDanhMuc -> getDetailDanhMuc($id);
   if ($danhMuc) {
    $this->modelDanhMuc->destroyDanhMuc($id);
   }
    header("Location: " .BASE_URL_ADMIN. '?act=danh-muc');
       exit();
   
  }
}