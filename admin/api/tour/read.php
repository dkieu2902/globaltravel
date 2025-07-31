<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    include_once('../../config/db.php');
    include_once('../../model/tourapi.php');

    $db = new db();
    $connect = $db->connect();

    $tourapi = new tourapi($connect);
    $read = $tourapi->read();

    $num = $read->rowCount();

    if($num > 0){
        $tourapi_array = [];
        $tourapi_array['data'] = [];

        while($row = $read->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $tourapi_item = array(
                'id' => $id,
                'tieude' => $tieude,
                'uutien' => $uutien,
                'thoigian' => $thoigian,
                'danhmuc' => $danhmuc,
                'hienthi' => $hienthi,
                'hinhanh' => $hinhanh,
                'url' => $url,
            );
            array_push($tourapi_array['data'], $tourapi_item);
        }
        echo json_encode($tourapi_array);
    }
?>