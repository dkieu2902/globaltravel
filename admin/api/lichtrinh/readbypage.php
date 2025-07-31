<?php 
    header('Access-Control-Allow-Origin:*');
    header('Content-Type: application/json');

    include_once('../../config/db.php');
    include_once('../../model/lichtrinhapi.php');

    $db = new db();
    $connect = $db->connect();

    $lichtrinhapi = new lichtrinhapi($connect);
    
    $lichtrinhapi->trang = isset($_GET['trang']) ? $_GET['trang'] : die();
    $lichtrinhapi->sp_tungtrang = isset($_GET['sp_tungtrang']) ? $_GET['sp_tungtrang'] : die();
    $lichtrinhapi->search = isset($_GET['search']) ? $_GET['search'] : die();
    $lichtrinhapi->tourfilter = isset($_GET['tourfilter']) ? $_GET['tourfilter'] : die();

    $readResult = $lichtrinhapi->readbypage();
    $thuoctieude = $readResult['thuoctieude'];
    $total = $readResult['total'];
    $read = $readResult['data'];

    $num = count($read);

    if ($num > 0) {
        $lichtrinhapi_array = [];
        $lichtrinhapi_array['thuoctieude'] = $thuoctieude;
        $lichtrinhapi_array['total'] = $total;
        $lichtrinhapi_array['data'] = [];

        foreach ($read as $row) {
            extract($row);

            $lichtrinhapi_item = array(
                'id' => $id,
                'tieude' => $tieude,
                'thutu' => $thutu,
                'tour' => $tour,
            );
            array_push($lichtrinhapi_array['data'], $lichtrinhapi_item);
        }
        echo json_encode($lichtrinhapi_array);
    } else {
        // Trường hợp không có dữ liệu
        echo json_encode(['total' => 0, 'data' => []]);
    }
?>