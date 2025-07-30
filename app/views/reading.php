<?php
$title = "ReadManga"; // ตั้งชื่อหน้า
ob_start(); // เริ่มบันทึกเนื้อหา
?>

<h2>ตอนที่ <?= $id ?></h2>
<div style="display: flex;justify-content:space-between;margin-bottom: 5px;">
  <a style="padding: 5px; border-radius: 5px;<?= ($prevEpisode) ? "background: #3288d3;color:white;" : "background: gray;" ?>" href="<?= ($prevEpisode) ? "/read/{$prevEpisode['id']}" : "#" ?>">ตอนก่อน</a>
  <a style="padding: 5px; border-radius: 5px;<?= ($nextEpisode) ? "background: #3288d3;color:white;" : "background: gray;" ?>" href="<?= ($nextEpisode) ? "/read/{$nextEpisode['id']}" : "#" ?>">ถัดไป</a>
</div>
<div style="display: flex; flex-direction: column;">
  <?php foreach($images as $img): ?>
  <img src="<?= $img['image_link'] ?>" alt="">
  <?php endforeach ?>
</div>

<?php
$content = ob_get_clean(); // ดึงเนื้อหามาเก็บในตัวแปร
include "../app/views/layouts/main.php"; // ใช้ Main Layout
?>