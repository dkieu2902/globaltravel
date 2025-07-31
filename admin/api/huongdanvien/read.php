<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    include_once('../../config/db.php');
    include_once('../../model/huongdanvienapi.php');

    $db = new db();
    $connect = $db->connect();

    $huongdanvienapi = new huongdanvienapi($connect);
    $read = $huongdanvienapi->read();

    $num = $read->rowCount();

    if($num > 0){
        $huongdanvienapi_array = [];
        $huongdanvienapi_array['data'] = [];

        while($row = $read->fetch(PDO::FETCH_ASSOC)){
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
            );
            array_push($huongdanvienapi_array['data'], $huongdanvienapi_item);
        }
        echo json_encode($huongdanvienapi_array);
    }
?>