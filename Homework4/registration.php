<?php
include 'includes/connection.php';
session_start();
if (!empty($_POST['login']) && !empty($_POST['password']) && !empty($_POST['repassword']) && ($_POST['password']) == ($_POST['repassword'])) {
    $username = htmlspecialchars($_POST['login']);
    $password_undef = htmlspecialchars($_POST['password']);
    $password = password_hash($password_undef, PASSWORD_DEFAULT);

    $query = $con->query("SELECT * FROM users WHERE login='" . $username . "'");
    $numrows = mysqli_num_rows($query);

    if ($numrows == 0) {
        $sql = "INSERT INTO users(login,password) VALUES( '$username', '$password')";
        $result = $con->query($sql);
        if ($result) {
            $message = "Аккаунт успешно создан";
        } else {
            $message = "Такого пользователя не существует";
        }
    } else {
        $message = "Такой пользователь уже существует, попробуйте другой логин";
    }
} else {
    $message = "Не все поля заполнены, либо неверно подтвержден пароль";
}

?>

<?php if (!empty($message)) {
    echo "<p class=\"error\">" . "MESSAGE: " . $message . "</p>";
    echo "<br><a href=\"index.html\">Вернуться обратно</a><br>";
}
?>


