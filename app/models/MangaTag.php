<?php

require_once "../app/core/Model.php"; // ✅ โหลด Model ก่อนใช้งาน

class MangaTag extends Model {
    public function getMangaTagAll() {
      $stmt = $this->db->prepare("SELECT * FROM manga_tags WHERE status_display = true");
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createMangaTag($param) {
      $stmt = $this->db->prepare("
          INSERT INTO `manga_tags` (`title_tag`, `status_display`, `created_at`, `updated_at`) 
          VALUES (:title_tag, :status_display, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)
      ");
      
      $status_display = 1; // แปลงค่าคงที่เป็นตัวแปรก่อนใช้
      $stmt->bindParam(":title_tag", $param['title_tag']);
      $stmt->bindParam(":status_display",  $status_display);
  
      if ($stmt->execute()) {
        return $this->db->lastInsertId();
      } else {
        return false; // หรือคืนค่า error message
      }
  }
}