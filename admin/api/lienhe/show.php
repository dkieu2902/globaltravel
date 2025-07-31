<?php 
	header('Access-Control-Allow-Origin:*');
	header('Content-Type: application/json');

	include_once('../../config/db.php');
	include_once('../../model/lienheapi.php');

	$db = new db();
	$connect = $db->connect();

	$lienheapi = new lienheapi($connect);
	
	$lienheapi->id = isset($_GET['id']) ? $_GET['id'] : die();

	$lienheapi->show();

	$lienheapi_item = array(
				'id' => $lienheapi->id,
				'ten' => $lienheapi->ten,
				'email' => $lienheapi->email,
				'sdt' => $lienheapi->sdt,
				'chude' => $lienheapi->chude,
				'thoigian' => $lienheapi->thoigian,
				'status' => $lienheapi->status,
			);
	print_r(json_encode($lienheapi_item, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

 ?>