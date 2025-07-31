<?php 
class lichtrinhapi{
	private $conn;

	public $id;
	public $tieude;
	public $noidung;
	public $thutu;
	public $tour;
	public $tourfilter;
	public $trang;
	public $tung_trang;
	public $sp_tungtrang;

	public function __construct($db){
		$this->conn = $db;
	}

	public function readbypage() {
	    $this->tung_trang = ($this->trang - 1) * $this->sp_tungtrang;

	    // Truy vấn để lấy tổng số bản ghi
	    $countQuery = "SELECT COUNT(*) as total FROM lichtrinh WHERE 1=1";

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
	    $query = "SELECT * FROM lichtrinh WHERE 1=1";

	    if (!empty($this->search)) {
	        $query .= " AND tieude LIKE :search";
	    }

	    if (!empty($this->tourfilter)) {
	        $query .= " AND tour = :tourfilter";
	    }

	    $query .= " ORDER BY thutu ASC";

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
		$query = "SELECT * FROM lichtrinh where id=? limit 1";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id);
		$stmt->execute();
		

		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$this->id = $row['id'];	
		$this->tieude = $row['tieude'];
		$this->noidung = $row['noidung'];
		$this->thutu = $row['thutu'];
		$this->tour = $row['tour'];
	}

	public function create(){
		$query = "INSERT INTO lichtrinh SET tieude=:tieude, noidung=:noidung, thutu=:thutu, tour=:tour";
		$stmt = $this->conn->prepare($query);

		$this->tieude = $this->tieude;
		$this->noidung = $this->noidung;
		$this->thutu = $this->thutu;
		$this->tour = $this->tour;

		$stmt->bindParam(':tieude',$this->tieude);
		$stmt->bindParam(':noidung',$this->noidung);
		$stmt->bindParam(':thutu',$this->thutu);
		$stmt->bindParam(':tour',$this->tour);
		if($stmt->execute()){
			return true;
		}
		printf("Error %s.\n" ,$stmt->error);
		return false;
	}

	public function update(){
		$query = "UPDATE lichtrinh SET tieude=:tieude, noidung=:noidung, thutu=:thutu where id=:id";
		$stmt = $this->conn->prepare($query);

		$this->tieude = $this->tieude;
		$this->noidung = $this->noidung;
		$this->thutu = $this->thutu;
		$this->id = $this->id;

		$stmt->bindParam(':tieude',$this->tieude);
		$stmt->bindParam(':noidung',$this->noidung);
		$stmt->bindParam(':thutu',$this->thutu);
		$stmt->bindParam(':id',$this->id);
		if($stmt->execute()){
			return true;
		}
		printf("Error %s.\n" ,$stmt->error);
		return false;
	}

	public function delete(){
		$query = "DELETE FROM lichtrinh 
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
