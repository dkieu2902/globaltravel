<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    include_once('../../config/db.php');
    include_once('../../model/hinhanhtourapi.php');

    $db = new db();
    $connect = $db->connect();

    $hinhanhtourapi = new hinhanhtourapi($connect);
    $read = $hinhanhtourapi->read();

    $num = $read->rowCount();

    if($num > 0){
        $hinhanhtourapi_array = [];
        $hinhanhtourapi_array['data'] = [];

        while($row = $read->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $hinhanhtourapi_item = array(
                'id' => $id,
                'hinhanh' => $hinhanh,
                'tour' => $tour,
            );
            array_push($hinhanhtourapi_array['data'], $hinhanhtourapi_item);
        }
        echo json_encode($hinhanhtourapi_array);
    }
?>