<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once('../../config/db.php');
    include_once('../../model/dondattourapi.php');

    $db = new db();
    $connect = $db->connect();

    $dondattourapi = new dondattourapi($connect);

    $dondattourapi->trang = isset($_GET['trang']) ? $_GET['trang'] : die();
    $dondattourapi->sp_tungtrang = isset($_GET['sp_tungtrang']) ? $_GET['sp_tungtrang'] : die();
    $dondattourapi->search = isset($_GET['search']) ? $_GET['search'] : die();
    $dondattourapi->filterstatus = isset($_GET['filterstatus']) ? $_GET['filterstatus'] : die();

    $readResult = $dondattourapi->readbypage();
    $total = $readResult['total'];
    $read = $readResult['data'];

    $num = count($read);

    if ($num > 0) {
        $dondattourapi_array = [];
        $dondattourapi_array['total'] = $total;
        $dondattourapi_array['data'] = [];

        foreach ($read as $row) {
            extract($row);

            $dondattourapi_item = array(
                'id' => $id,
                'hoten' => $hoten,
                'sdt' => $sdt,
                'email' => $email,
                'matour' => $matour,
                'tentour' => $tentour,
                'soluong' => $soluong,
                'tieude' => $tieude,
                'songay' => $songay,
                'gia' => $gia,
                'ngaydat' => $ngaydat,
                'status' => $status,
                'tenhdv' => $tenhdv,
            );
            array_push($dondattourapi_array['data'], $dondattourapi_item);
        }
        echo json_encode($dondattourapi_array);
    } else {
        // Trường hợp không có dữ liệu
        echo json_encode(['total' => 0, 'data' => []]);
    }
?>
