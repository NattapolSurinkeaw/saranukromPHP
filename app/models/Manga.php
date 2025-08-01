<?php

require_once "../app/core/Model.php"; // ✅ โหลด Model ก่อนใช้งาน

class Manga extends Model {
    public static $database = "mangas";

    public function getMangaAll() {
        $stmt = $this->db->prepare("SELECT * FROM mangas ORDER BY `updated_at` DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // public function getMangaByCate($id) {
    //     $stmt = $this->db->prepare("SELECT * FROM mangas WHERE cate_id = ? ORDER BY `updated_at` DESC");
    //     $stmt->execute([$id]); // ส่งค่าเป็น array
    //     return $stmt->fetchAll(PDO::FETCH_ASSOC); // ดึงข้อมูลทั้งหมด
    // }

    public function getFilterManga($param) {
        // print_r($param);
        try {
            $whereClauses = [];
            $values = [];
    
            // ค้นหาโดย title_TH หรือ title_EN
            if (!empty($param['title_search'])) {
                $whereClauses[] = "(`title_TH` LIKE :title_TH OR `title_EN` LIKE :title_EN)";
                $values[':title_TH'] = "%" . $param['title_search'] . "%";
                $values[':title_EN'] = "%" . $param['title_search'] . "%";
            }
    
            // ค้นหาตาม cate_id
            if (!empty($param['cate'])) {
                $whereClauses[] = "`cate_id` = :cate_id";
                $values[':cate_id'] = $param['cate'];
            } else {
                $whereClauses[] = "`cate_id` = :cate_id";
                $values[':cate_id'] = 2;
            }
    
            // ค้นหาตาม tag_id (ใช้ FIND_IN_SET)
            if (!empty($param['searchTag']) && is_array($param['searchTag'])) {
                $tagConditions = [];
                foreach ($param['searchTag'] as $index => $tag) {
                    $tagConditions[] = "FIND_IN_SET(:tag{$index}, `tag_id`)";
                    $values[":tag{$index}"] = $tag;
                }
                $whereClauses[] = "(" . implode(" OR ", $tagConditions) . ")";
            }
    
            // รวม WHERE Clause
            $whereSQL = !empty($whereClauses) ? "WHERE " . implode(" AND ", $whereClauses) : "";
    
            // สร้าง SQL Query
            $sql = "SELECT * FROM mangas $whereSQL ORDER BY `updated_at` DESC";
            $stmt = $this->db->prepare($sql);
    
            // Bind ค่า
            foreach ($values as $key => $value) {
                $stmt->bindValue($key, $value);
            }
    
            // Execute Query
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "เกิดข้อผิดพลาด: " . $e->getMessage();
            return false;
        }
    }
    

    public function createNewManga($param) {
        $tagImplode = isset($param['tags']) ? implode(',', $param['tags']) : '';
    
        $stmt = $this->db->prepare("INSERT INTO `mangas` (`cate_id`, `tag_id`, `author_id`, `title_TH`, `title_EN`, `status_display`, `created_at`, `updated_at`) 
                                    VALUES (:cate_id, :tag_id, :author_id, :title_TH, :title_EN, :status_display, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)");
    
        $status_display = 1; // หรือใช้ $param['status_display'] ถ้ามีค่าให้กำหนดเอง
    
        // ทำการ bind ค่าให้กับพารามิเตอร์
        $stmt->execute([
            ':cate_id' => $param['cate_id'],
            ':tag_id' => $tagImplode,
            ':author_id' => $param['slc_author'],
            ':title_TH' => $param['title_TH'],
            ':title_EN' => $param['title_EN'],
            ':status_display' => $status_display
        ]);
    
        // คืนค่า ID ที่ถูกเพิ่ม
        return $this->db->lastInsertId();
    }

    public function deleteManga($id) {
        try {
            // เตรียมคำสั่ง SQL
            $stmt = $this->db->prepare("DELETE FROM `mangas` WHERE id = :id");
            
            // ผูกค่าพารามิเตอร์
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            
            // ประมวลผลคำสั่ง SQL
            $success = $stmt->execute();
    
            // ตรวจสอบผลลัพธ์
            if ($success) {
                echo "ลบ manga สำเร็จ!";
            } else {
                echo "เกิดข้อผิดพลาด: " . implode(" ", $stmt->errorInfo());
            }
        } catch (PDOException $e) {
            // จัดการกับข้อผิดพลาดที่เกิดขึ้น
            echo "เกิดข้อผิดพลาด: " . $e->getMessage();
        }
    }
    
}
?>