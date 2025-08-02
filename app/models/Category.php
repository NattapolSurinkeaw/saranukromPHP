<?php

require_once "../app/core/Model.php"; // ✅ โหลด Model ก่อนใช้งาน

class Category extends Model {
    public function getCateByPriority() {
        $stmt = $this->db->prepare("SELECT * FROM categories WHERE display = true ORDER BY cate_priority");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>