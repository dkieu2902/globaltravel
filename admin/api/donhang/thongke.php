<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    include_once('../../config/db.php');
    include_once('../../model/donhangapi.php');

    $db = new db();
    $connect = $db->connect();

    $donhangapi = new donhangapi($connect);
    $read = $donhangapi->readTotalQuantity();

    $num = $read->rowCount();

    if($num > 0){
        $donhangapi_array = [];
        $donhangapi_array['data'] = [];

        while($row = $read->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $donhangapi_item = array(
                'masp' => $masp,
                'tensp' => $tensp,
                'tongsoluong' => $tongsoluong
            );
            array_push($donhangapi_array['data'], $donhangapi_item);
        }
        echo json_encode($donhangapi_array);
    }
?>