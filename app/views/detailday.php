<?php
  use Carbon\Carbon;

  $title = "Detail Manga Day"; // ตั้งชื่อหน้า
  ob_start(); // เริ่มบันทึกเนื้อหา
?>

<div>
  <link rel="stylesheet" href="/css/detailday.css">
  <div class="calendar-container">
    <!-- Header -->
    <div class="calendar-header">
      <a href="/detailday.php?month=<?= $prevMonth ?>&year=<?= $prevYear ?>" class="arrow">
        🡐
      </a>

      <div class="calendar-title">
        <h2>
          <?= Carbon::create($year, $month, 1)->locale('th')->translatedFormat('F Y') ?>
        </h2>
        <span class="subtitle">ตารางอัปเดตการ์ตูนใหม่ ✨</span>

        <a href="/" class="home-button">
          <p>หน้าแรก</p>
        </a>
      </div>

      <a href="/detailday.php?month=<?= $nextMonth ?>&year=<?= $nextYear ?>" class="arrow">
        🡒
      </a>
    </div>

    <!-- Grid ตารางปฏิทิน -->
    <div class="calendar-grid">
      <?php foreach ($mangaByDate as $date => $mangaList): ?>
        <div class="calendar-day">
          <div class="calendar-date">
            <?= Carbon::parse($date)->locale('th')->translatedFormat('j F Y') ?>
          </div>

          <div class="calendar-content">
            
            <?php if (isset($publishersByDate[$date]) && isset($mangaByDate[$date])): ?>
              <?php foreach ($publishersByDate[$date] as $pubId => $thumbnail): ?>
                <?php print_r($thumbnail); ?>
                <div class="publisher">
                  <img src="<?= $thumbnail['thumbnail'] ?>" alt="publisher">
                  <span><?= $thumbnail['title_TH'] ?></span>
                </div>
                <?php if (isset($mangaByDate[$date][$pubId])): ?>
                  <?php foreach ($mangaByDate[$date] as $manga): ?>
                    
                    <a href="/manga/<?= $manga['id'] ?>">
                      <div class="manga-item">
                        <img src="<?= $manga['thumbnail'] ?>" alt="manga">
                        <div class="manga-info">
                          <span><?= $manga['title_TH'] ?></span>
                          <span class="volume">1</span>
                          <p>ราคา 55 บาท</p>
                        </div>
                        <!-- <?php if ($manga['confirm_release'] == false): ?>
                          <p class="pending">(ยังไม่กำหนดวันออกที่ชัดเจน)</p>
                        <?php endif; ?> -->
                      </div>
                    </a>
                  <?php endforeach; ?>
                <?php endif; ?>

                <?php if ($pubId !== array_key_last($publishersByDate[$date])): ?>
                  <div class="divider"></div>
                <?php endif; ?>
              <?php endforeach; ?>
            <?php endif; ?>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>

<?php
$content = ob_get_clean(); // ดึงเนื้อหามาเก็บในตัวแปร
include "../app/views/layouts/main.php"; // ใช้ Main Layout
?>