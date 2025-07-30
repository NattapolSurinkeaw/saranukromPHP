<?php
$title = "Name Manga : 00"; // ตั้งชื่อหน้า
ob_start(); // เริ่มบันทึกเนื้อหา
?>
<h2>Manga Name : <?= $id ?></h2>
<ul>
  <?php foreach($episodes as $ep): ?>
  <li><a href="/read/<?= $ep['id'] ?>"><?= $ep['title'] ?></a></li>
  <?php endforeach ?>
</ul>

<?php
$content = ob_get_clean(); // ดึงเนื้อหามาเก็บในตัวแปร
include "../app/views/layouts/main.php"; // ใช้ Main Layout
?>