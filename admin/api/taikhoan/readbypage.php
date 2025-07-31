<?php 
    header('Access-Control-Allow-Origin:*');
    header('Content-Type: application/json');

    include_once('../../config/db.php');
    include_once('../../model/taikhoanapi.php');

    $db = new db();
    $connect = $db->connect();

    $taikhoanapi = new taikhoanapi($connect);
    
    $taikhoanapi->trang = isset($_GET['trang']) ? $_GET['trang'] : die();
    $taikhoanapi->sp_tungtrang = isset($_GET['sp_tungtrang']) ? $_GET['sp_tungtrang'] : die();
    $taikhoanapi->hienthi = isset($_GET['hienthi']) ? $_GET['hienthi'] : die();
    $taikhoanapi->search = isset($_GET['search']) ? $_GET['search'] : die();

    $readResult = $taikhoanapi->readbypage();
    $total = $readResult['total'];
    $read = $readResult['data'];

    $num = count($read);

    if ($num > 0) {
        $taikhoanapi_array = [];
        $taikhoanapi_array['total'] = $total;
        $taikhoanapi_array['data'] = [];

        foreach ($read as $row) {
            extract($row);

            $taikhoanapi_item = array(
                    'tennd' => $tennd,
                    'username' => $username,
                    'password' => $password,
                    'hienthi' => $hienthi,
                    'ngaysinh' => $ngaysinh,
                    'gioitinh' => $gioitinh,
                    'email' => $email,
                    'phanquyen' => $phanquyen,
                    'id' => $id,
            );
            array_push($taikhoanapi_array['data'], $taikhoanapi_item);
        }
        echo json_encode($taikhoanapi_array);
    } else {
        // Trường hợp không có dữ liệu
        echo json_encode(['total' => 0, 'data' => []]);
    }
?>