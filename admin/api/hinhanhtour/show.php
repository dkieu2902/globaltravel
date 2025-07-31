<?php 
	header('Access-Control-Allow-Origin:*');
	header('Content-Type: application/json');

	include_once('../../config/db.php');
	include_once('../../model/hinhanhtourapi.php');

	$db = new db();
	$connect = $db->connect();

	$hinhanhtourapi = new hinhanhtourapi($connect);
	
	$hinhanhtourapi->id = isset($_GET['id']) ? $_GET['id'] : die();

	$hinhanhtourapi->show();

	$hinhanhtourapi_item = array(
				'id' => $hinhanhtourapi->id,
                'hinhanh' => $hinhanhtourapi->hinhanh,
                'tour' => $hinhanhtourapi->tour,
			);
	print_r(json_encode($hinhanhtourapi_item, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

 ?>