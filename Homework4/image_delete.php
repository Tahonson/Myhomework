<?php
include 'includes/connection.php';
$get_id = $_GET['id'];
$delete_photo = $con->query("SELECT * FROM users WHERE id = $get_id");
$path = mysqli_fetch_array($delete_photo);

if (file_exists("photos" . "/" . $path['photo']) and $path['photo'] !== '') {
    unlink("photos" . "/" . $path['photo']);
    $stmt = $con->query("UPDATE users SET photo ='' WHERE id=$get_id");
} else {

    echo "<br><a href=\"filelist.php\">Изображение уже было удалено. Вернуться обратно</a><br>";

}

