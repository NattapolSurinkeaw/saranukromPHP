<?php
$title = "MangaByCate"; // ตั้งชื่อหน้า
ob_start(); // เริ่มบันทึกเนื้อหา
?>

<div>
  
  <h1><?= $cate_title ?></h1>
  <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
    <?php foreach($mangas as $manga): ?>
      <a href="/episode/<?=$manga['id']?>">
        <div>
          <img style="width: 350px; height: 400px;" src="<?=$manga['thumbnail']?>" alt="">
          <p><?=$manga['title_TH']?></p>
        </div>
      </a>
    <?php endforeach ?>
  </div>
</div>

<?php
$content = ob_get_clean(); // ดึงเนื้อหามาเก็บในตัวแปร
include "../app/views/layouts/main.php"; // ใช้ Main Layout
?>