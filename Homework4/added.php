<?php
include 'includes/connection.php';
//
session_start();
if (isset($_SESSION['user_id'])) {

    if (!empty($_POST['name']) && !empty($_POST['age']) && !empty($_POST['description']) && !empty($_FILES)) {
        //фото
        $file = $_FILES['photo'];

        $file_type = $file['type'];

        $file_ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $file_name =  "file_user_".$_SESSION['user_id'].".".$file_ext;

        $img_ext = ['jpeg', 'png', 'jpg', 'gif'];
        $destination = "photos";
        if (!in_array($file_ext, $img_ext)) {
            die('это не картинка');
        } else {
            $get_file_dir = move_uploaded_file($file['tmp_name'], "$destination/$file_name");

        }

        $name = htmlspecialchars($_POST['name']);
        $age = htmlspecialchars($_POST['age']);
        $description = htmlspecialchars($_POST['description']);
        $added = $con->query("SELECT * FROM users WHERE id='$_SESSION[user_id]'");
        if (!empty($added)) {
            $con->query("UPDATE users SET name = '$name',age = '$age',description = '$description',photo = '$file_name' WHERE id='$_SESSION[user_id]'");
            header('Location: filelist.php');
        }
    } else {
        header('Location: added.html');
    }
} else {
    header('Location: index.html');
}

