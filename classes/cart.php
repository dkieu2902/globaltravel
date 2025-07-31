<?php	
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/format.php');
include_once ($filepath.'/../mail/sendmail.php');
?>
<script src="js/sweetalert.min.js"></script>
<?php
/**
 * 
 */
class cart
{
	private $db;
	private $fm;
	
	public function __construct()
	{
		$this->db=new database();
		$this->fm=new Format();
	}
	public function check_order1($customer_id){		
		$query = "SELECT * FROM dondattour where khachhang='$customer_id'";
		$result =$this->db->select($query);
		return $result;
	}
	public function check_order(){
		$sId = session_id();
		$query = "SELECT * FROM dondattour where sId='$sId'";
		$result =$this->db->select($query);
		return $result;
	}
	public function get_details_cart($customer_id){		
		$query = "SELECT d.*, t.tieude as khoihanh,tt.url FROM dondattour d inner join thoigiandi t on d.thoigiandi=t.id inner join tour tt on d.matour=tt.matour where d.khachhang='$customer_id' and d.status='0'";
		$result =$this->db->select($query);
		return $result;
	}
	public function get_details_cart1(){	
		$sId = session_id();	
		$query = "SELECT d.*, t.tieude as khoihanh,tt.url FROM dondattour d inner join thoigiandi t on d.thoigiandi=t.id inner join tour tt on d.matour=tt.matour where d.sId='$sId' and d.status='0'";
		$result =$this->db->select($query);
		return $result;
	}
	public function get_history_cart($customer_id){		
		$query = "SELECT d.*, t.tieude as khoihanh,tt.url FROM dondattour d inner join thoigiandi t on d.thoigiandi=t.id inner join tour tt on d.matour=tt.matour where d.khachhang='$customer_id' and d.status='1'";
		$result =$this->db->select($query);
		return $result;
	}

}
?>