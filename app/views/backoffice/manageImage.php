<?php
$title = "ManageImage : $id"; // ตั้งชื่อหน้า
ob_start(); // เริ่มบันทึกเนื้อหา
?>
<h2 style="text-align: center;">Episode ID : <?=$id?></h2>
<div>
    <form style="border: 2px solid gray;padding: 5px;margin-bottom: 5px" action="/addNewImage/<?=$id?>" method="POST">
        <textarea style="width: 500px;height: 70px;padding:5px;" name="link_image" id=""></textarea>
        <div>
          <button type="submit" style="margin-bottom: 5px;">เพิ่มรูป</button>
        </div>
    </form>

    <table border="2">
        <thead>
            <tr>
                <td>ลำดับ</td>
                <td>ชื่อ</td>
                <td>priority</td>
                <td>action</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach($images as $img): ?>
                <tr style="padding: 5px;">
                    <td style="text-align: center;"><?= $img['id'] ?></td>
                    <td style="width: 200px;">
                        <img style="width: 100px; height: 140px;" src="<?=$img['image_link']?>" alt="">
                    </td>
                    <td style="text-align: center;"><?= $img['priority'] ?></td>
                    <td style="padding: 5px;">
                        <button style="width: 50px;">แก้ไข</button>
                        <button style="width: 50px;">ลบ</button>
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