<?php 
class taikhoanapi{
	private $conn;

	public $id;
	public $tennd;
	public $username;
	public $password;
	public $ngaysinh;
	public $gioitinh;
	public $email;
	public $phanquyen;
	public $hienthi;
	public $sdt;
	public $diachi;
	public $trang;
	public $tung_trang;
	public $sp_tungtrang;

	public function __construct($db){
		$this->conn = $db;
	}

	public function read(){
		$query = "SELECT * FROM nguoidung";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}

	public function readbypage() {
	    $this->tung_trang = ($this->trang - 1) * $this->sp_tungtrang;

	    // Truy vấn để lấy tổng số bản ghi
	    $countQuery = "SELECT COUNT(*) as total FROM nguoidung WHERE hienthi=:hienthi";

	    if (!empty($this->search)) {
	        $countQuery .= " AND tennd LIKE :search";
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

	    // Truy vấn chính với giới hạn LIMIT
	    $query = "SELECT * FROM nguoidung WHERE hienthi=:hienthi";

	    if (!empty($this->search)) {
	        $query .= " AND tennd LIKE :search";
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

	    return array(
	        'total' => $total,
	        'data' => $stmt->fetchAll(PDO::FETCH_ASSOC)
	    );
	}

	public function show(){
		$query = "SELECT * FROM nguoidung where id=? limit 1";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id);
		$stmt->execute();
		

		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$this->id = $row['id'];	
		$this->tennd = $row['tennd'];
		$this->username = $row['username'];
		$this->password = $row['password'];
		$this->ngaysinh = $row['ngaysinh'];
		$this->gioitinh = $row['gioitinh'];
		$this->email = $row['email'];
		$this->phanquyen = $row['phanquyen'];
		$this->hienthi = $row['hienthi'];
		$this->sdt = $row['sdt'];
		$this->diachi = $row['diachi'];
	}

	public function create(){
		$query = "INSERT INTO nguoidung SET tennd=:tennd, username=:username, password=:password, hienthi=:hienthi, ngaysinh=:ngaysinh, gioitinh=:gioitinh, email=:email, phanquyen=:phanquyen, sdt=:sdt, diachi=:diachi";
		$stmt = $this->conn->prepare($query);

		$this->tennd = $this->tennd;
		$this->username = $this->username;
		$this->password = $this->password;
		$this->hienthi = $this->hienthi;
		$this->ngaysinh = $this->ngaysinh;
		$this->gioitinh = $this->gioitinh;
		$this->email = $this->email;
		$this->phanquyen = $this->phanquyen;
		$this->sdt = $this->sdt;
		$this->diachi = $this->diachi;

		$this->hienthi = isset($this->hienthi) ? $this->hienthi : '0';
		$this->password = md5($this->password);

		$stmt->bindParam(':tennd',$this->tennd);
		$stmt->bindParam(':username',$this->username);
		$stmt->bindParam(':password',$this->password);
		$stmt->bindParam(':hienthi',$this->hienthi);
		$stmt->bindParam(':ngaysinh',$this->ngaysinh);
		$stmt->bindParam(':gioitinh',$this->gioitinh);	
		$stmt->bindParam(':email',$this->email);
		$stmt->bindParam(':phanquyen',$this->phanquyen);
		$stmt->bindParam(':sdt',$this->sdt);
		$stmt->bindParam(':diachi',$this->diachi);
		if($stmt->execute()){
			return true;
		}
		printf("Error %s.\n" ,$stmt->error);
		return false;
	}

	public function update(){
		$query = "UPDATE nguoidung SET tennd=:tennd, sdt=:sdt, diachi=:diachi, username=:username, hienthi=:hienthi, ngaysinh=:ngaysinh,  gioitinh=:gioitinh, email=:email, phanquyen=:phanquyen";

		if (isset($this->password) && $this->password != null) {
	        $query .= ", password=:password";
	    }

	    $query .= " WHERE id=:id";

		$stmt = $this->conn->prepare($query);

		$this->tennd = $this->tennd;
		$this->username = $this->username;		
		$this->hienthi = $this->hienthi;
		$this->ngaysinh = $this->ngaysinh;
		$this->gioitinh = $this->gioitinh;
		$this->email = $this->email;
		$this->phanquyen = $this->phanquyen;
		$this->sdt = $this->sdt;
		$this->diachi = $this->diachi;
		$this->id = $this->id;		

		$stmt->bindParam(':tennd',$this->tennd);
		$stmt->bindParam(':username',$this->username);		
		$stmt->bindParam(':hienthi',$this->hienthi);
		$stmt->bindParam(':ngaysinh',$this->ngaysinh);
		$stmt->bindParam(':gioitinh',$this->gioitinh);	
		$stmt->bindParam(':email',$this->email);
		$stmt->bindParam(':phanquyen',$this->phanquyen);
		$stmt->bindParam(':sdt',$this->sdt);
		$stmt->bindParam(':diachi',$this->diachi);
		$stmt->bindParam(':id',$this->id);
		if (isset($this->password) && $this->password != null) {
	        $this->password = $this->password;
	        $this->password = md5($this->password);
	        $stmt->bindParam(':password',$this->password);
	    }
		if($stmt->execute()){
			return true;
		}
		printf("Error %s.\n" ,$stmt->error);
		return false;
	}

	public function delete(){
		$query = "DELETE FROM nguoidung 
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
		$query = "UPDATE nguoidung SET hienthi=:hienthi WHERE id=:id";
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
	public function changepassword(){
		$query = "UPDATE nguoidung SET password=:password WHERE id=:id";

		$stmt = $this->conn->prepare($query);

		$this->password = $this->password;
		$this->id = $this->id;		

		$this->password = md5($this->password);

	    $stmt->bindParam(':password',$this->password);
		$stmt->bindParam(':id',$this->id);

		if($stmt->execute()){
			return true;
		}
		printf("Error %s.\n" ,$stmt->error);
		return false;
	}


}	
 ?>
