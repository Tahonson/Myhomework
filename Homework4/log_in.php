<?php
session_start();
include 'includes/connection.php';

if (!empty($_POST['login']) && !empty($_POST['password'])) {
    $login = htmlspecialchars($_POST['login']);
    $password = htmlspecialchars($_POST['password']);
    $user_query = $con->query("SELECT * FROM users WHERE login='$login'");
    $user = $user_query->fetch_assoc();
    $scan = password_verify($password, $user['password']);

    if (!empty($user) and $scan) {
        $_SESSION['user_id'] = $user['id'];

        header('Location: added.html');
    } else {
        header('Location: index.html');
    }
}