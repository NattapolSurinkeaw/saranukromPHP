<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../images/favion.png">
    <title><?= $title ?? 'My Website' ?></title>
    <link rel="stylesheet" href="/css/index.css">
</head>
<body>

<?php 
  $shareData = $this->shareData; 
?>
  <div class="nav bg-white">
    <a href="/">
      <h1 class="logo-box">
        <span class="logo-box yellow">สารานุกรม</span>
        <span class="logo-box blue">การ์ตูน</span>
      </h1>
    </a>

    <input type="checkbox" id="nav-check">
    <div class="nav-header">
    </div>
    <div class="nav-btn">
      <label for="nav-check">
        <span></span>
        <span></span>
        <span></span>
      </label>
    </div>
    
    <div class="nav-links">
      <?php foreach($shareData['categories'] as $cate): ?>
      <a href="<?=$cate['cate_url']?>"><?=$cate['cate_title']?></a>
      <?php endforeach ?>
      <?php if(isset($_SESSION['user'])): ?>
        <a href="/logout">Logout</a>
      <?php endif ?>
    </div>
  </div>

  <main class="container">
      <?= $content ?? '' ?>
  </main>

  <footer>
    <p style="text-align: center; margin-top: 10px;">© <?= date('Y') ?> 7hmanga</p>
  </footer>

</body>
</html>