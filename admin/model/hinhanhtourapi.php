<?php 
class hinhanhtourapi{
	private $conn;

	public $id;
	public $tour;
	public $hinhanh;
	public $tentour;
	public $trang;
	public $tung_trang;
	public $sp_tungtrang;
	public $filtertour;

	public function __construct($db){
		$this->conn = $db;
	}

	public function read(){
		$query = "SELECT * FROM hinhanhtour";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}

	public function readbypage() {
	    $this->tung_trang = ($this->trang - 1) * $this->sp_tungtrang;

	    // Truy vấn để lấy tổng số bản ghi
	    $countQuery = "SELECT COUNT(*) as total FROM hinhanhtour WHERE tour=:filtertour";

	    $stmtCount = $this->conn->prepare($countQuery);
	    $stmtCount->bindParam(':filtertour', $this->filtertour, PDO::PARAM_INT);

	    $stmtCount->execute();
	    $totalResult = $stmtCount->fetch(PDO::FETCH_ASSOC);
	    $total = $totalResult['total'];

	    // Truy vấn chính với giới hạn LIMIT
	    $query = "SELECT * FROM hinhanhtour WHERE tour=:filtertour";

	    $query .= " LIMIT :tungtrang, :sp_tungtrang";

	    $stmt = $this->conn->prepare($query);

	    $stmt->bindParam(':tungtrang', $this->tung_trang, PDO::PARAM_INT);
	    $stmt->bindParam(':sp_tungtrang', $this->sp_tungtrang, PDO::PARAM_INT);
	    $stmt->bindParam(':filtertour', $this->filtertour, PDO::PARAM_INT);

	    $stmt->execute();

	    if (!empty($this->filtertour)) {
	        $querysp = "SELECT tieude FROM tour where id = :filtertour";
			$stmtsp = $this->conn->prepare($querysp);
			$stmtsp->bindParam(':filtertour', $this->filtertour, PDO::PARAM_INT);
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
		$query = "SELECT * FROM hinhanhtour where id=? limit 1";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id);
		$stmt->execute();
		
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$this->id = $row['id'];	
		$this->tour = $row['tour'];
		$this->hinhanh = $row['hinhanh'];
	}

	public function create(){
    $query = "INSERT INTO hinhanhtour 
              SET hinhanh=:hinhanh, tour=:tour";

    $stmt = $this->conn->prepare($query);

    $stmt->bindParam(':tour', $this->tour);
    $stmt->bindParam(':hinhanh', $this->hinhanh);

    if ($stmt->execute()) {
        return true;
    }

    printf("Error: %s.\n", $stmt->error);
    return false;
}


	public function update() {  
    $query = "UPDATE hinhanhtour SET 
                hinhanh = :hinhanh";

    $query .= " WHERE id = :id";

    $stmt = $this->conn->prepare($query);

    $stmt->bindParam(':hinhanh', $this->hinhanh);
    $stmt->bindParam(':id', $this->id);

    if ($stmt->execute()) {
        return true;
    }

    printf("Error: %s.\n", $stmt->error);
    return false;
}


	public function delete(){
		$query = "DELETE FROM hinhanhtour 
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
