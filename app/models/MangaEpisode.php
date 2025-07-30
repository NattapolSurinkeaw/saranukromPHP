<?php

require_once "../app/core/Model.php"; // ✅ โหลด Model ก่อนใช้งาน

class MangaEpisode extends Model {
    public function getEpisodeById($ep_id) {
        try {
            // เตรียมคำสั่ง SQL
            $stmt = $this->db->prepare("SELECT * FROM manga_episodes WHERE id = :ep_id");
            
            // ผูกค่าพารามิเตอร์และป้องกัน SQL Injection
            $stmt->bindParam(':ep_id', $ep_id, PDO::PARAM_INT);
            
            // ประมวลผลคำสั่ง SQL
            $stmt->execute();
            
            // ดึงผลลัพธ์เป็น associative array
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // คืนค่าผลลัพธ์
            return $result;
        } catch (PDOException $e) {
            // จัดการกับข้อผิดพลาดที่เกิดขึ้น
            echo "เกิดข้อผิดพลาด: " . $e->getMessage();
            return null; // คืนค่า null หากเกิดข้อผิดพลาด
        }
    }

    public function getNextEpisode($manga_id, $ep_id) {
        $stmt = $this->db->prepare("SELECT * FROM manga_episodes WHERE manga_id = :manga_id AND id > :ep_id ORDER BY id ASC LIMIT 1");
        $stmt->bindParam(":manga_id", $manga_id, PDO::PARAM_INT);
        $stmt->bindParam(":ep_id", $ep_id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    
    // หาตอนก่อนหน้า
    public function getPrevEpisode($manga_id, $ep_id) {
        $stmt = $this->db->prepare("SELECT * FROM manga_episodes WHERE manga_id = :manga_id AND id < :ep_id ORDER BY id DESC LIMIT 1");
        $stmt->bindParam(":manga_id", $manga_id, PDO::PARAM_INT);
        $stmt->bindParam(":ep_id", $ep_id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getEpisodeManga($id) {
        $stmt = $this->db->prepare("SELECT * FROM manga_episodes WHERE manga_id = :manga_id");
        $stmt->execute([':manga_id' => $id]); // ✅ ส่งค่า `$id` ผ่าน `execute()`
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // ✅ ดึงข้อมูลทั้งหมด
    }
    

    public function createNewEpisode($param) {
        $stmt = $this->db->prepare("INSERT INTO `manga_episodes`(`manga_id`, `title`) VALUES (:id, :title)");
        
        $stmt->bindParam(":id", $param['id']);
        $stmt->bindParam(":title", $param['title']);
    
        if ($stmt->execute()) {
            return $this->db->lastInsertId();
        } else {
            return false; // หรือคืนค่า error message
        }
    }

    public function deleteEp($id) {
        $stmt = $this->db->prepare("DELETE FROM `manga_episodes` WHERE id = :id");
        $stmt->bindParam(":id", $id);
        $success = $stmt->execute();

        if ($success) {
            echo "อัปเดต thumbnail สำเร็จ!";
        } else {
            echo "เกิดข้อผิดพลาดบางอย่าง";
        }
    }
}
?>