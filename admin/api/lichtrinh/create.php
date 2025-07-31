<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Method: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

include_once('../../config/db.php');
include_once('../../model/lichtrinhapi.php');

$db = new db();
$connect = $db->connect();

$lichtrinhapi = new lichtrinhapi($connect);

// Decode JSON data
$data = json_decode(file_get_contents("php://input"));

// Check if decoding is successful
if ($data) {
    $lichtrinhapi->tieude = $data->tieude;
    $lichtrinhapi->noidung = $data->noidung;
    $lichtrinhapi->thutu = $data->thutu;
    $lichtrinhapi->tour = $data->tour;

    if ($lichtrinhapi->create()) {
        echo json_encode(array('message', 'Tạo thành công'));
    } else {
        echo json_encode(array('message', 'Tạo không thành công'));
    }
} else {
    // Handle JSON decoding error
    echo json_encode(array('message', 'Error decoding JSON data'));
}
?>