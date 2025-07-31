<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    include_once('../../config/db.php');
    include_once('../../model/huongdanvienapi.php');
    
    $db = new db();
    $connect = $db->connect();
    $huongdanvienapi = new huongdanvienapi($connect);
    
    // Lấy ngaydi từ GET parameter
    $ngaydi = isset($_GET['ngaydi']) ? $_GET['ngaydi'] : null;
    
    if ($ngaydi) {
        // Gọi method readhuongdanvientrong với ngaydi
        $read = $huongdanvienapi->readhuongdanvientrong($ngaydi);
    } else {
        // Nếu không có ngaydi, trả về lỗi
        echo json_encode([
            'success' => false,
            'message' => 'Thiếu tham số ngaydi'
        ]);
        exit;
    }
    
    $num = $read->rowCount();
    
    if($num > 0){
        $huongdanvienapi_array = [];
        $huongdanvienapi_array['success'] = true;
        $huongdanvienapi_array['count'] = $num;
        $huongdanvienapi_array['data'] = [];
        
        while($row = $read->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $huongdanvienapi_item = array(
                'id' => $id,
                'hoten' => $hoten,
                'gioitinh' => $gioitinh,
                'ngaysinh' => $ngaysinh,
                'hinhanh' => $hinhanh,
                'hienthi' => $hienthi,
                'sdt' => $sdt,
                'email' => $email,
                'diachi' => $diachi,
            );
            array_push($huongdanvienapi_array['data'], $huongdanvienapi_item);
        }
        echo json_encode($huongdanvienapi_array);
    } else {
        // Trường hợp không có dữ liệu
        echo json_encode([
            'success' => true,
            'count' => 0,
            'message' => 'Không có hướng dẫn viên rảnh trong thời gian này',
            'data' => []
        ]);
    }
?>