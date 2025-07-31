<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once('../../config/db.php');
include_once('../../model/dondattourapi.php');

$db = new db();
$connect = $db->connect();
$dondattourapi = new dondattourapi($connect);

try {
    // Lấy dữ liệu từ GET parameters
    $dondattourapi->tungay = isset($_GET['tungay']) ? $_GET['tungay'] : date('Y-m-d');
    $dondattourapi->denngay = isset($_GET['denngay']) ? $_GET['denngay'] : date('Y-m-d');
    
    // Validate input dates
    if (!$dondattourapi->tungay || !$dondattourapi->denngay) {
        throw new Exception('Thiếu thông tin ngày bắt đầu hoặc ngày kết thúc');
    }
    
    // Gọi hàm thống kê
    $result = $dondattourapi->getStatisticsByDateRange();
    
    if ($result['success']) {
        $tour_data = $result['tour_data'];
        $num = count($tour_data);
        
        if ($num > 0) {
            $response_array = [];
            $response_array['success'] = true;
            $response_array['tongdoanhthu'] = (int)$result['tongdoanhthu'];
            $response_array['tungay'] = $result['tungay'];
            $response_array['denngay'] = $result['denngay'];
            $response_array['data'] = [];
            
            foreach ($tour_data as $row) {
                extract($row);
                $tour_item = array(
                    'matour' => $matour,
                    'tentour' => $tentour,
                    'tonggia' => (int)$tonggia,
                    'sodon' => (int)$sodon,
                    'tongsoluong' => (int)$tongsoluong,
                    // Để tương thích với biểu đồ
                    'ten' => $tentour,
                    'tongtien' => (int)$tonggia
                );
                array_push($response_array['data'], $tour_item);
            }
            
            echo json_encode($response_array, JSON_UNESCAPED_UNICODE);
        } else {
            // Trường hợp không có dữ liệu
            echo json_encode([
                'success' => true,
                'tongdoanhthu' => 0,
                'tungay' => $dondattourapi->tungay,
                'denngay' => $dondattourapi->denngay,
                'data' => []
            ], JSON_UNESCAPED_UNICODE);
        }
    } else {
        throw new Exception($result['message']);
    }
    
} catch (Exception $e) {
    // Trường hợp có lỗi
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage(),
        'tongdoanhthu' => 0,
        'data' => []
    ], JSON_UNESCAPED_UNICODE);
}
?>