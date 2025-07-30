<?php
$title = "ManageEpisode : $id"; // ตั้งชื่อหน้า
ob_start(); // เริ่มบันทึกเนื้อหา
?>
<h2 style="text-align: center;">ManageManga ID : <?=$id?></h2>
<div>
    <form style="border: 2px solid gray;padding: 5px;margin-bottom: 5px" action="/createEpisode/<?=$id?>" method="POST">
        <input type="text" name="title" id="" placeholder="title" required>
        <button type="submit" style="margin-bottom: 5px;">เพิ่มตอน</button>
    </form>

    <table border="2">
        <thead>
            <tr>
                <td>ลำดับ</td>
                <td>ชื่อ</td>
                <td>action</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach($episodes as $ep): ?>
                <tr style="padding: 5px;">
                    <td style="text-align: center;"><?= $ep['id'] ?></td>
                    <td style="width: 500px;">
                        <a href="/backend/manageImage/<?=$ep['id']?>"><?= $ep['title'] ?></a>
                    </td>
                    <td style="padding: 5px;">
                        <button style="width: 50px;">แก้ไข</button>
                        <a href="/deleteEpisode/<?=$ep['id']?>/<?=$id?>" style="padding:0 8px; border: 1px solid red;">ลบ</a>
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