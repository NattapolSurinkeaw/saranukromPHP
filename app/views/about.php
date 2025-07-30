<?php
$title = "About Us"; // ตั้งชื่อหน้า
ob_start(); // เริ่มบันทึกเนื้อหา
?>

<div>
  
  <h2>About Us</h2>
  <p>Welcome to our About page.</p>
</div>

<?php
$content = ob_get_clean(); // ดึงเนื้อหามาเก็บในตัวแปร
include "../app/views/layouts/main.php"; // ใช้ Main Layout
?>