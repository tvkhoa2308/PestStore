<?php
class TaiKhoan
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }
    public function checkLogin($email,$mat_khau){
        try {
            $sql = 'SELECT * FROM tai_khoans WHERE email = :email';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['email' => $email]);
            $user = $stmt->fetch();
            if ($user && password_verify($mat_khau, $user['mat_khau'] )) {
                if($user['chuc_vu_id'] == 2 ){
                    if ($user['trang_thai'] == 1) {
                        return $user['email']; //trường hợp đăng nhập thành công
                    }else{
                   return 'tài khoản bị cấm';
                    }
                }else{
                    return 'tài khoản không có quyền đăng nhập';
                }
            }else{
                return 'Nhập sai thông tin tài khoản hoặc mật khẩu';
            }
        } catch (\Exception $e) {
            echo 'Lỗi: '. $e->getMessage();
            return false;
        }
    }

}