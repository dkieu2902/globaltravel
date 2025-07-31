<?php 
    header('Access-Control-Allow-Origin:*');
    header('Content-Type: application/json');

    include_once('../../config/db.php');
    include_once('../../model/tourapi.php');

    $db = new db();
    $connect = $db->connect();

    $tourapi = new tourapi($connect);
    
    $tourapi->trang = isset($_GET['trang']) ? $_GET['trang'] : die();
    $tourapi->sp_tungtrang = isset($_GET['sp_tungtrang']) ? $_GET['sp_tungtrang'] : die();
    $tourapi->hienthi = isset($_GET['hienthi']) ? $_GET['hienthi'] : die();
    $tourapi->search = isset($_GET['search']) ? $_GET['search'] : die();
    $tourapi->filterdanhmuc = isset($_GET['filterdanhmuc']) ? $_GET['filterdanhmuc'] : die();

    $readResult = $tourapi->readbypage();
    $total = $readResult['total'];
    $read = $readResult['data'];

    $num = count($read);

    if ($num > 0) {
        $tourapi_array = [];
        $tourapi_array['total'] = $total;
        $tourapi_array['data'] = [];

        foreach ($read as $row) {
            extract($row);

            $tourapi_item = array(
                'id' => $id,
                'tieude' => $tieude,
                'matour' => $matour,
                'uutien' => $uutien,
                'thoigian' => $thoigian,
                'danhmuc' => $danhmuc,
                'hienthi' => $hienthi,
                'hinhanh' => $hinhanh,
                'tendanhmuc' => $tendanhmuc,
                'url' => $url,
            );
            array_push($tourapi_array['data'], $tourapi_item);
        }
        echo json_encode($tourapi_array);
    } else {
        // Trường hợp không có dữ liệu
        echo json_encode(['total' => 0, 'data' => []]);
    }

 ?>