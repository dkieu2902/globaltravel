<?php 
class dondattourapi{
	private $conn;
	public $id;
	public $ten;
	public $sdt;
	public $email;
	public $matour;
	public $ngaydat;
	public $khachhang;
	public $sid;
	public $tieude;
	public $tentour;
	public $soluong;
	public $gia;
	public $status;
	public $huongdanvien;
	public $trang;
	public $tung_trang;
	public $sp_tungtrang;
	public $filterstatus;
	public $tungay;
	public $denngay;
	
	public function __construct($db){
		$this->conn = $db;
	}
	
	public function read(){
		$query = "SELECT * FROM dondattour";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}
	
	public function readbypage() {
	    $this->tung_trang = ($this->trang - 1) * $this->sp_tungtrang;
	    // Truy vấn để lấy tổng số bản ghi
	    $countQuery = "SELECT COUNT(*) as total FROM dondattour WHERE 1=1 and status = :filterstatus";
	    if (!empty($this->search)) {
	        $countQuery .= " AND tentour LIKE :search";
	    }
	    $stmtCount = $this->conn->prepare($countQuery);
	    if (!empty($this->search)) {
	        $searchParam = "%" . $this->search . "%";
	        $stmtCount->bindParam(':search', $searchParam, PDO::PARAM_STR);
	    }
	    $stmtCount->bindParam(':filterstatus', $this->filterstatus, PDO::PARAM_INT);
	    $stmtCount->execute();
	    $totalResult = $stmtCount->fetch(PDO::FETCH_ASSOC);
	    $total = $totalResult['total'];
	    // Truy vấn chính với giới hạn LIMIT
	    $query = "
				SELECT 
    d.*,
    CASE WHEN d.khachhang = 0 THEN d.hoten ELSE k.tennd END AS hoten,
    CASE WHEN d.khachhang = 0 THEN d.sdt ELSE k.sdt END AS sdt,
    CASE WHEN d.khachhang = 0 THEN d.email ELSE k.email END AS email,
    tg.tieude,
    ttt.songay,
    CASE WHEN tg.huongdanvien != 0 AND hdv.hoten IS NOT NULL THEN hdv.hoten ELSE 'Chưa có' END AS tenhdv
FROM dondattour d
INNER JOIN thoigiandi tg ON d.thoigiandi = tg.id
INNER JOIN tour ttt ON d.matour = ttt.matour
LEFT JOIN nguoidung k ON d.khachhang != 0 AND d.khachhang = k.id
LEFT JOIN huongdanvien hdv ON tg.huongdanvien != 0 AND tg.huongdanvien = hdv.id
WHERE 1=1
  AND d.status = :filterstatus";
	    if (!empty($this->search)) {
	        $query .= " AND tentour LIKE :search";
	    }
	    $query .= " LIMIT :tungtrang, :sp_tungtrang";
	    $stmt = $this->conn->prepare($query);
	    $stmt->bindParam(':tungtrang', $this->tung_trang, PDO::PARAM_INT);
	    $stmt->bindParam(':sp_tungtrang', $this->sp_tungtrang, PDO::PARAM_INT);
	    if (!empty($this->search)) {
	        $searchParam = "%" . $this->search . "%";
	        $stmt->bindParam(':search', $searchParam, PDO::PARAM_STR);
	    }
	    $stmt->bindParam(':filterstatus', $this->filterstatus, PDO::PARAM_INT);
	    $stmt->execute();
	    return array(
	        'total' => $total,
	        'data' => $stmt->fetchAll(PDO::FETCH_ASSOC)
	    );
	}
	
	// Hàm mới: Thống kê tour bán chạy theo khoảng thời gian
	public function getStatisticsByDateRange() {
	    try {
	        // 1. Lấy tổng doanh thu trong khoảng thời gian
	        $totalQuery = "
	            SELECT COALESCE(SUM(gia * soluong), 0) as tongdoanhthu 
	            FROM dondattour 
	            WHERE status = 1 
	            AND DATE(ngaydat) >= :tungay 
	            AND DATE(ngaydat) <= :denngay
	        ";
	        
	        $stmtTotal = $this->conn->prepare($totalQuery);
	        $stmtTotal->bindParam(':tungay', $this->tungay, PDO::PARAM_STR);
	        $stmtTotal->bindParam(':denngay', $this->denngay, PDO::PARAM_STR);
	        $stmtTotal->execute();
	        $totalResult = $stmtTotal->fetch(PDO::FETCH_ASSOC);
	        $tongdoanhthu = $totalResult['tongdoanhthu'];
	        
	        // 2. Lấy thống kê theo từng tour (gộp theo matour)
	        $tourQuery = "
	            SELECT 
	                matour,
	                tentour,
	                SUM(gia * soluong) as tonggia,
	                COUNT(*) as sodon,
	                SUM(soluong) as tongsoluong
	            FROM dondattour 
	            WHERE status = 1 
	            AND DATE(ngaydat) >= :tungay 
	            AND DATE(ngaydat) <= :denngay
	            GROUP BY matour, tentour
	            ORDER BY tonggia DESC
	        ";
	        
	        $stmtTour = $this->conn->prepare($tourQuery);
	        $stmtTour->bindParam(':tungay', $this->tungay, PDO::PARAM_STR);
	        $stmtTour->bindParam(':denngay', $this->denngay, PDO::PARAM_STR);
	        $stmtTour->execute();
	        $tourData = $stmtTour->fetchAll(PDO::FETCH_ASSOC);
	        
	        return array(
	            'success' => true,
	            'tongdoanhthu' => $tongdoanhthu,
	            'tour_data' => $tourData,
	            'tungay' => $this->tungay,
	            'denngay' => $this->denngay
	        );
	        
	    } catch (Exception $e) {
	        return array(
	            'success' => false,
	            'message' => 'Có lỗi xảy ra: ' . $e->getMessage(),
	            'tongdoanhthu' => 0,
	            'tour_data' => array()
	        );
	    }
	}
	
	// public function updatehdv(){
	//     try {
	//         $this->conn->beginTransaction();
	        
	//         $query = "UPDATE thoigiandi SET huongdanvien=:huongdanvien WHERE id=:id";
	//         $stmt = $this->conn->prepare($query);
	//         $stmt->bindParam(':huongdanvien', $this->huongdanvien);
	//         $stmt->bindParam(':id', $this->id);
	        
	//         if(!$stmt->execute()){
	//             throw new Exception("Lỗi khi cập nhật bảng thoigiandi: " . implode(", ", $stmt->errorInfo()));
	//         }
	        
	//         if($stmt->rowCount() == 0){
	//             throw new Exception("Không tìm thấy đơn đặt tour với ID: " . $this->id);
	//         }
	        
	//         $query1 = "UPDATE huongdanvien SET trangthai=1 WHERE id=:huongdanvien";
	//         $stmt1 = $this->conn->prepare($query1);
	//         $stmt1->bindParam(':huongdanvien', $this->huongdanvien);
	        
	//         if(!$stmt1->execute()){
	//             throw new Exception("Lỗi khi cập nhật trạng thái hướng dẫn viên: " . implode(", ", $stmt1->errorInfo()));
	//         }
	        
	//         if($stmt1->rowCount() == 0){
	//             throw new Exception("Không tìm thấy hướng dẫn viên với ID: " . $this->huongdanvien);
	//         }
	        
	//         $this->conn->commit();
	//         return true;
	        
	//     } catch (Exception $e) {
	//         // Rollback transaction nếu có lỗi
	//         $this->conn->rollback();
	//         error_log("Lỗi trong hàm update(): " . $e->getMessage());
	//         return false;
	//     }
	// }

	public function update(){
    	$query = "UPDATE dondattour SET status=:status WHERE id=:id";
		$stmt = $this->conn->prepare($query);

		$this->status = $this->status;
		$this->id = $this->id;


		$stmt->bindParam(':status',$this->status);
		$stmt->bindParam(':id',$this->id);
		if($stmt->execute()){
			return true;
		}
		printf("Error %s.\n" ,$stmt->error);
		return false;
	}
	
	public function delete(){
		$query = "DELETE FROM dondattour 
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