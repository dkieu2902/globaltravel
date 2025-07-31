<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    include_once('../../config/db.php');
    include_once('../../model/dondattourapi.php');

    $db = new db();
    $connect = $db->connect();

    $dondattourapi = new dondattourapi($connect);
    $read = $dondattourapi->read();

    $num = $read->rowCount();

    if($num > 0){
        $dondattourapi_array = [];
        $dondattourapi_array['data'] = [];

        while($row = $read->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $dondattourapi_item = array(
                'madm' => $madm,
                'tendm' => $tendm,
                'danhmuc' => $danhmuc,
                'noidung' => $noidung,
                'noidungcuoi' => $noidungcuoi,
                'hienthi' => $hienthi,
                'uutien' => $uutien,
                'menuchinh' => $menuchinh,
                'chitiet' => $chitiet,
                'linkchitiet' => $linkchitiet,
                'title' => $title,
                'description' => $description,
                'keywords' => $keywords,
                'url' => $url,
            );
            array_push($dondattourapi_array['data'], $dondattourapi_item);
        }
        echo json_encode($dondattourapi_array);
    }
?>