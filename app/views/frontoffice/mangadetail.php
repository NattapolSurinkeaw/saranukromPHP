<?php
  use Carbon\Carbon;

  $title = "Datail Manga : "; // ตั้งชื่อหน้า

  function formatThaiDate($date) {
    $months = ['ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.',
               'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.'];
    $timestamp = strtotime($date);
    $day = date('j', $timestamp);
    $month = $months[(int)date('n', $timestamp) - 1];
    $year = date('Y', $timestamp);
    return "{$day} {$month} {$year}";
  }

  ob_start(); // เริ่มบันทึกเนื้อหา
?>

<div>
  <link rel="stylesheet" href="/css/mangadetail.css">
  <div class="container">
    <div class="card">
      <div class="image-container">
        <img src="<?php echo htmlspecialchars($manga['thumbnail']); ?>" alt="<?php echo htmlspecialchars($manga['title_TH']); ?>">
      </div>
      <div class="info">
        <h2><?php echo htmlspecialchars($manga['title_TH']); ?></h2>

        <?php if (empty($manga['title_EN'])): ?>
          <p class="italic"><?php echo htmlspecialchars($manga['title_EN']); ?></p>
        <?php endif; ?>

        <div class="details">
          <p><span>เล่มที่:</span> 1</p>
          <p><span>วันที่วางจำหน่าย:</span> <?php echo formatThaiDate($manga['created_at']); ?></p>
          <p><span>ราคา:</span> 1 บาท</p>
          <p><span>สำนักพิมพ์:</span> <?php echo !empty($manga['title']) ? htmlspecialchars($manga['title']) : '-'; ?></p>
        </div>
      </div>
    </div>

    <div class="back-button">
      <a href="<?php echo htmlspecialchars($_SERVER['HTTP_REFERER']); ?>">← กลับ</a>
    </div>
  </div>
</div>

<?php
$content = ob_get_clean(); // ดึงเนื้อหามาเก็บในตัวแปร
include "../app/views/layouts/main.php"; // ใช้ Main Layout
?>