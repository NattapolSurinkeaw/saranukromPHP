<?php

class AuthenController extends Controller {
  public function loginPage() {
    
    $this->view('backoffice/login');
  }

  public function dasd () {

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

  public function Authentication() {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $userModel = $this->model('User');
    $user = $userModel->getAuthenUser($email);
    if ($user) {
      // ✅ ตรวจสอบ Password ที่เข้ารหัสด้วย bcrypt
      if (password_verify($password, $user['password'])) {

        $_SESSION["user"] = $user;

        header("Location:/backend/dashboard");
      } else {
        header("Location:/backend/login");
      }
    } else {
      header("Location:/backend/login");
    }

  }

  public function getLogOut() {
    session_unset();
    $this->view('backoffice/login');
  }

}

?>