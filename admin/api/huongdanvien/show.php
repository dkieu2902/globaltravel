<?php 
	header('Access-Control-Allow-Origin:*');
	header('Content-Type: application/json');

	include_once('../../config/db.php');
	include_once('../../model/huongdanvienapi.php');

	$db = new db();
	$connect = $db->connect();

	$huongdanvienapi = new huongdanvienapi($connect);
	
	$huongdanvienapi->id = isset($_GET['id']) ? $_GET['id'] : die();

	$huongdanvienapi->show();

	$huongdanvienapi_item = array(
				'id' => $huongdanvienapi->id,
				'hoten' => $huongdanvienapi->hoten,
				'gioitinh' => $huongdanvienapi->gioitinh,
				'ngaysinh' => $huongdanvienapi->ngaysinh,
				'sdt' => $huongdanvienapi->sdt,
				'email' => $huongdanvienapi->email,
                'cccd' => $huongdanvienapi->cccd,
                'diachi' => $huongdanvienapi->diachi,
                'ngonngu' => $huongdanvienapi->ngonngu,
                'kinhnghiem' => $huongdanvienapi->kinhnghiem,
                'mota' => $huongdanvienapi->mota,
                'hinhanh' => $huongdanvienapi->hinhanh,
                'hienthi' => $huongdanvienapi->hienthi,
                'thoigian' => $huongdanvienapi->thoigian,
                'trangthai' => $huongdanvienapi->trangthai,
			);
	print_r(json_encode($huongdanvienapi_item, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

 ?>