<?php
include 'includes/connection.php';
require_once 'vendor/autoload.php';
$email = $con->real_escape_string($_POST['email']);
$name = $con->real_escape_string($_POST['name']);
$phone = $con->real_escape_string($_POST['phone']);

// проверка на существования пользователя

$user_add = $con->query("SELECT email FROM users WHERE email='$email'");
if (!$user_add->num_rows) {
    $con->query("INSERT INTO users (email,name,phone) VALUES ('$email','$name','$phone')");
    $user_id = $con->insert_id;
} else {
    $user_ids = $con->query("SELECT id FROM users WHERE email='$email'");
    $user_ids = mysqli_fetch_all($user_ids);
    foreach ($user_ids as $id) {
        foreach ($id as $ids) {
            $user_id = $ids;
        }
    }
}

// конец проверки
$street = $con->real_escape_string($_POST['street']);
$home = $con->real_escape_string($_POST['home']);
$part = $con->real_escape_string($_POST['part']);
$appt = $con->real_escape_string($_POST['appt']);
$floor = intval($_POST['floor']);
$comment = $con->real_escape_string($_POST['comment']);

//payment
if (($_POST['payment']) == 'cash') {
    $payment = 'cash';
} else $payment = 'card';
//callback
if (isset($_POST['callback']) && $_POST['callback'] == 'on') {
    $callback = false;
} else $callback = true;
$con->query("INSERT INTO orders (user_id,street,home,part,appt,floor,comment,payment,callback) VALUES  ('$user_id','$street','$home','$part','$appt','$floor','$comment','$payment','$callback')");
$order_id = $con->insert_id;
$count_order = 0;
//N-й заказ user'a.
$count_order = $con->query("SELECT id from orders WHERE user_id ='$user_id'");
$count_order = mysqli_fetch_all($count_order);
$count_order = count($count_order);

//письмо
$date = date('d.m.Y H:i:s');
$order_data = "<html><head><body>";
$order_data .= "<p>" . "Заказ  №  " . $order_id . "</p>";
$order_data .= "<br><p>Ваш заказ будет доставлен по адресу:</p><br>";
$order_data .= "<b>Улица :</b><b>$street</b><br>";
$order_data .= "<b>Дом :</b><b>$home</b><br>";
$order_data .= "<b>Корпус :</b><b>$part</b><br>";
$order_data .= "<b>Квартира :</b><b>$appt</b><br>";
$order_data .= "<b>Этаж :</b><b>$floor</b><br>";
$order_data .= "<b>Заказ:</b> DarkBeefBurger за 500 рублей, 1 шт<b></b>";
$order_data .= "<p>" . "Спасибо, это Ваш " . $count_order . " заказ." . "</p>";
$order_data .= "<p>" . $date . "</p>";
$order_data .= "</body></head></html>";

// письмо на почту

use PHPMailer\PHPMailer\PHPMailer;



$mail = new PHPMailer(true);                              // Passing `true` enables exceptions$this->
//$mail->SMTPDebug = 2;                                 // Enable verbose debug output
$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp1.mail.ru';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'loft_lessons@mail.ru';                 // SMTP username
$mail->Password = 'Prostohochuest';                           // SMTP password
$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465;                                    // TCP port to connect to

$mail->setFrom('loft_lessons@mail.ru', 'Бургерная №1');
$mail->addAddress("$email", "$name");     // Add a recipient
$mail->addReplyTo('loft_lessons@mail.ru', "Robot");
$mail->CharSet = 'UTF-8';

$mail->isHTML(true);                                  // Set email format to HTML
$mail->Subject = "Письмо с сайта Burgers. Ваш заказ от " . date('d.m.Y');
$mail->Body = "$order_data";
$mail->AltBody = 'Ваш почтовый клиент не поддерживает Html, попробуйте другой ';

// рекаптч проверка
$remoteIp = $_SERVER['REMOTE_ADDR'];
$gRecaptchaResponse = $_REQUEST['g-recaptcha-response'];
$recaptcha = new \ReCaptcha\ReCaptcha('6LckoTkUAAAAAKtJoDjKd0yAA-S_KAUg2gAMNgYd');
$resp = $recaptcha->verify($gRecaptchaResponse, $remoteIp);

if ($resp->isSuccess()) {

    if (!$mail->send()) {
        echo 'Письмо не может быть отправлено.';
        echo 'Ошибка: ' . $this->mail->ErrorInfo;
    } else {

        echo "<a href=\" / \">Вернуться обратно</a>";
    }
} else {
    echo 'Введите правильно каптчу<br>';
    echo "<a href=\" / \">Вернуться обратно</a>";

}
//



