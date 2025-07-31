<?php 
    header('Access-Control-Allow-Origin:*');
    header('Content-Type: application/json');

    include_once('../../config/db.php');
    include_once('../../model/hinhanhtourapi.php');

    $db = new db();
    $connect = $db->connect();

    $hinhanhtourapi = new hinhanhtourapi($connect);
    
    $hinhanhtourapi->trang = isset($_GET['trang']) ? $_GET['trang'] : die();
    $hinhanhtourapi->sp_tungtrang = isset($_GET['sp_tungtrang']) ? $_GET['sp_tungtrang'] : die();
    $hinhanhtourapi->filtertour = isset($_GET['filtertour']) ? $_GET['filtertour'] : die();

    $readResult = $hinhanhtourapi->readbypage();
    $thuoctieude = $readResult['thuoctieude'];
    $total = $readResult['total'];
    $read = $readResult['data'];

    $num = count($read);

    if ($num > 0) {
        $hinhanhtourapi_array = [];
        $hinhanhtourapi_array['thuoctieude'] = $thuoctieude;
        $hinhanhtourapi_array['total'] = $total;
        $hinhanhtourapi_array['data'] = [];

        foreach ($read as $row) {
            extract($row);

            $hinhanhtourapi_item = array(
                'id' => $id,
                'hinhanh' => $hinhanh,
                'tour' => $tour,
            );
            array_push($hinhanhtourapi_array['data'], $hinhanhtourapi_item);
        }
        echo json_encode($hinhanhtourapi_array);
    } else {
        // Trường hợp không có dữ liệu
        echo json_encode(['total' => 0, 'data' => []]);
    }
?>