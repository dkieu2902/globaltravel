<?php
class database {
    private $conn;

    public function __construct() {
        // Lấy thông tin từ Environment Variables trên Render
        $host = getenv('DB_HOST');        // trolley.proxy.rlwy.net
        $user = getenv('DB_USER');        // root
        $pass = getenv('DB_PASSWORD');    // mật khẩu Railway
        $name = getenv('DB_NAME');        // railway
        $port = getenv('DB_PORT');        // 41287

        // Bật chế độ báo lỗi để dễ debug
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        // Kết nối MySQL
        $this->conn = new mysqli($host, $user, $pass, $name, (int)$port);

        // Đặt charset cho database
        $this->conn->set_charset('utf8mb4');
    }

    public function getConnection() {
        return $this->conn;
    }
}
