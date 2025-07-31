<?php 
    header('Access-Control-Allow-Origin:*');
    header('Content-Type: application/json');
    include_once('../../config/db.php');
    include_once('../../model/huongdanvienapi.php');
    $db = new db();
    $connect = $db->connect();
    $huongdanvienapi = new huongdanvienapi($connect);
    
    $huongdanvienapi->trang = isset($_GET['trang']) ? $_GET['trang'] : die();
    $huongdanvienapi->sp_tungtrang = isset($_GET['sp_tungtrang']) ? $_GET['sp_tungtrang'] : die();
    $huongdanvienapi->hienthi = isset($_GET['hienthi']) ? $_GET['hienthi'] : die();
    $huongdanvienapi->search = isset($_GET['search']) ? $_GET['search'] : '';
    
    $readResult = $huongdanvienapi->readbypage();
    $total = $readResult['total'];
    $read = $readResult['data'];
    $num = count($read);
    
    if ($num > 0) {
        $huongdanvienapi_array = [];
        $huongdanvienapi_array['total'] = $total;
        $huongdanvienapi_array['data'] = [];
        
        foreach ($read as $row) {
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
                'thoigiandi' => isset($thoigiandi) ? $thoigiandi : []
            );
            array_push($huongdanvienapi_array['data'], $huongdanvienapi_item);
        }
        echo json_encode($huongdanvienapi_array);
    } else {
        // Trường hợp không có dữ liệu
        echo json_encode(['total' => 0, 'data' => []]);
    }
?>