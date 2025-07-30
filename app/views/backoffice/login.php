<?php
$title = "Name Manga : 00"; // ตั้งชื่อหน้า
ob_start(); // เริ่มบันทึกเนื้อหา
?>
<h2 style="text-align: center;">Login </h2>
<form action="/authentication" method="POST">
  <div style="display: flex; flex-direction: column;">
    <label for="">Email</label>
    <input type="text" name="email">
  </div>
  <div style="display: flex; flex-direction: column;">
    <label for="">Password</label>
    <input type="text" name="password">
  </div>
  <button type="submit">login</button>
</form>

<?php
$content = ob_get_clean(); // ดึงเนื้อหามาเก็บในตัวแปร
include "../app/views/layouts/main.php"; // ใช้ Main Layout
?>