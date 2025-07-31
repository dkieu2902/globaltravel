<?php	
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/format.php');
?>
<?php
/**
 * 
 */
class product
{
	private $db;
	private $fm;
	
	public function __construct()
	{
		$this->db=new database();
		$this->fm=new Format();
	}

	public function find_product($tieude){
		$query  ="SELECT * FROM sanpham where tieude='$tieude' LIMIT 1 ";
		$result = $this->db->select($query);
		if($result){
					$alert="<script language='javascript'>
								alert('Tìm thành công');	
								window.open('chi-tiet-san-pham','_self', 1);							
							</script>";
					return $alert;
				}else{
					$alert="<script language='javascript'>
								alert('Tìm không thành công');	
								window.open('trang-chu','_self', 1);							
							</script>";
					return $alert;
				
			}
	}
	public function search_product($tukhoa){
		$tukhoa	= $this->fm->validation($tukhoa);
		$query = "SELECT t.*,d.tendm FROM tour t inner join danhmuc d on t.danhmuc=d.madm WHERE t.hienthi='0' AND (t.tieude LIKE '%$tukhoa%' OR d.tendm LIKE '%$tukhoa%' OR t.mota LIKE '%$tukhoa%' OR t.tomtat LIKE '%$tukhoa%')";
		$result = $this->db->select($query);
		return $result;
	}
	public function search_blog($tukhoa){
		$tukhoa	= $this->fm->validation($tukhoa);
		$query  ="SELECT t.*,d.tendm,d.url as url1 FROM tintuc t INNER JOIN danhmuc d on t.danhmuc=d.madm where t.hienthi='0' and (t.tieude like '%$tukhoa%' or t.mota like '%$tukhoa%' or t.noidung like '%$tukhoa%') order by t.thoigian desc";
		$result = $this->db->select($query);
		return $result;
	}

	public function show_slider(){
		$query  ="
		SELECT *
		FROM slider
		where loai='1'
		order by id desc";
		//$query  ="SELECT * FROM sanpham order by masp desc";
		$result = $this->db->select($query);
		return $result;
	}
	public function show_slider1(){
		$query  ="
		SELECT *
		FROM slider
		
		order by id desc";
		//$query  ="SELECT * FROM sanpham order by masp desc";
		$result = $this->db->select($query);
		return $result;
	}

	public function get_image_by_id($id){
		$query  ="SELECT * FROM slider where id='$id' ";
		$result = $this->db->select($query);
		return $result;
	}
	
	public function getcacdiadiem($dieukien){
		$sp_tungtrang = 40;
		if(!isset($_GET['trang'])){
			$trang = 1;

		}else{
			$trang = $_GET['trang'];
		}
		$tung_trang = ($trang-1)*40;
		$query  ="SELECT * FROM diadiem where hienthi='0' $dieukien order by uutien desc limit $tung_trang,$sp_tungtrang";
		$result = $this->db->select($query);
		return $result;
	}

	public function get3blog(){
		$query  ="SELECT * FROM tintuc where danhmuc='4' order by thoigian desc LIMIT 3";
		$result = $this->db->select($query);
		return $result;
	}

	public function gettour(){
	    $query  = "SELECT t.*, dm.tendm 
	               FROM tour t 
	               INNER JOIN danhmuc dm ON t.danhmuc = dm.madm 
	               WHERE t.hienthi = '0' 
	               ORDER BY t.uutien ASC, t.thoigian DESC LIMIT 12";
	    $result = $this->db->select($query);
	    return $result;
	}

	public function getTourTheoSoLuongDat() {
	    $query = "
	        SELECT 
	            t.*, 
	            dm.tendm, 
	            SUM(d.soluong) AS tong_soluong
	        FROM 
	            tour t
	        INNER JOIN 
	            danhmuc dm ON t.danhmuc = dm.madm
	        INNER JOIN 
	            dondattour d ON t.matour = d.matour
	        WHERE 
	            t.hienthi = 0 and d.status = 1
	        GROUP BY 
	            t.id
	        HAVING 
	            tong_soluong > 0
	        ORDER BY 
	            tong_soluong DESC
	        LIMIT 6
	    ";
	    $result = $this->db->select($query);
	    return $result;
	}




	public function gettourindex(){
	    $query  = "SELECT t.*, dm.tendm 
	               FROM tour t 
	               INNER JOIN danhmuc dm ON t.danhmuc = dm.madm 
	               WHERE t.hienthi = '0'";
	    $result = $this->db->select($query);
	    return $result;
	}

	public function gettourbydm($dm){
	    $query  = "SELECT t.*, dm.tendm 
	               FROM tour t 
	               INNER JOIN danhmuc dm ON t.danhmuc = dm.madm 
	               WHERE t.hienthi = '0' and dm.url='$dm'";
	    $result = $this->db->select($query);
	    return $result;
	}

	public function getthoigiandibytour($tour){
		$query  ="SELECT * FROM thoigiandi where tour='$tour' and sochocon > 0 and trangthai = 0 order by thutu asc";
		$result = $this->db->select($query);
		return $result;
	}

	public function getproduct_all($dieukien){
		$sp_tungtrang = 40;
		if(!isset($_GET['trang'])){
			$trang = 1;

		}else{
			$trang = $_GET['trang'];
		}
		$tung_trang = ($trang-1)*40;
		$query  ="SELECT * FROM goi $dieukien limit $tung_trang,$sp_tungtrang";
		$result = $this->db->select($query);
		return $result;
	}

	// Hàm lấy tour với bộ lọc và sắp xếp
	public function getFilteredTours($budget = '', $dongTour = '', $sortBy = 'date_asc') {
		$query = "SELECT t.*, dm.tendm, MIN(tgd.tieude) as ngay_gan_nhat 
				  FROM tour t 
				  INNER JOIN danhmuc dm ON t.danhmuc = dm.madm 
				  LEFT JOIN thoigiandi tgd ON t.id = tgd.tour AND tgd.thutu = 1
				  WHERE t.hienthi = '0'";
		
		// Lọc theo ngân sách (giá)
		if (!empty($budget)) {
			if ($budget == 'duoi5') {
				$query .= " AND t.giatu < 5000000";
			} elseif ($budget == '5-10') {
				$query .= " AND t.giatu >= 5000000 AND t.giatu <= 10000000";
			} elseif ($budget == '10-20') {
				$query .= " AND t.giatu > 10000000 AND t.giatu <= 20000000";
			} elseif ($budget == 'tren20') {
				$query .= " AND t.giatu > 20000000";
			}
		}
		
		// Lọc theo dòng tour (danh mục)
		if (!empty($dongTour)) {
			$query .= " AND t.danhmuc = '$dongTour'";
		}
		
		$query .= " GROUP BY t.id";
		
		// Sắp xếp
		if ($sortBy == 'date_asc') {
			$query .= " ORDER BY ngay_gan_nhat ASC";
		} elseif ($sortBy == 'date_desc') {
			$query .= " ORDER BY ngay_gan_nhat DESC";
		} elseif ($sortBy == 'price_asc') {
			$query .= " ORDER BY t.giatu ASC";
		} elseif ($sortBy == 'price_desc') {
			$query .= " ORDER BY t.giatu DESC";
		}
		
		$result = $this->db->select($query);
		return $result;
	}

	// Lấy ngày khởi hành gần nhất của tour
	public function getNearestDepartureDate($tourId) {
		$query = "SELECT tieude FROM thoigiandi 
				  WHERE tour = '$tourId' and sochocon > 0 and trangthai = 0
				  ORDER BY STR_TO_DATE(tieude, '%d/%m/%Y') ASC 
				  LIMIT 5";
		$result = $this->db->select($query);
		return $result;
	}

	public function get_blogdetailsbyUrl($url){
		$query  ="
		SELECT tt.*,dd.tendm,dd.url as url1
		FROM tintuc tt INNER JOIN danhmuc dd on tt.danhmuc=dd.madm
		where tt.url='$url'";
		
		$result = $this->db->select($query);
		return $result;
	}
	public function get_tourdetailsbyUrl($url){
		$query  ="
		SELECT tt.*,dd.tendm,dd.url as url1
		FROM tour tt INNER JOIN danhmuc dd on tt.danhmuc=dd.madm
		where tt.url='$url'";
		
		$result = $this->db->select($query);
		return $result;
	}

	public function getcacchuongtrinhkhac($url) {
		$query = "SELECT t.*, dm.tendm 
				  FROM tour t 
				  INNER JOIN danhmuc dm ON t.danhmuc = dm.madm 
				  WHERE t.url != '$url' ORDER BY uutien desc,thoigian desc LIMIT 3";
		
		$result = $this->db->select($query);
		return $result;
	}
	public function gethinhanhtourbytour($tour) {
		$query = "SELECT * 
				  FROM hinhanhtour
				  WHERE tour = '$tour'";
		
		$result = $this->db->select($query);
		return $result;
	}
	
	public function thaydoitrangthai() {
	    $ngayHienTai = date('Y-m-d');
	    $ngayTru2Ngay = date('Y-m-d', strtotime($ngayHienTai . ' -2 days'));
	    
	    $queryUpdate = "UPDATE thoigiandi 
	                    SET trangthai = 1 
	                    WHERE tieude < '$ngayTru2Ngay'";
	    
	    $updateResult = $this->db->update($queryUpdate);
	    
	    $querySelect = "SELECT * FROM thoigiandi";
	    $result = $this->db->select($querySelect);
	    
	    return $result;
	}
	public function getlichtrinhbytour($tour) {
		$query = "SELECT * 
				  FROM lichtrinh
				  WHERE tour = '$tour' order by thutu asc";
		
		$result = $this->db->select($query);
		return $result;
	}
	public function getluuybytour($tour) {
		$query = "SELECT * 
				  FROM thongtintour
				  WHERE tour = '$tour' order by thutu asc";
		
		$result = $this->db->select($query);
		return $result;
	}
	public function getlichkhoihanhbytour($tour) {
		$query = "SELECT * 
				  FROM thoigiandi
				  WHERE tour = '$tour' and sochocon > 0 and trangthai = 0 order by thutu asc";
		
		$result = $this->db->select($query);
		return $result;
	}
	public function getthoigiandibyid($id) {
		$query = "SELECT * 
				  FROM thoigiandi
				  WHERE id = '$id'";
		
		$result = $this->db->select($query);
		return $result;
	}

	public function booktour($quantity,$thoigiandi,$khachhang,$hoten,$sdt,$email,$url){
		$quantity	= $this->fm->validation($quantity);
		$quantity	= mysqli_real_escape_string($this->db->link,$quantity);
		$thoigiandi	= $this->fm->validation($thoigiandi);
		$thoigiandi	= mysqli_real_escape_string($this->db->link,$thoigiandi);
		$khachhang	= $this->fm->validation($khachhang);
		$khachhang	= mysqli_real_escape_string($this->db->link,$khachhang);
		$status = '0';
		$sId = session_id();
		$url	= mysqli_real_escape_string($this->db->link,$url);
		$hoten	= mysqli_real_escape_string($this->db->link,$hoten);
		$sdt	= mysqli_real_escape_string($this->db->link,$sdt);
		$email	= mysqli_real_escape_string($this->db->link,$email);
		$query = "SELECT * FROM tour where url='$url'";
		$result = $this->db->select($query)->fetch_assoc();
		$id = $result['id'];
		$matour = $result['matour'];
		$tieude = $result['tieude'];
		$gia = $result['giatu'] * $quantity;
		$query4 = "SELECT * FROM thoigiandi where id='$thoigiandi'";
						$get_tonkho =$this->db->select($query4);
						if ($get_tonkho) {
							while($result4 = $get_tonkho->fetch_assoc()){
								$soluongmoi = $result4['sochocon'] - $quantity;
								$query5 ="update thoigiandi 
								set sochocon='$soluongmoi' 								
								where id='$thoigiandi'";

								$result5 = $this->db->update($query5);
							}
						}
		if($khachhang == 0){
			$check_cart =  "SELECT * FROM dondattour where matour='$matour' and sid='$sId' and status='0'";
			$get_product =$this->db->select($check_cart);
			if($get_product){	
				while($result2 = $get_product->fetch_assoc()){		
					$soluongmoi = $result2['soluong'] + $quantity;
					$giatien = $soluongmoi * $result['giatu'];
					$query3 ="update dondattour 
					set soluong='$soluongmoi',
					gia = '$giatien' 
					
					where matour='$matour' and sid='$sId'";

					$result3 = $this->db->update($query3);
					if($result3){
						return '00';
					}else{
						return '01';
					}
				}
			}else{		
				$query_cart ="insert into dondattour(matour,sid,tentour,gia,soluong,thoigiandi,khachhang,hoten,sdt,email,status) values('$matour','$sId','$tieude',$gia,'$quantity','$thoigiandi','$khachhang','$hoten','$sdt','$email','$status')";
						$result_cart =$this->db->insert($query_cart);
						if($result_cart){
						return '00';
					}else{
						return '01';
					}
			}
		}else{
			$check_cart =  "SELECT * FROM dondattour where matour='$matour' and khachhang='$khachhang' and status='0'";
			$get_product =$this->db->select($check_cart);
			if($get_product){	
				while($result2 = $get_product->fetch_assoc()){		
					$soluongmoi = $result2['soluong'] + $quantity;
					$giatien = $soluongmoi * $result['giatu'];
					$query3 ="update dondattour 
					set soluong='$soluongmoi',
					gia = '$giatien' 
					
					where matour='$matour' and sid='$sId'";

					$result3 = $this->db->update($query3);
					if($result3){
						return '00';
					}else{
						return '01';
					}
				}
			}else{		
				$query_cart ="insert into dondattour(matour,sid,tentour,gia,soluong,thoigiandi,khachhang,hoten,sdt,email,status) values('$matour','$sId','$tieude',$gia,'$quantity','$thoigiandi','$khachhang','$hoten','$sdt','$email','$status')";
						$result_cart =$this->db->insert($query_cart);
						if($result_cart){
						return '00';
					}else{
						return '01';
					}
			}
		}
		
				
	}


}
?>