<?php 
	header('Access-Control-Allow-Origin:*');
	header('Content-Type: application/json');

	include_once('../../config/db.php');
	include_once('../../model/lichtrinhapi.php');

	$db = new db();
	$connect = $db->connect();

	$lichtrinhapi = new lichtrinhapi($connect);
	
	$lichtrinhapi->id = isset($_GET['id']) ? $_GET['id'] : die();

	$lichtrinhapi->show();

	$lichtrinhapi_item = array(
				'id' => $lichtrinhapi->id,
                'tieude' => $lichtrinhapi->tieude,
                'noidung' => $lichtrinhapi->noidung,
                'thutu' => $lichtrinhapi->thutu,
                'tour' => $lichtrinhapi->tour,
			);
	print_r(json_encode($lichtrinhapi_item, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

 ?>