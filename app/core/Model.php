<?php

require_once __DIR__ . '/../../vendor/autoload.php'; // ปรับ path ให้ถูก

use Dotenv\Dotenv;

class Model {
    protected $db;
    protected $table;

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

    // ดึงข้อมูลทั้งหมด
    public function all($order = null) {
        $sql = "SELECT * FROM {$this->table}";

        // ตรวจสอบและใส่ ORDER BY ถ้ามี
        if ($order && is_array($order) && count($order) === 2) {
            $column = $order[0];
            $direction = strtoupper($order[1]) === 'DESC' ? 'DESC' : 'ASC';
            $sql .= " ORDER BY $column $direction";
        }

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // ดึงข้อมูลจาก id เดียว
    public function find($id) {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    // สร้างข้อมูลใหม่
    public function create(array $data) {
        $columns = implode(',', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));
        $stmt = $this->db->prepare("INSERT INTO {$this->table} ($columns) VALUES ($placeholders)");
        $stmt->execute($data);
        return $this->db->lastInsertId();
    }

    // อัปเดตข้อมูล
    public function update($id, array $data) {
        $set = implode(', ', array_map(fn($key) => "$key = :$key", array_keys($data)));
        $data['id'] = $id;
        $stmt = $this->db->prepare("UPDATE {$this->table} SET $set WHERE id = :id");
        return $stmt->execute($data);
    }

    // ลบข้อมูล
    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

    // where แบบง่าย (AND เงื่อนไขทั้งหมด)
    public function where(array $conditions) {
        $where = implode(' AND ', array_map(fn($key) => "$key = :$key", array_keys($conditions)));
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE $where");
        $stmt->execute($conditions);
        return $stmt->fetchAll();
    }
}
?>
