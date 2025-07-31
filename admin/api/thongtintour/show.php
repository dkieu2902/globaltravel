<?php 
	header('Access-Control-Allow-Origin:*');
	header('Content-Type: application/json');

	include_once('../../config/db.php');
	include_once('../../model/thongtintourapi.php');

	$db = new db();
	$connect = $db->connect();

	$thongtintourapi = new thongtintourapi($connect);
	
	$thongtintourapi->id = isset($_GET['id']) ? $_GET['id'] : die();

	$thongtintourapi->show();

	$thongtintourapi_item = array(
				'id' => $thongtintourapi->id,
                'tieude' => $thongtintourapi->tieude,
                'noidung' => $thongtintourapi->noidung,
                'thutu' => $thongtintourapi->thutu,
                'tour' => $thongtintourapi->tour,
			);
	print_r(json_encode($thongtintourapi_item, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

 ?>