<?php
$title = "Name Manga : 00"; // ตั้งชื่อหน้า
ob_start(); // เริ่มบันทึกเนื้อหา
?>
<h2 style="text-align: center;">Dashboard</h2>
<div>
    <form style="border: 2px solid gray;padding: 5px;margin-bottom: 5px" action="/createManga" method="POST">
        <input type="text" name="title_TH" id="" placeholder="title_TH" required>
        <input type="text" name="title_EN" id="" placeholder="title_EN" required>
        
        <div style="display:flex;gap: 10px">
            <div>
                <label for="">manga</label>
                <input type="radio" name="cate_id" value="2" required>
            </div>
            <div>
                <label for="">doujin</label>
                <input type="radio" name="cate_id" value="3" required>
            </div>
        </div>
        <select name="slc_author" id="">
            <?php foreach($author as $auth): ?>
            <option value="<?=$auth['id']?>"><?=$auth['name_TH']?></option>
            <?php endforeach ?></php>
        </select>

        <h3 style="margin-top: 10px;">Tag Manga</h3>
        <div style="display: flex; gap: 1rem; flex-wrap: wrap; margin-bottom: 10px">
            <?php foreach($tags as $tag): ?>
            <div>
                <input type="checkbox" name="tags[]" value="<?=$tag['id']?>" id="">
                <label for=""><?=$tag['title_tag']?></label>
            </div>
            <?php endforeach ?>
        </div>
        
        <button type="submit" style="margin-bottom: 5px;">เพิ่มการ์ตูน</button>

        <div>
            <a style="border: 1px solid blue;padding: 3px;" href="/tagPage">เพิ่ม Tag</a>
            <a style="border: 1px solid blue;padding: 3px;" href="/authorPage">เพิ่ม Author</a>
        </div>
    </form>

    <table border="2">
        <thead>
            <tr>
                <td>ลำดับ</td>
                <td>ชื่อ</td>
                <td>รูปภาพ</td>
                <td>หมวดหมู่</td>
                <td>ผู้เขียน</td>
                <td>แท็ก</td>
                <td>action</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach($mangas as $manga): ?>
                <tr style="padding: 5px;">
                    <td style="text-align: center;"><?= $manga['id'] ?></td>
                    <td style="width: 500px;">
                        <a target="_blank" href="/backend/manageEpisode/<?=$manga['id']?>"><?= $manga['title_TH'] ?></a>
                    </td>
                    <td style="text-align: center;">
                        <img style="width: 100px;height: 140px;" src="<?=$manga['thumbnail']?>" alt="">
                    </td>
                    <td style="text-align: center;"><?= $manga['cate_id'] ?></td>
                    <td style="text-align: center;"><?= $manga['author_id'] ?></td>
                    <td style="text-align: center;"><?= $manga['tag_id'] ?></td>
                    <td style="padding: 5px;">
                        <button style="width: 50px;">แก้ไข</button>
                        <a href="/deleteManga/<?=$manga['id']?>" style="padding:0 8px; border: 1px solid red;">ลบ</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>

<?php
$content = ob_get_clean(); // ดึงเนื้อหามาเก็บในตัวแปร
include "../app/views/layouts/main.php"; // ใช้ Main Layout
?>