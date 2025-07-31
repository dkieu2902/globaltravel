<?php 
class tourapi{
	private $conn;

	public $id;
	public $tieude;
	public $uutien;
	public $tomtat;
	public $mota;
	public $hinhanh;
	public $hienthi;
	public $thoigian;
	public $title;
	public $description;
	public $url;
	public $keywords;
	public $nguoidang;
	public $songay;

	public $matour;
	public $khoihanh;
	public $thoigianchuyen;
	
	public $diemthamquan;
	public $amthuc;
	public $doituongthichhop;
	public $thoigianlytuong;
	public $phuongtien;
	public $khuyenmai;
	public $giatu;

	public $trang;
	public $tung_trang;
	public $sp_tungtrang;
	public $danhmuc;
	public $tendanhmuc;
	public $filterdanhmuc;

	public function __construct($db){
		$this->conn = $db;
	}

	public function read(){
		$query = "SELECT * FROM tour";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}

	public function readbypage() {
	    $this->tung_trang = ($this->trang - 1) * $this->sp_tungtrang;

	    // Truy vấn để lấy tổng số bản ghi
	    $countQuery = "SELECT COUNT(*) as total FROM tour WHERE hienthi=:hienthi";

	    if (!empty($this->search)) {
	        $countQuery .= " AND tieude LIKE :search";
	    }
	    if (!empty($this->filterdanhmuc)) {
	        $countQuery .= " AND danhmuc = :filterdanhmuc";
	    }

	    $stmtCount = $this->conn->prepare($countQuery);
	    $stmtCount->bindParam(':hienthi', $this->hienthi, PDO::PARAM_INT);

	    if (!empty($this->search)) {
	        $searchParam = "%" . $this->search . "%";
	        $stmtCount->bindParam(':search', $searchParam, PDO::PARAM_STR);
	    }
	    if (!empty($this->filterdanhmuc)) {
	        $stmtCount->bindParam(':filterdanhmuc', $this->filterdanhmuc, PDO::PARAM_INT);
	    }

	    $stmtCount->execute();
	    $totalResult = $stmtCount->fetch(PDO::FETCH_ASSOC);
	    $total = $totalResult['total'];

	    // Truy vấn chính với giới hạn LIMIT
	    $query = "SELECT dd.*, kv.tendm as tendanhmuc FROM tour dd inner join danhmuc kv on dd.danhmuc = kv.madm WHERE dd.hienthi=:hienthi";

	    if (!empty($this->search)) {
	        $query .= " AND dd.tieude LIKE :search";
	    }
	    if (!empty($this->filterdanhmuc)) {
	        $query .= " AND dd.danhmuc = :filterdanhmuc";
	    }

	    $query .= " LIMIT :tungtrang, :sp_tungtrang";

	    $stmt = $this->conn->prepare($query);

	    $stmt->bindParam(':tungtrang', $this->tung_trang, PDO::PARAM_INT);
	    $stmt->bindParam(':sp_tungtrang', $this->sp_tungtrang, PDO::PARAM_INT);
	    $stmt->bindParam(':hienthi', $this->hienthi, PDO::PARAM_INT);

	    if (!empty($this->search)) {
	        $searchParam = "%" . $this->search . "%";
	        $stmt->bindParam(':search', $searchParam, PDO::PARAM_STR);
	    }
	    if (!empty($this->filterdanhmuc)) {
	        $stmt->bindParam(':filterdanhmuc', $this->filterdanhmuc, PDO::PARAM_INT);
	    }

	    $stmt->execute();

	    return array(
	        'total' => $total,
	        'data' => $stmt->fetchAll(PDO::FETCH_ASSOC)
	    );
	}

	public function show(){
		$query = "SELECT * FROM tour where id=? limit 1";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id);
		$stmt->execute();
		
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$this->id = $row['id'];	
		$this->tieude = $row['tieude'];
		$this->mota = $row['mota'];
		$this->tomtat = $row['tomtat'];	
		$this->hinhanh = $row['hinhanh'];
		$this->hienthi = $row['hienthi'];
		$this->danhmuc = $row['danhmuc'];
		$this->thoigian = $row['thoigian'];
		$this->uutien = $row['uutien'];
		$this->title = $row['title'];
		$this->description = $row['description'];
		$this->url = $row['url'];
		$this->keywords = $row['keywords'];
		$this->songay = $row['songay'];

		$this->matour = $row['matour'];
		$this->khoihanh = $row['khoihanh'];
		$this->thoigianchuyen = $row['thoigianchuyen'];
		
		$this->diemthamquan = $row['diemthamquan'];
		$this->amthuc = $row['amthuc'];
		$this->matour = $row['matour'];
		$this->doituongthichhop = $row['doituongthichhop'];
		$this->thoigianlytuong = $row['thoigianlytuong'];
		$this->phuongtien = $row['phuongtien'];
		$this->khuyenmai = $row['khuyenmai'];
		$this->giatu = $row['giatu'];
	}

	public function create(){
    $query = "INSERT INTO tour 
              SET tieude=:tieude, danhmuc=:danhmuc, uutien=:uutien, tomtat=:tomtat, mota=:mota, 
                  hienthi=:hienthi, hinhanh=:hinhanh, title=:title, 
                  description=:description, url=:url, keywords=:keywords, nguoidang=:nguoidang, matour=:matour, khoihanh=:khoihanh, thoigianchuyen=:thoigianchuyen, 
                  diemthamquan=:diemthamquan, amthuc=:amthuc, doituongthichhop=:doituongthichhop, thoigianlytuong=:thoigianlytuong, 
                  phuongtien=:phuongtien, khuyenmai=:khuyenmai, giatu=:giatu, songay=:songay";

    $stmt = $this->conn->prepare($query);

    $this->hienthi = $this->hienthi ?? '0';

    $stmt->bindParam(':tieude', $this->tieude);
    $stmt->bindParam(':danhmuc', $this->danhmuc);
    $stmt->bindParam(':uutien', $this->uutien);
    $stmt->bindParam(':tomtat', $this->tomtat);
    $stmt->bindParam(':mota', $this->mota);
    $stmt->bindParam(':hienthi', $this->hienthi);
    $stmt->bindParam(':nguoidang', $this->nguoidang);
    $stmt->bindParam(':hinhanh', $this->hinhanh);
    $stmt->bindParam(':title', $this->title);
    $stmt->bindParam(':description', $this->description);
    $stmt->bindParam(':url', $this->url);
    $stmt->bindParam(':keywords', $this->keywords);

    $stmt->bindParam(':matour', $this->matour);
    $stmt->bindParam(':khoihanh', $this->khoihanh);
    $stmt->bindParam(':thoigianchuyen', $this->thoigianchuyen);
    $stmt->bindParam(':diemthamquan', $this->diemthamquan);
    $stmt->bindParam(':amthuc', $this->amthuc);
    $stmt->bindParam(':doituongthichhop', $this->doituongthichhop);
    $stmt->bindParam(':thoigianlytuong', $this->thoigianlytuong);
    $stmt->bindParam(':phuongtien', $this->phuongtien);
    $stmt->bindParam(':khuyenmai', $this->khuyenmai);
    $stmt->bindParam(':giatu', $this->giatu);
    $stmt->bindParam(':songay', $this->songay);

    if ($stmt->execute()) {
        return true;
    }

    printf("Error: %s.\n", $stmt->error);
    return false;
}


	public function update() {  
    $query = "UPDATE tour SET 
                tieude = :tieude,  
                danhmuc = :danhmuc, 
                uutien = :uutien,
                tomtat = :tomtat, 
                mota = :mota, 
                hienthi = :hienthi,  
                title = :title, 
                description = :description, 
                url = :url, 
                keywords = :keywords
                , matour=:matour, khoihanh=:khoihanh, thoigianchuyen=:thoigianchuyen, 
                  diemthamquan=:diemthamquan, amthuc=:amthuc, doituongthichhop=:doituongthichhop, thoigianlytuong=:thoigianlytuong, 
                  phuongtien=:phuongtien, khuyenmai=:khuyenmai, giatu=:giatu, songay=:songay";

    if (!empty($this->hinhanh) && $this->hinhanh !== "undefined") {
        $query .= ", hinhanh = :hinhanh";
    }

    $query .= " WHERE id = :id";

    $stmt = $this->conn->prepare($query);

    $stmt->bindParam(':tieude', $this->tieude);
    $stmt->bindParam(':uutien', $this->uutien);
    $stmt->bindParam(':danhmuc', $this->danhmuc);
    $stmt->bindParam(':tomtat', $this->tomtat);
    $stmt->bindParam(':mota', $this->mota);
    $stmt->bindParam(':hienthi', $this->hienthi);
    $stmt->bindParam(':title', $this->title);
    $stmt->bindParam(':description', $this->description);
    $stmt->bindParam(':url', $this->url);
    $stmt->bindParam(':keywords', $this->keywords);
    $stmt->bindParam(':id', $this->id);

    $stmt->bindParam(':matour', $this->matour);
    $stmt->bindParam(':khoihanh', $this->khoihanh);
    $stmt->bindParam(':thoigianchuyen', $this->thoigianchuyen);
    $stmt->bindParam(':diemthamquan', $this->diemthamquan);
    $stmt->bindParam(':amthuc', $this->amthuc);
    $stmt->bindParam(':doituongthichhop', $this->doituongthichhop);
    $stmt->bindParam(':thoigianlytuong', $this->thoigianlytuong);
    $stmt->bindParam(':phuongtien', $this->phuongtien);
    $stmt->bindParam(':khuyenmai', $this->khuyenmai);
    $stmt->bindParam(':giatu', $this->giatu);
    $stmt->bindParam(':songay', $this->songay);

    if (!empty($this->hinhanh) && $this->hinhanh !== "undefined") {
        $stmt->bindParam(':hinhanh', $this->hinhanh);
    }
    if ($stmt->execute()) {
        return true;
    }

    printf("Error: %s.\n", $stmt->error);
    return false;
}


	public function delete(){
		$query = "DELETE FROM tour 
		WHERE id=:id";
		$stmt = $this->conn->prepare($query);

		$this->id = htmlspecialchars(strip_tags($this->id));

		$stmt->bindParam(':id',$this->id);
		if($stmt->execute()){
			return true;
		}
		printf("Error %s.\n" ,$stmt->error);
		return false;
	}
	public function updatestatus(){
		$query = "UPDATE tour SET hienthi=:hienthi WHERE id=:id";
		$stmt = $this->conn->prepare($query);

		$this->hienthi = $this->hienthi;
		$this->id = $this->id;


		$stmt->bindParam(':hienthi',$this->hienthi);
		$stmt->bindParam(':id',$this->id);
		if($stmt->execute()){
			return true;
		}
		printf("Error %s.\n" ,$stmt->error);
		return false;
	}
}	
 ?>
