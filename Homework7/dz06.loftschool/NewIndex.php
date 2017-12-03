<?php
//include 'includes/connection.php';
namespace App;

require_once 'init.php';

use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Eloquent\Model;


$email = $_POST['email'];
$name = $_POST['name'];
$phone = $_POST['phone'];
$street = $_POST['street'];
$home = $_POST['home'];
$part = $_POST['part'];
$appt = $_POST['appt'];
$floor = $_POST['floor'];
$comment = $_POST['comment'];
$file = $_FILES['photo'];

// попытка
//class User extends Model
//{
//
//    protected $fillable = ['email', 'name', 'phone', 'ip'];
//
//    public static function firstOrNewId()
//    {
//
//        $id = self::firstOrNew(['email' => $_POST['email']], // как получить доступ к таблице users
//            ['phone' => $_POST['email']],
//            ['name' => $_POST['name']],
//            ['ip' => $_SERVER['REMOTE_ADDR']]);
//
//        $id->name = $_POST['name'];
//        $id->phone = $_POST['phone'];
//        $id->ip = $_SERVER['REMOTE_ADDR'];
//
//        $file_ext = strtolower(pathinfo($_FILES['name'], PATHINFO_EXTENSION));
//        $img_ext = ['jpeg', 'png', 'jpg', 'gif'];
//        $destination = "photos";
//        if (!in_array($file_ext, $img_ext)) {
//            die('Загружено не изображение');
//        } else {
//            $img = Image:: make($_FILES['image']['tmp_name']);
//            $img->fit(480,480);
//            $img->save($destination/$_POST['phone'].'.jpg',"60");
//        }
//        $id->image = "images/".$_POST['phone'].".jpg";
//        $id->save;
//        return $id->id;
//    }
//}


// попытка

if (($_POST['payment']) == 'cash') {
    $payment = 'cash';
} else $payment = 'card';

if (isset($_POST['callback']) && $_POST['callback'] == 'on') {
    $callback = false;
} else $callback = true;

$ip = $_SERVER['REMOTE_ADDR'];


if ($email) {
//вытаскиваем полностью зарегистрированного юзера , если он есть.
    $user = Capsule::table('users')->where('email', '=', $email)->get();
// проверка на существование
    if (count($user)) {
// в случае, если существует - вытаскиваем id;
        $user_id = $user->get('id');  // вытащить id пользователя из базы


    } else {
        $file_name = "file_user_" . "[$phone]" . ".jpg";
        $file_ext = strtolower(pathinfo($_FILES['name'], PATHINFO_EXTENSION));
        $img_ext = ['jpeg', 'png', 'jpg', 'gif'];
        $destination = "photos";
        if (!in_array($file_ext, $img_ext)) {
            die('Загружено не изображение');
        } else {
            $img = Image:: make($_FILES['image']['tmp_name']);
            $img->fit(480,480);
            $img->save($destination/$_POST['phone'].'.jpg',"60");
        }


            Capsule::table('users')->insert([
                'email' => $email,
                'name' => $name,
                'phone' => $phone,
                'image' => $file_name,
                'ip' => $ip
            ]);

        $try_id = Capsule::table('users')->where('email', '=', $email)->get();
        $user_id = $try_id->get('id');

            Capsule::table('orders')->insert([
                'user_id' => $user_id,
                'street' => $street,
                'home' => $home,
                'part' => $appt,
                'appt' => $appt,
                'floor' => $floor,
                'comment' => $comment,
                'payment' => $payment,
                'callback' => $callback
            ]);

            echo " новый пользователь создан";

    }
} else {
    die (" Не полностью заполнена форма<a href=\" / \">Вернуться обратно</a>");
}


// достаем номер заказа и количество заказов этого пользователя


    $try_order_id = Capsule::table('orders')->where('user_id', '=', $user_id)->get();
    $count_order = $try_order_id->count();
    $order_id = Capsule::table('orders')->where('user_id','=',$user_id)->find($count_order);


//N-й заказ user'a.


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







