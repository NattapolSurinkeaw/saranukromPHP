<?php

require_once "../app/core/Model.php"; // ✅ โหลด Model ก่อนใช้งาน

class MangaImage extends Model {
    public function getEpisodeManga($id) {
        $stmt = $this->db->prepare("SELECT * FROM manga_episodes WHERE manga_id = :manga_id");
        $stmt->execute([':manga_id' => $id]); // ✅ ส่งค่า `$id` ผ่าน `execute()`
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // ✅ ดึงข้อมูลทั้งหมด
    }
    
    public function getImageByEpid($id) {
        $stmt = $this->db->prepare("SELECT * FROM manga_images WHERE ep_id = :ep_id");
        $stmt->execute([':ep_id' => $id]); // ✅ ส่งค่า `$id` ผ่าน `execute()`

        return $stmt->fetchAll(PDO::FETCH_ASSOC); // ✅ ดึงข้อมูลทั้งหมด
    }

    public function addNewImage($param) {
        try {
            // แปลง string JSON เป็น array
            $images = json_decode($param['link_image'], true);

            // ถ้า decode ไม่ได้ ให้ใช้ explode() แทน
            if (!is_array($images)) {
                $cleanedString = str_replace(["[", "]", "'"], "", $param['link_image']);
                $images = explode(",", $cleanedString);
            }

            // ตรวจสอบว่า `$images` เป็น array จริง ๆ
            if (!is_array($images) || empty($images)) {
                return false; // ถ้าผิดพลาด หยุดทำงาน
            }

            // เตรียมข้อมูลสำหรับ insert
            $sql = "INSERT INTO `manga_images` (`ep_id`, `image_link`, `priority`) VALUES ";
            $placeholders = [];
            $values = [];

            foreach ($images as $index => $link) {
                $placeholders[] = "(?, ?, ?)";
                $values[] = $param['id'];   // ep_id
                $values[] = "https://lh5.googleusercontent.com/d/" . trim($link); // image_link
                $values[] = $index + 1;      // priority
            }

            // รวม SQL Statement
            $sql .= implode(", ", $placeholders);
            $stmt = $this->db->prepare($sql);

            // Execute Query
            $stmt->execute($values);

            // อัปเดต `thumbnail` ของ `mangas`
            $sqlUpdate = "UPDATE mangas m
                JOIN manga_episodes me ON m.id = me.manga_id
                JOIN manga_images mi ON me.id = mi.ep_id
                SET m.thumbnail = :thumbnail,
                    m.updated_at = CURRENT_TIMESTAMP
                WHERE mi.ep_id = :ep_id";

            $stmtUpdate = $this->db->prepare($sqlUpdate);
            $stmtUpdate->execute([
                ':thumbnail' => "https://lh5.googleusercontent.com/d/" . trim($images[0]),
                ':ep_id' => $param['id']
            ]);

            echo "อัปเดต thumbnail สำเร็จ!";

            return true;
        } catch (PDOException $e) {
            echo "เกิดข้อผิดพลาด: " . $e->getMessage();
            return false;
        }
    }

}
?>