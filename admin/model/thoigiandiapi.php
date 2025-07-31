<?php 
class thoigiandiapi{
	private $conn;

	public $id;
	public $tieude;
	public $thutu;
	public $tour;
	public $sochocon;
	public $tourfilter;
	public $huongdanvien;
	public $trangthai;
	public $trang;
	public $tung_trang;
	public $sp_tungtrang;

	public function __construct($db){
		$this->conn = $db;
	}

	public function readbypage() {
	    $this->tung_trang = ($this->trang - 1) * $this->sp_tungtrang;

	    // Truy vấn để lấy tổng số bản ghi
	    $countQuery = "SELECT COUNT(*) as total FROM thoigiandi WHERE trangthai = 0";

	    if (!empty($this->search)) {
	        $countQuery .= " AND tieude LIKE :search";
	    }

	    if (!empty($this->tourfilter)) {
	        $countQuery .= " AND tour = :tourfilter";
	    }

	    $stmtCount = $this->conn->prepare($countQuery);

	    if (!empty($this->search)) {
	        $searchParam = "%" . $this->search . "%";
	        $stmtCount->bindParam(':search', $searchParam, PDO::PARAM_STR);
	    }

	    if (!empty($this->tourfilter)) {
	        $stmtCount->bindParam(':tourfilter', $this->tourfilter, PDO::PARAM_INT);
	    }

	    $stmtCount->execute();
	    $totalResult = $stmtCount->fetch(PDO::FETCH_ASSOC);
	    $total = $totalResult['total'];

	    // Truy vấn chính với giới hạn LIMIT
	    $query = "SELECT tgd.*, 
       CASE 
           WHEN tgd.huongdanvien IS NOT NULL THEN hdv.hoten 
           ELSE NULL 
       END AS hoten_huongdanvien
FROM thoigiandi tgd
LEFT JOIN huongdanvien hdv ON tgd.huongdanvien = hdv.id
WHERE tgd.trangthai = 0";

	    if (!empty($this->search)) {
	        $query .= " AND tgd.tieude LIKE :search";
	    }

	    if (!empty($this->tourfilter)) {
	        $query .= " AND tgd.tour = :tourfilter";
	    }

	    $query .= " ORDER BY tgd.thutu ASC";

	    $query .= " LIMIT :tungtrang, :sp_tungtrang";


	    $stmt = $this->conn->prepare($query);

	    $stmt->bindParam(':tungtrang', $this->tung_trang, PDO::PARAM_INT);
	    $stmt->bindParam(':sp_tungtrang', $this->sp_tungtrang, PDO::PARAM_INT);

	    if (!empty($this->search)) {
	        $searchParam = "%" . $this->search . "%";
	        $stmt->bindParam(':search', $searchParam, PDO::PARAM_STR);
	    }

	    if (!empty($this->tourfilter)) {
	        $stmt->bindParam(':tourfilter', $this->tourfilter, PDO::PARAM_INT);
	    }

	    if (!empty($this->tourfilter)) {
	        $querysp = "SELECT tieude FROM tour where id = :tourfilter";
			$stmtsp = $this->conn->prepare($querysp);
			$stmtsp->bindParam(':tourfilter', $this->tourfilter, PDO::PARAM_INT);
			$stmtsp->execute();
			$rowsp = $stmtsp->fetch(PDO::FETCH_ASSOC);
			$thuoctieude = $rowsp['tieude'];
	    }

	    $stmt->execute();

	    return array(
	    	'thuoctieude' => $thuoctieude,
	        'total' => $total,
	        'data' => $stmt->fetchAll(PDO::FETCH_ASSOC)
	    );
	}

	public function show(){
		$query = "SELECT * FROM thoigiandi where id=? limit 1";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id);
		$stmt->execute();
		

		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$this->id = $row['id'];	
		$this->tieude = $row['tieude'];
		$this->thutu = $row['thutu'];
		$this->sochocon = $row['sochocon'];
		$this->tour = $row['tour'];
	}

	public function create(){
		$query = "INSERT INTO thoigiandi SET tieude=:tieude, thutu=:thutu, tour=:tour, sochocon=:sochocon";
		$stmt = $this->conn->prepare($query);

		$this->tieude = $this->tieude;
		$this->thutu = $this->thutu;
		$this->tour = $this->tour;
		$this->sochocon = $this->sochocon;

		$stmt->bindParam(':tieude',$this->tieude);
		$stmt->bindParam(':thutu',$this->thutu);
		$stmt->bindParam(':tour',$this->tour);
		$stmt->bindParam(':sochocon', $this->sochocon);
		if($stmt->execute()){
			return true;
		}
		printf("Error %s.\n" ,$stmt->error);
		return false;
	}

	public function update(){
		$query = "UPDATE thoigiandi SET tieude=:tieude, thutu=:thutu, sochocon=:sochocon where id=:id";
		$stmt = $this->conn->prepare($query);

		$this->tieude = $this->tieude;
		$this->thutu = $this->thutu;
		$this->sochocon = $this->sochocon;
		$this->id = $this->id;

		$stmt->bindParam(':tieude',$this->tieude);
		$stmt->bindParam(':thutu',$this->thutu);
		$stmt->bindParam(':sochocon', $this->sochocon);
		$stmt->bindParam(':id',$this->id);
		if($stmt->execute()){
			return true;
		}
		printf("Error %s.\n" ,$stmt->error);
		return false;
	}

	public function updatehdv(){
    	$query = "UPDATE thoigiandi SET huongdanvien=:huongdanvien WHERE id=:id";
		$stmt = $this->conn->prepare($query);

		$this->huongdanvien = $this->huongdanvien;
		$this->id = $this->id;


		$stmt->bindParam(':huongdanvien',$this->huongdanvien);
		$stmt->bindParam(':id',$this->id);
		if($stmt->execute()){
			return true;
		}
		        $query1 = "UPDATE huongdanvien SET trangthai=1 WHERE id=:huongdanvien";
	        $stmt1 = $this->conn->prepare($query1);
	        $stmt1->bindParam(':huongdanvien', $this->huongdanvien);
		printf("Error %s.\n" ,$stmt->error);
		return false;
	}

	public function delete(){
		$query = "DELETE FROM thoigiandi 
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

}	
 ?>
