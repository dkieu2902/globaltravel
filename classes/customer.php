<?php	
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/format.php');
?>
<!-- SweetAlert2 -->
<script src="js/sweetalert.min.js"></script>
<?php
/**
 * 
 */
class customer
{
	private $db;
	private $fm;
	
	public function __construct()
	{
		$this->db=new database();
		$this->fm=new Format();
	}
	public function insert_customer($data){
		$username	= mysqli_real_escape_string($this->db->link,$data['username']);
		$ten	= mysqli_real_escape_string($this->db->link,$data['ten']);
		$email	= mysqli_real_escape_string($this->db->link,$data['email']);
		$sdt	= mysqli_real_escape_string($this->db->link,$data['sdt']);
		$password	= mysqli_real_escape_string($this->db->link,md5($data['pass']));
		$password1	= mysqli_real_escape_string($this->db->link,md5($data['pass1']));
		$phanquyen = 5;
		if($ten=="" ||  $username=="" || $sdt==""|| $password=="") {
			$alert="<script language='javascript'>									
							Swal.fire({
  							title: 'Error!',
  							text: 'Hãy nhập đủ thông tin!',
  							icon: 'error'});						
							</script>";
			return $alert;
		}else{

			if($password!=$password1){
				$alert="<script language='javascript'>									
							Swal.fire({
  							title: 'Error!',
  							text: 'Bạn hãy nhập lại mật khẩu!',
  							icon: 'error'});						
							</script>";
			return $alert;
			}
			else{
			$check_email = "SELECT * from nguoidung where username='$username' limit 1";
			$result_check = $this->db->select($check_email);
			if($result_check){
				$alert="<script language='javascript'>									
							Swal.fire({
  							title: 'Error!',
  							text: 'Tài khoản này đã được tạo!',
  							icon: 'error'});						
							</script>";
			return $alert;
			}else{
				if(preg_match('/^[0-9]{10}+$/', $sdt)){
					$query ="insert into nguoidung(username,tennd,sdt,email,password,phanquyen) values('$username','$ten','$sdt','$email','$password','$phanquyen')";
				$result =$this->db->insert($query); 
				if($result){

					$alert = "<script language='javascript'>											
                    Swal.fire({
                        title: 'Success!',
                        text: 'Tạo tài khoản thành công!',
                        icon: 'success'
                    });
                    setTimeout(function(){
                        window.open('dang-nhap', '_self', 1);
                    }, 1000); // Chờ 2 giây trước khi chuyển trang
                </script>";
        return $alert;
				}else{
					$alert="<script language='javascript'>									
							Swal.fire({
  							title: 'Error!',
  							text: 'Có lỗi! Bạn hãy thử lại sau.',
  							icon: 'error'});						
							</script>";
					return $alert;
				
			}
				}else{
					$alert="<script language='javascript'>									
							Swal.fire({
  							title: 'Error!',
  							text: 'Số điện thoại không hợp lệ!',
  							icon: 'error'});						
							</script>";
				return $alert;
				}
			}
			}
		}
	}
	public function login_customer($data){
    $username = mysqli_real_escape_string($this->db->link, $data['username']);
    $password = mysqli_real_escape_string($this->db->link, md5($data['password']));

    if (empty($username) || empty($password)) {
        $alert = "<script language='javascript'>                                 
                    Swal.fire({
                        title: 'Error!',
                        text: 'Hãy nhập đủ thông tin!',
                        icon: 'error'
                    });                         
                  </script>";
        return $alert;
    } else {
        $check_login = "SELECT * FROM nguoidung WHERE username='$username' AND password='$password' LIMIT 1";
        $result_check = $this->db->select($check_login);

        if ($result_check) {
            $value = $result_check->fetch_assoc();

            if ($value['phanquyen'] == 0 || $value['phanquyen'] == 1) {
                Session::set('loginadmin', true);
                Session::set('id', $value['id']);
                Session::set('username', $value['username']);
                Session::set('tennd', $value['tennd']);
                Session::set('phanquyen', $value['phanquyen']);
                Session::set('password', $value['password']);

                if (!headers_sent()) {
                    header("Location:admin/index.php");
                    exit();
                } else {
                    echo '<script type="text/javascript">window.location.href="admin/index.php";</script>';
                    exit();
                }
            } 
            else {
                Session::set('customer_login', true);
                Session::set('customer_id', $value['id']);
                Session::set('customer_name', $value['tennd']);

                $alert = "<script language='javascript'>                                 
                            Swal.fire({
                                title: 'Success!',
                                text: 'Đăng nhập thành công!',
                                icon: 'success'
                            });

                            setTimeout(function(){
                                window.open('xin-chao', '_self', 1);
                            }, 1000);
                          </script>";
                return $alert;
            }

        } else {
            $alert = "<script language='javascript'>                                 
                        Swal.fire({
                            title: 'Error!',
                            text: 'Tên đăng nhập hoặc mật khẩu không đúng!',
                            icon: 'error'
                        });                         
                      </script>";
            return $alert;
        }
    }
}

	public function show_customer($id){
		$query = "SELECT * from nguoidung where id='$id' ";
			$result = $this->db->select($query);
			return $result;
	}
	public function update_customer($data,$id){
		$ten	= mysqli_real_escape_string($this->db->link,$data['ten']);
		$email	= mysqli_real_escape_string($this->db->link,$data['email']);		
		$sdt	= mysqli_real_escape_string($this->db->link,$data['sdt']);
		$diachi	= mysqli_real_escape_string($this->db->link,$data['diachi']);
		if($ten=="" || $sdt=="" ) {
			$alert="<script language='javascript'>									
							Swal.fire({
  							title: 'Error!',
  							text: 'Hãy nhập đủ thông tin!',
  							icon: 'error'});						
							</script>";
			return $alert;
		}else{
			
						

			if(preg_match('/^[0-9]{10}+$/', $sdt)){
					$query ="UPDATE nguoidung set tennd='$ten',email='$email',sdt='$sdt',diachi='$diachi' where id='$id'";
				$result =$this->db->update($query);
				if($result){
					$alert="<script language='javascript'>									
							Swal.fire({
  							title: 'Success!',
  							text: 'Cập nhật thành công!',
  							icon: 'success'});						
							</script>";
					return $alert;
				}else{
					$alert="<script language='javascript'>									
							Swal.fire({
  							title: 'Error!',
  							text: 'Cập nhật không thành công!',
  							icon: 'error'});						
							</script>";
					return $alert;
				
			
			}
				}else{
					$alert="<script language='javascript'>									
							Swal.fire({
  							title: 'Error!',
  							text: 'Số điện thoại không hợp lệ!',
  							icon: 'error'});						
							</script>";
				return $alert;
				}


		}
	}

	public function changepassword($data, $id) {
    $password_old    = mysqli_real_escape_string($this->db->link, md5($data['password_old']));		
    $password_new    = mysqli_real_escape_string($this->db->link, md5($data['password_new']));
    $repassword_new  = mysqli_real_escape_string($this->db->link, md5($data['repassword_new']));

    if ($password_old == "" || $password_new == "" || $repassword_new == "") {
        $alert = "<script language='javascript'>									
                    Swal.fire({
                        title: 'Error!',
                        text: 'Hãy nhập đủ thông tin!',
                        icon: 'error'
                    });						
                  </script>";
        return $alert;
    }

    $check_query = "SELECT * FROM nguoidung WHERE id='$id' AND password='$password_old' LIMIT 1";
    $check_result = $this->db->select($check_query);

    if (!$check_result) {
        $alert = "<script language='javascript'>									
                    Swal.fire({
                        title: 'Error!',
                        text: 'Mật khẩu cũ không đúng!',
                        icon: 'error'
                    });						
                  </script>";
        return $alert;
    }

    if ($password_new !== $repassword_new) {
        $alert = "<script language='javascript'>									
                    Swal.fire({
                        title: 'Error!',
                        text: 'Mật khẩu mới và xác nhận mật khẩu không giống nhau!',
                        icon: 'error'
                    });						
                  </script>";
        return $alert;
    }

    $update_query = "UPDATE nguoidung SET password='$password_new' WHERE id='$id'";
    $result = $this->db->update($update_query);

    if ($result) {
        $alert = "<script language='javascript'>									
                    Swal.fire({
                        title: 'Success!',
                        text: 'Đổi mật khẩu thành công!',
                        icon: 'success'
                    });						
                  </script>";
        return $alert;
    } else {
        $alert = "<script language='javascript'>									
                    Swal.fire({
                        title: 'Error!',
                        text: 'Đổi mật khẩu không thành công!',
                        icon: 'error'
                    });						
                  </script>";
        return $alert;
    }
}

	
}
?>