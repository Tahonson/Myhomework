<?php
include 'includes/connection.php';
$users_table = $con->query("SELECT * from users");
$order_table = $con->query("SELECT * from orders ");

$users_table = mysqli_fetch_all($users_table);
$order_table = mysqli_fetch_all($order_table);
// вывод юзеров

$print_users = "<html><head><body>";
$print_users .= "<table border='1px' style=\" width: 30%;padding: 10px;padding-right: 20px;   float: left; top: 40px; left: -70px; \">";
$print_users .= "<caption>Таблица зарегистрированных пользователей<br>  <a href=\" / \">Вернуться обратно</a> <br> <a href=\" admin1.php \">Cоздать свой заказ</a></caption>";

foreach ($users_table as $value) {
    $print_users .= "<tr>";
    foreach ($value as $keys => $values) {
        $print_users .= "<td>";
        $print_users .= " ". $values ." ";
        $print_users .= "</td>";
    }
    $print_users .= "</tr>";
}
$print_users .= "</table>";
$print_users .= "</body></head></html>";
echo $print_users;
// конец вывода юзеров

// вывод заказов
$print_order = "<html><head><body>";
$print_order .= "<table border='1px' style=' width: 50%;  padding: 10px; float: right;  top: 40px; right: -70px;   ' >";
$print_order .= "<caption>Таблица заказов</caption>";
$print_order .= "<tr><td>номер заказа</td><td>id</td><td>Улица</td>";
$print_order .= "<td>Дом</td><td>Корпус</td><td>Квартира</td>";
$print_order .= "<td>Этаж</td><td>Пожелания</td><td>Оплата</td><td>Перезвонить(1/0)</td></tr>";
foreach ($order_table as $value) {
    $print_order .= "<tr>";
    foreach ($value as $keys => $values) {
        $print_order .= "<td>";
        $print_order .= " ". $values ." ";
        $print_order .= "</td>";
    }
    $print_order .= "</tr>";
}
$print_order .= "</table>";
$print_order .= "</body></head></html>";
echo $print_order;

// конец вывода заказов