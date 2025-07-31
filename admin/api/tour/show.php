<?php 
	header('Access-Control-Allow-Origin:*');
	header('Content-Type: application/json');

	include_once('../../config/db.php');
	include_once('../../model/tourapi.php');

	$db = new db();
	$connect = $db->connect();

	$tourapi = new tourapi($connect);
	
	$tourapi->id = isset($_GET['id']) ? $_GET['id'] : die();

	$tourapi->show();

	$tourapi_item = array(
				'id' => $tourapi->id,
                'tieude' => $tourapi->tieude,
                'uutien' => $tourapi->uutien,
                'tomtat' => $tourapi->tomtat,
                'mota' => $tourapi->mota,
                'nguoidang' => $tourapi->nguoidang,
                'danhmuc' => $tourapi->danhmuc,
                'hienthi' => $tourapi->hienthi,
                'hinhanh' => $tourapi->hinhanh,
                'title' => $tourapi->title,
                'description' => $tourapi->description,
                'keywords' => $tourapi->keywords,
                'url' => $tourapi->url,
                'matour' => $tourapi->matour,
                'khoihanh' => $tourapi->khoihanh,
                'thoigianchuyen' => $tourapi->thoigianchuyen,
                'diemthamquan' => $tourapi->diemthamquan,
                'amthuc' => $tourapi->amthuc,
                'doituongthichhop' => $tourapi->doituongthichhop,
                'thoigianlytuong' => $tourapi->thoigianlytuong,
                'phuongtien' => $tourapi->phuongtien,
                'khuyenmai' => $tourapi->khuyenmai,
                'giatu' => $tourapi->giatu,
                'songay' => $tourapi->songay,
               
			);
	print_r(json_encode($tourapi_item, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

 ?>