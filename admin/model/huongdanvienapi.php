<?php 
class huongdanvienapi{
	private $conn;

	public $id;
	public $hoten;
	public $gioitinh;
	public $ngaysinh;
	public $sdt;
	public $email;
	public $cccd;
	public $diachi;
	public $ngonngu;
	public $kinhnghiem;
	public $mota;
	public $hienthi;
	public $hinhanh;
	public $thoigian;
	public $trangthai;
	public $trang;
	public $tung_trang;
	public $sp_tungtrang;

	public function __construct($db){
		$this->conn = $db;
	}

	public function read(){
		$query = "SELECT * FROM huongdanvien where trangthai = 0 and hienthi = 0";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}

	public function readhuongdanvientrong($ngaydi) {
    $query = "SELECT hdv.* 
              FROM huongdanvien hdv
              WHERE hdv.hienthi = 0 
              AND hdv.id NOT IN (
                  SELECT DISTINCT tgd.huongdanvien 
                  FROM thoigiandi tgd
                  INNER JOIN tour t ON tgd.tour = t.id
                  WHERE tgd.tieude BETWEEN :ngaydi AND DATE_ADD(:ngaydi, INTERVAL t.songay DAY)
                  AND tgd.huongdanvien IS NOT NULL
              )";
    
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':ngaydi', $ngaydi, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt;
}

	public function readbypage() {
    $this->tung_trang = ($this->trang - 1) * $this->sp_tungtrang;
    
    // Truy vấn để lấy tổng số bản ghi
    $countQuery = "SELECT COUNT(*) as total FROM huongdanvien WHERE hienthi=:hienthi";
    if (!empty($this->search)) {
        $countQuery .= " AND hoten LIKE :search";
    }
    $stmtCount = $this->conn->prepare($countQuery);
    $stmtCount->bindParam(':hienthi', $this->hienthi, PDO::PARAM_INT);
    if (!empty($this->search)) {
        $searchParam = "%" . $this->search . "%";
        $stmtCount->bindParam(':search', $searchParam, PDO::PARAM_STR);
    }
    $stmtCount->execute();
    $totalResult = $stmtCount->fetch(PDO::FETCH_ASSOC);
    $total = $totalResult['total'];
    
    // Truy vấn chính với JOIN để lấy thông tin thời gian đi và tour
    $query = "SELECT hdv.*, 
                     tgd.tieude as thoigiandi_tieude,
                     t.matour as tour_matour
              FROM huongdanvien hdv
              LEFT JOIN thoigiandi tgd ON hdv.id = tgd.huongdanvien
              LEFT JOIN tour t ON tgd.tour = t.id
              WHERE hdv.hienthi = :hienthi";
    
    if (!empty($this->search)) {
        $query .= " AND hdv.hoten LIKE :search";
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
    
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Xử lý dữ liệu để group theo hướng dẫn viên
    $groupedData = [];
    foreach ($results as $row) {
        $hdvId = $row['id'];
        
        // Nếu chưa có hướng dẫn viên này trong mảng
        if (!isset($groupedData[$hdvId])) {
            // Tạo data cơ bản cho hướng dẫn viên
            $groupedData[$hdvId] = $row;
            // Xóa các field từ JOIN để tránh trùng lặp
            unset($groupedData[$hdvId]['thoigiandi_tieude']);
            unset($groupedData[$hdvId]['tour_matour']);
            // Khởi tạo mảng thời gian đi
            $groupedData[$hdvId]['thoigiandi'] = [];
        }
        
        // Nếu có thông tin thời gian đi
        if (!empty($row['thoigiandi_tieude']) && !empty($row['tour_matour'])) {
            $thoigiandiInfo = [
                'tieude' => $row['thoigiandi_tieude'],
                'matour' => $row['tour_matour']
            ];
            
            // Kiểm tra xem đã có thông tin này chưa để tránh trùng lặp
            if (!in_array($thoigiandiInfo, $groupedData[$hdvId]['thoigiandi'])) {
                $groupedData[$hdvId]['thoigiandi'][] = $thoigiandiInfo;
            }
        }
    }
    
    // Chuyển đổi từ associative array sang indexed array
    $finalData = array_values($groupedData);
    
    return array(
        'total' => $total,
        'data' => $finalData
    );
}

	public function show(){
		$query = "SELECT * FROM huongdanvien where id=? limit 1";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id);
		$stmt->execute();
		

		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$this->id = $row['id'];	
		$this->hoten = $row['hoten'];
		$this->gioitinh = $row['gioitinh'];
		$this->ngaysinh = $row['ngaysinh'];
		$this->sdt = $row['sdt'];
		$this->email = $row['email'];
		$this->cccd = $row['cccd'];
		$this->diachi = $row['diachi'];
		$this->ngonngu = $row['ngonngu'];	
		$this->kinhnghiem = $row['kinhnghiem'];
		$this->mota = $row['mota'];
		$this->hinhanh = $row['hinhanh'];		
		$this->hienthi = $row['hienthi'];
		$this->trangthai = $row['trangthai'];
		$this->thoigian = $row['thoigian'];
	}

	public function create(){
		$query = "INSERT INTO huongdanvien SET hoten=:hoten, gioitinh=:gioitinh, ngaysinh=:ngaysinh, sdt=:sdt, email=:email, cccd=:cccd, diachi=:diachi, ngonngu=:ngonngu, kinhnghiem=:kinhnghiem, mota=:mota, hienthi=:hienthi, trangthai=:trangthai, hinhanh=:hinhanh";
		$stmt = $this->conn->prepare($query);

		$this->hoten = $this->hoten;
		$this->gioitinh = $this->gioitinh;
		$this->ngaysinh = $this->ngaysinh;
		$this->sdt = $this->sdt;
		$this->email = $this->email;
		$this->cccd = $this->cccd;
		$this->diachi = $this->diachi;				
		$this->ngonngu = $this->ngonngu;
		$this->kinhnghiem = $this->kinhnghiem;
		$this->mota = $this->mota;
		$this->hinhanh = $this->hinhanh;
		$this->hienthi = $this->hienthi;
		$this->trangthai = $this->trangthai;

		$this->hienthi = isset($this->hienthi) ? $this->hienthi : '0';
		$this->trangthai = isset($this->trangthai) ? $this->trangthai : '0';

		$stmt->bindParam(':hoten',$this->hoten);
		$stmt->bindParam(':gioitinh',$this->gioitinh);
		$stmt->bindParam(':ngaysinh',$this->ngaysinh);
		$stmt->bindParam(':sdt',$this->sdt);
		$stmt->bindParam(':email',$this->email);
		$stmt->bindParam(':cccd',$this->cccd);
		$stmt->bindParam(':diachi',$this->diachi);
		$stmt->bindParam(':ngonngu',$this->ngonngu);	
		$stmt->bindParam(':kinhnghiem',$this->kinhnghiem);
		$stmt->bindParam(':mota',$this->mota);
		$stmt->bindParam(':hinhanh',$this->hinhanh);
		$stmt->bindParam(':hienthi',$this->hienthi);
		$stmt->bindParam(':trangthai',$this->trangthai);
		if($stmt->execute()){
			return true;
		}
		printf("Error %s.\n" ,$stmt->error);
		return false;
	}

	public function update() {
	    $query = "UPDATE huongdanvien SET 
	        hoten = :hoten,
	        gioitinh = :gioitinh,
	        ngaysinh = :ngaysinh,
	        sdt = :sdt,
	        email = :email,
	        cccd = :cccd,
	        diachi = :diachi,
	        ngonngu = :ngonngu,
	        kinhnghiem = :kinhnghiem,
	        mota = :mota,
	        hienthi = :hienthi";

	    // Nếu có hình ảnh thì thêm vào query
	    $hasHinhanh = !empty($this->hinhanh) && $this->hinhanh !== "undefined";
	    if ($hasHinhanh) {
	        $query .= ", hinhanh = :hinhanh";
	    }

	    $query .= " WHERE id = :id";
	    $stmt = $this->conn->prepare($query);

	    // Bind các giá trị
	    $stmt->bindParam(':hoten', $this->hoten);
	    $stmt->bindParam(':gioitinh', $this->gioitinh);
	    $stmt->bindParam(':ngaysinh', $this->ngaysinh);
	    $stmt->bindParam(':sdt', $this->sdt);
	    $stmt->bindParam(':email', $this->email);
	    $stmt->bindParam(':cccd', $this->cccd);
	    $stmt->bindParam(':diachi', $this->diachi);
	    $stmt->bindParam(':ngonngu', $this->ngonngu);
	    $stmt->bindParam(':kinhnghiem', $this->kinhnghiem);
	    $stmt->bindParam(':mota', $this->mota);
	    $stmt->bindParam(':hienthi', $this->hienthi);
	    $stmt->bindParam(':id', $this->id);

	    // Bind hình ảnh nếu có
	    if ($hasHinhanh) {
	        $stmt->bindParam(':hinhanh', $this->hinhanh);
	    }

	    if ($stmt->execute()) {
	        return true;
	    }

	    printf("Error %s.\n", $stmt->errorInfo()[2]);
	    return false;
	}


	public function delete(){
		$query = "DELETE FROM huongdanvien 
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
		$query = "UPDATE huongdanvien SET hienthi=:hienthi WHERE id=:id";
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
