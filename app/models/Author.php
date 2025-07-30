<?php

require_once "../app/core/Model.php"; // ✅ โหลด Model ก่อนใช้งาน

class Author extends Model {
  public function getAuthorAll() {
    $stmt = $this->db->prepare("SELECT * FROM author WHERE status_display = true");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

    public function createAuthor($param) {
      $stmt = $this->db->prepare("
          INSERT INTO `author` (`name_TH`, `status_display`, `created_at`, `updated_at`) 
          VALUES (:title_TH, :status_display, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)
      ");
      
      $status_display = 1; // แปลงค่าคงที่เป็นตัวแปรก่อนใช้
      $stmt->bindParam(":title_TH", $param['title_TH']);
      $stmt->bindParam(":status_display", $status_display);
  
      if ($stmt->execute()) {
        return $this->db->lastInsertId();
      } else {
        return false;
      }
  }
}