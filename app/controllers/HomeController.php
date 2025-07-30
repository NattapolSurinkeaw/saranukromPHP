<?php

class HomeController extends Controller {
  public function testt() {
    $mangaModel = $this->model("Manga");
      $mangas = $mangaModel->getMangaAll();
    echo json_encode($mangas);
  }

  public function testPost() {
    // รับข้อมูล FormData
    // $params = $_POST;
    // print_r($params);

    // รับค่าที่ส่งมาเป็น json Raw data
    $jsonData = file_get_contents("php://input");
    // ✅ แปลง JSON เป็น Array
    $data = json_decode($jsonData, true);
    print_r($data);
    
  }
}

?>