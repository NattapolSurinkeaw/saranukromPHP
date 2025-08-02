<?php
  use Carbon\Carbon;

  $title = "Home Page"; // ตั้งชื่อหน้า
  ob_start(); // เริ่มบันทึกเนื้อหา
?>

<div>
  <link rel="stylesheet" href="/css/home.css">
  <div class="calendar-container">
    <div class="calendar-header">
      <a href="?month=<?= $prevMonth ?>&year=<?= $prevYear ?>" class="nav-arrow">🡐</a>

      <div class="calendar-title">
        <h2><?= Carbon::create($year, $month, 1)->locale('th')->translatedFormat('F Y') ?></h2>
        <span class="calendar-sub">ตารางอัปเดตการ์ตูนใหม่ ✨</span>
      </div>

      <a href="?month=<?= $nextMonth ?>&year=<?= $nextYear ?>" class="nav-arrow">🡒</a>
    </div>

    <div class="week-header">
      <div>อา</div>
      <div>จ</div>
      <div>อ</div>
      <div>พ</div>
      <div>พฤ</div>
      <div>ศ</div>
      <div>ส</div>
    </div>

    <div class="calendar-grid">
      <?php $day = 1; $started = false; ?>
      <?php for ($week = 0; $week < 6; $week++): ?>
        <?php for ($dow = 0; $dow < 7; $dow++): ?>
          <?php if (!$started && $dow == $firstDayOfWeek) $started = true; ?>
          <a href="/detailday/<?= $month ?>/<?= $year ?>">
            <div class="calendar-cell">
              <?php if ($started && $day <= $daysInMonth): ?>
                <?php
                  $dateStr = sprintf('%04d-%02d-%02d', $year, $month, $day);
                  $isToday = ($dateStr === $today);
                  $thumbs = $publishersByDate[$dateStr] ?? [];
                  $titles = $mangaByDate[$dateStr] ?? [];
                  ?>
                <div class="calendar-date <?= $isToday ? 'today' : '' ?>"> <?= $day ?> </div>
                
                <div class="calendar-thumbs">
                  <?php foreach ($thumbs as $thumb): ?>
                    <img src="<?= $thumb['thumbnail'] ?>" class="thumb-icon" alt="Publisher">
                  <?php endforeach; ?>
                </div>

                <?php if (count($titles)): ?>
                  <div class="calendar-tooltip">
                    <?php foreach ($titles as $i => $manga): if ($i == 3) break; ?>
                      <div class="tooltip-item">
                        <img src="<?= $manga['thumbnail'] ?>" class="tooltip-img" alt="">
                        <div title="<?= $manga['title_TH'] ?>"> <?= $manga['title_TH'] ?> 1</div>
                      </div>
                      <hr>
                    <?php endforeach; ?>
                  </div>
                <?php endif; ?>

                <?php $day++; ?>
              <?php endif; ?>
            </div>
          </a>
        <?php endfor; ?>
        <?php if ($day > $daysInMonth) break; ?>
      <?php endfor; ?>
    </div>
  </div>
</div>

<?php
$content = ob_get_clean(); // ดึงเนื้อหามาเก็บในตัวแปร
include "../app/views/layouts/main.php"; // ใช้ Main Layout
?>