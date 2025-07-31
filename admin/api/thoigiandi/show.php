<?php 
	header('Access-Control-Allow-Origin:*');
	header('Content-Type: application/json');

	include_once('../../config/db.php');
	include_once('../../model/thoigiandiapi.php');

	$db = new db();
	$connect = $db->connect();

	$thoigiandiapi = new thoigiandiapi($connect);
	
	$thoigiandiapi->id = isset($_GET['id']) ? $_GET['id'] : die();

	$thoigiandiapi->show();

	$thoigiandiapi_item = array(
				'id' => $thoigiandiapi->id,
                'tieude' => $thoigiandiapi->tieude,
                'thutu' => $thoigiandiapi->thutu,
                'tour' => $thoigiandiapi->tour,
                'sochocon' => $thoigiandiapi->sochocon,
			);
	print_r(json_encode($thoigiandiapi_item, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

 ?>