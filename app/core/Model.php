<?php

require_once __DIR__ . '/../../vendor/autoload.php'; // ปรับ path ให้ถูก

use Dotenv\Dotenv;

class Model {
    protected $db;

    public function __construct() {

        $dotenv = Dotenv::createImmutable(__DIR__ . '/../../'); // root คือ ../.. จาก core/
        $dotenv->load();

        $host = $_ENV['DB_HOST'];
        $db = $_ENV['DB_NAME'];
        $username = $_ENV['DB_USER'];
        $password = $_ENV['DB_PASS'];

        try {
            $this->db = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $username, $password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // แสดงข้อผิดพลาดแบบ Exception
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // คืนค่าผลลัพธ์เป็น Associative array
                PDO::ATTR_EMULATE_PREPARES => false // ปิดการจำลอง Prepared Statements
            ]);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }
}
?>
