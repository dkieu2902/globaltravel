<?php	
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/format.php');
?>
<?php
/**
 * 
 */
class blog
{
	private $db;
	private $fm;
	
	public function __construct()
	{
		$this->db=new database();
		$this->fm=new Format();
	}
	
	public function show_blog(){
		$query  ="
		SELECT sanpham.*,danhmuc.tendm,danhmuc.url as url1 
		FROM sanpham INNER JOIN danhmuc ON sanpham.danhmuc = danhmuc.madm where sanpham.kieuhienthi='5'
		order by sanpham.uutien asc";
		$result = $this->db->select($query);
		return $result;
	}
	public function show_lastest_blog(){
		$query  ="
		SELECT tt.*,dd.tendm,dd.url as url1 
		FROM tintuc tt INNER JOIN danhmuc dd ON tt.danhmuc = dd.madm where tt.hienthi='0' AND tt.duyet='0' AND tt.thoigian <= NOW()
		order by tt.uutien desc, tt.thoigian desc LIMIT 3";
		$result = $this->db->select($query);
		return $result;
	}
	public function show_1lastest_blog(){
		$query  ="
		SELECT tt.*,dd.tendm,dd.url as url1 
		FROM tintuc tt INNER JOIN danhmuc dd ON tt.danhmuc = dd.madm where tt.hienthi='0'
		order by tt.thoigian desc LIMIT 1";
		$result = $this->db->select($query);
		return $result;
	}
	public function show_18lastest_blog($id){
		$query  ="
		SELECT tt.*,dd.tendm,dd.url as url1 
		FROM tintuc tt INNER JOIN danhmuc dd ON tt.danhmuc = dd.madm where tt.hienthi='0'
		order by tt.thoigian desc LIMIT 18";
		$result = $this->db->select($query);
		return $result;
	}

	public function show_blogbydm($dm){
		$query  ="
		SELECT tt.*,dd.tendm,dd.url as url1 
		FROM tintuc tt INNER JOIN danhmuc dd ON tt.danhmuc = dd.madm where tt.hienthi='0' AND tt.duyet='0' AND tt.thoigian <= NOW() and tt.danhmuc='$dm'
		order by tt.uutien desc,tt.thoigian desc LIMIT 32";
		$result = $this->db->select($query);
		return $result;
	}
	public function get_all(){
		$query  ="
		SELECT * 
		FROM tintuc where hienthi='0' AND duyet='0' AND thoigian <= NOW() 
		";
		$result = $this->db->select($query);
		return $result;
	}

	public function show_all_blogs(){
		$sp_tungtrang = 10;
		if(!isset($_GET['trang'])){
			$trang = 1;
		}else{
			$trang = $_GET['trang'];
		}
		$tung_trang = ($trang-1)*10;
		$query  ="
		SELECT tt.*,dd.tendm,dd.url as url1 
		FROM tintuc tt INNER JOIN danhmuc dd ON tt.danhmuc = dd.madm 
		WHERE tt.hienthi='0' AND tt.duyet='0' AND tt.thoigian <= NOW()
		ORDER BY tt.uutien DESC, tt.luotxem DESC 
		LIMIT $tung_trang,$sp_tungtrang";
		$result = $this->db->select($query);
		return $result;
	}
	public function getcontactcount(){
		$query  ="SELECT * FROM lienhe where status='0' order by thoigian desc";
		$result = $this->db->select($query);
		return $result;	
	}
	public function getinboxcount(){
		$query  ="SELECT * FROM dondattour where status='0'";
		$result = $this->db->select($query);
		return $result;	
	}

	public function show_cauhinh(){
		$query  ="
		SELECT * from cauhinh";
		$result = $this->db->select($query);
		return $result;
	}


	public function get_blog_by_id($id){
		$query  ="SELECT * FROM sanpham where id='$id' ";
		$result = $this->db->select($query);
		return $result;
	}	

	public function increase_view($url,$luotxem){
		$url	= mysqli_real_escape_string($this->db->link,$url);
		$query ="update tintuc 
			set luotxem='$luotxem' 			
			where url='$url'";

		$result = $this->db->update($query);
		return $result;
	}
	
	public function get_blogdetails($id){
		$query  ="
		SELECT tintuc.*,danhmuctin.tendm 
		FROM tintuc INNER JOIN danhmuctin ON tintuc.danhmuc = danhmuctin.madm
		where tintuc.id='$id'";
		
		$result = $this->db->select($query);
		return $result;
	}
	public function get_all_blogs(){
		$query  ="SELECT tt.*,dd.url as url1 FROM tintuc tt INNER JOIN danhmuc dd on tt.danhmuc=dd.madm where tt.hienthi='0' order by tt.luotxem desc limit 8   ";
		$result = $this->db->select($query);
		return $result;
	}
	

	
}

?>