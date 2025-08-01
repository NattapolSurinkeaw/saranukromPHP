<?php

require_once "../app/core/Model.php"; // ✅ โหลด Model ก่อนใช้งาน

class Publisher extends Model {
  protected $table = "publishers";

  public function getPublisherAll() {
    $order = ["priority", "DESC"];
    $publish = $this->all($order);
    return $publish;
  }
}