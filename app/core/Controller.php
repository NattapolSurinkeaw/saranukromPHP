<?php

session_start(); // เปิดใช้งาน Session


require_once "../app/models/Category.php";

class Controller {
    protected $shareData = [];

    public function __construct() {
        // ✅ โหลด Model Category
        $this->shareData = [
            // "site_name" => "7Hmangal",
            "categories" => (new Category())->getCateByPriority()
        ];
    }

    public function model($model) {
        require_once "../app/models/" . $model . ".php";
        return new $model();
    }

    public function view($view, $data = []) {
        $data = array_merge($this->shareData, $data);
        extract($data); // ✅ ทำให้สามารถใช้ `$site_name`, `$categories` ได้ตรงๆ
        require_once "../app/views/" . $view . ".php";
    }
}
?>