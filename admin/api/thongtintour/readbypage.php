<?php 
    header('Access-Control-Allow-Origin:*');
    header('Content-Type: application/json');

    include_once('../../config/db.php');
    include_once('../../model/thongtintourapi.php');

    $db = new db();
    $connect = $db->connect();

    $thongtintourapi = new thongtintourapi($connect);
    
    $thongtintourapi->trang = isset($_GET['trang']) ? $_GET['trang'] : die();
    $thongtintourapi->sp_tungtrang = isset($_GET['sp_tungtrang']) ? $_GET['sp_tungtrang'] : die();
    $thongtintourapi->search = isset($_GET['search']) ? $_GET['search'] : die();
    $thongtintourapi->tourfilter = isset($_GET['tourfilter']) ? $_GET['tourfilter'] : die();

    $readResult = $thongtintourapi->readbypage();
    $thuoctieude = $readResult['thuoctieude'];
    $total = $readResult['total'];
    $read = $readResult['data'];

    $num = count($read);

    if ($num > 0) {
        $thongtintourapi_array = [];
        $thongtintourapi_array['thuoctieude'] = $thuoctieude;
        $thongtintourapi_array['total'] = $total;
        $thongtintourapi_array['data'] = [];

        foreach ($read as $row) {
            extract($row);

            $thongtintourapi_item = array(
                'id' => $id,
                'tieude' => $tieude,
                'thutu' => $thutu,
                'tour' => $tour,
            );
            array_push($thongtintourapi_array['data'], $thongtintourapi_item);
        }
        echo json_encode($thongtintourapi_array);
    } else {
        // Trường hợp không có dữ liệu
        echo json_encode(['total' => 0, 'data' => []]);
    }
?>