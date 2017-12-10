<?php

require_once '../init.php';
require_once '../order.php';

$id = $_GET['id'];
$street = $_POST['street'];
$home = $_POST['home'];
$part = $_POST['part'];
$appt = $_POST['appt'];
$floor = $_POST['floor'];
$comment = $_POST['comment'];
$payment = $_POST['payment'];
$callback = $_POST['callback'];

var_dump($street) ;

If ( \App\Order::ChangeOrder($id,$street, $home, $part, $appt, $floor, $comment, $payment, $callback)) {
    echo "Заказ $id изменен<br>";
    echo "<a href=\" /adminbar/index.php \">Вернуться обратно</a>";
} else {
    echo "что-то пошло не так";
}
