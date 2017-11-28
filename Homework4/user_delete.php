<?php
include 'includes/connection.php';
$get_id = $_GET['id'];
$delete_user = $con->query("SELECT * FROM users WHERE id = $get_id");
$path = mysqli_fetch_all($delete_user);
if (file_exists("photos" . "/" . $path['photo']) and $path['photo'] !== '') {
    unlink("photos" . "/" . $path['photo']);
}
$stmt = $con->query("DELETE  FROM users WHERE id=$get_id");
header('Location: list.html');