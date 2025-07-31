<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');

?>

<?php
/**
 * 
 */
class post
{
	private $db;
	private $fm;
	
	public function __construct()
	{
		$this->db=new database();
		$this->fm=new Format();
	}
	public function show_post_cat(){
		$query  ="SELECT * FROM danhmuc where kieuhienthi='3' order by madm desc";
		$result = $this->db->select($query);
		return $result;
	}
	public function show_1post_cat(){
		$query  ="SELECT * FROM danhmuc where kieuhienthi='3' order by uutien asc LIMIT 1";
		$result = $this->db->select($query);
		return $result;
	}
	public function getpostcatbyId($id){
		$query  ="SELECT * FROM danhmuc where madm='$id' ";
		$result = $this->db->select($query);
		return $result;
	}
	public function show_category_fontend(){
		$query  ="SELECT * FROM danhmuc where kieuhienthi='3' order by uutien asc";
		$result = $this->db->select($query);
		return $result;
	}
	public function get_blog_by_post($url,$dieukien){
		$query  ="SELECT sanpham.*,danhmuc.url as url1 FROM sanpham INNER JOIN danhmuc on sanpham.danhmuc=danhmuc.madm where danhmuc.url='$url' $dieukien";
		$result = $this->db->select($query);
		return $result;
	}
	public function get_by_post($id){
		$query  ="SELECT tintuc.*,danhmuctin.tendm,danhmuctin.madm,danhmuctin.title as title1,danhmuctin.description as mota1,danhmuctin.keywords as keywords1 from tintuc inner join danhmuctin on tintuc.danhmuc=danhmuctin.madm where tintuc.danhmuc='$id' limit 1";
		$result = $this->db->select($query);
		return $result;
	}
	public function get_blog_by_id($id){
		$query  ="SELECT * FROM tintuc where id='$id'";
		$result = $this->db->select($query);
		return $result;
	}
}
?>