<?php
$title = "create Author Page"; // ตั้งชื่อหน้า
ob_start(); // เริ่มบันทึกเนื้อหา
?>

<h2 style="text-align: center;">Create Author</h2>
<form action="/createAuthor" method="POST">
  <div style="display: flex; flex-direction: column;">
    <label for="">title_TH</label>
    <input type="text" name="title_TH">
  </div>
  <button type="submit">login</button>
</form>

<?php
$content = ob_get_clean(); // ดึงเนื้อหามาเก็บในตัวแปร
include "../app/views/layouts/main.php"; // ใช้ Main Layout
?>