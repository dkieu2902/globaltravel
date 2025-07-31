<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');

?>

<?php
/**
 * 
 */
class category
{
	private $db;
	private $fm;
	
	public function __construct()
	{
		$this->db=new database();
		$this->fm=new Format();
	}
	
	public function show_category($dm){
		$query  ="SELECT * FROM danhmuc where danhmuc='$dm' order by madm desc";
		$result = $this->db->select($query);
		return $result;
	}
	public function show_cat_condition($dieukien){
		$query  ="SELECT * FROM danhmuc $dieukien order by madm desc";
		$result = $this->db->select($query);
		return $result;
	}
	public function show_category1(){
		$query  ="SELECT * FROM danhmuc where kieuhienthi='2' and hienthi='0' order by uutien asc";
		$result = $this->db->select($query);
		return $result;
	}
	public function show_5category(){
		$query  ="SELECT * FROM danhmuc where kieuhienthi='2' order by uutien asc LIMIT 5";
		$result = $this->db->select($query);
		return $result;
	}
	public function getcatbyId($id){
		$query  ="SELECT * FROM danhmuc where madm='$id' ";
		$result = $this->db->select($query);
		return $result;
	}
	public function getcatbyUrl($url){
		$query  ="SELECT * FROM danhmuc where url='$url' ";
		$result = $this->db->select($query);
		return $result;
	}
	
	public function showtype(){
		$query  ="SELECT * FROM kieuhienthi order by id asc";
		$result = $this->db->select($query);
		return $result;	
	}

	public function show_category_fontend(){
		$query  ="SELECT * FROM danhmuc where kieuhienthi='2' order by madm desc";
		$result = $this->db->select($query);
		return $result;	
	}
	
	public function show_original(){
		$query  ="SELECT * FROM danhmuc where kieuhienthi='1' order by madm desc";
		$result = $this->db->select($query);
		return $result;
	}
	public function getoriginalbyId($id){
		$query  ="SELECT * FROM danhmuc where madm='$id' ";
		$result = $this->db->select($query);
		return $result;
	}

	public function getproductcat_byUrl($url){
		$query  ="SELECT * FROM danhmuc where url='$url' ";
		$result = $this->db->select($query);
		return $result;
	}

	public function show_categoryq($dm){
		$query  ="SELECT * FROM danhmuc where madm='$dm' ";
		$result = $this->db->select($query);
		return $result;
	}



	
}
?>