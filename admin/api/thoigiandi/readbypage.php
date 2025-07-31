<?php 
    header('Access-Control-Allow-Origin:*');
    header('Content-Type: application/json');

    include_once('../../config/db.php');
    include_once('../../model/thoigiandiapi.php');

    $db = new db();
    $connect = $db->connect();

    $thoigiandiapi = new thoigiandiapi($connect);
    
    $thoigiandiapi->trang = isset($_GET['trang']) ? $_GET['trang'] : die();
    $thoigiandiapi->sp_tungtrang = isset($_GET['sp_tungtrang']) ? $_GET['sp_tungtrang'] : die();
    $thoigiandiapi->search = isset($_GET['search']) ? $_GET['search'] : die();
    $thoigiandiapi->tourfilter = isset($_GET['tourfilter']) ? $_GET['tourfilter'] : die();

    $readResult = $thoigiandiapi->readbypage();
    $thuoctieude = $readResult['thuoctieude'];
    $total = $readResult['total'];
    $read = $readResult['data'];

    $num = count($read);

    if ($num > 0) {
        $thoigiandiapi_array = [];
        $thoigiandiapi_array['thuoctieude'] = $thuoctieude;
        $thoigiandiapi_array['total'] = $total;
        $thoigiandiapi_array['data'] = [];

        foreach ($read as $row) {
            extract($row);

            $thoigiandiapi_item = array(
                'id' => $id,
                'tieude' => $tieude,
                'thutu' => $thutu,
                'sochocon' => $sochocon,
                'tour' => $tour,
                'huongdanvien' => $huongdanvien,
                'hoten_huongdanvien' => $hoten_huongdanvien,
            );
            array_push($thoigiandiapi_array['data'], $thoigiandiapi_item);
        }
        echo json_encode($thoigiandiapi_array);
    } else {
        // Trường hợp không có dữ liệu
        echo json_encode(['total' => 0, 'data' => []]);
    }
?>