<?php	
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/format.php');
?>
<script src="js/sweetalert.min.js"></script>
<?php
/**
 * 
 */
class user
{
	private $db;
	private $fm;
	
	public function __construct()
	{
		$this->db=new database();
		$this->fm=new Format();
	}
	public function delete_user($id){
		$query  ="delete from khachhang where id='$id'";
		$result = $this->db->delete($query);
		if($result){
					$alert="<span style='color:green;font-weight:600;'>Xoá thành công </span>";
					return $alert;
				}else{
					$alert="<span style='color:red;font-weight:600;'>Xoá không thành công </span>";
					return $alert;
		}

	}
	public function get_lienhe($dieukien){
		$query = "SELECT * FROM lienhe $dieukien order by thoigian desc";
		$result =$this->db->select($query);
		return $result;
	}
	public function confirm_done($id){
		$id	= mysqli_real_escape_string($this->db->link,$id);
		$query ="update lienhe 
			set status='1' 
			
			where id='$id'";

		$result = $this->db->update($query);
		return $result;
	}
	public function xoa_lienhe($id){
		$query  ="delete from lienhe where id='$id'";
		$result = $this->db->delete($query);
		if($result){
					$alert="<span style='color:green;font-weight:600;'>Xoá thành công </span>";
					return $alert;
				}else{
					$alert="<span style='color:red;font-weight:600;'>Xoá không thành công </span>";
					return $alert;
		}

	}

	
}
?>