<?php
$title = "Search Cartoon"; // ตั้งชื่อหน้า
ob_start(); // เริ่มบันทึกเนื้อหา
?>

<div>
  <h2>Search Cartoon</h2>
  <form action="/search" method="POST" style="border: 2px solid gray;padding:5px;border-radius:5px;">
    <div style="display:flex;gap: 1rem;">
      <div style="width: 50%;">
        <input type="text" name="title_search" value="<?php echo isset($_POST['title_search']) ? htmlspecialchars($_POST['title_search']) : ''; ?>">
        <div>
          <label for="cateManga">Manga</label>
          <input type="radio" name="cate" value="2" id="cateManga" <?php if(isset($_POST['cate']) && $_POST['cate'] == 2)  { echo "checked" ;} ?> >
          <label for="cateDoujin">Doujin</label>
          <input type="radio" name="cate" value="3" id="cateDoujin"<?php if(isset($_POST['cate']) && $_POST['cate'] == 3)  { echo "checked" ;} ?> >
        </div>
      </div>
      <div style="width: 50%;">
        <p>filter Tags</p>
        <div>
          <?php foreach($tags as $tag): ?>
            <label for="<?=$tag['title_tag']?>"><?=$tag['title_tag']?></label>
            <input type="checkbox" name="searchTag[]" value="<?=$tag['id']?>" id="<?=$tag['title_tag']?>"  
              <?php if(isset($_POST['searchTag']) && in_array($tag['id'], $_POST['searchTag'])) { echo "checked"; } ?> >
          <?php endforeach ?>
        </div>
      </div>
    </div>
    <button style="margin-left: auto;" type="submit">search</button>
    <a href="/search">Clear</a>
  </form>

  <div style="display: flex; gap: 1rem; flex-wrap: wrap;margin-top: 1rem;">
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