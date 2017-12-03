<?php
namespace  App;
use Illuminate\Database\Capsule\Manager as Capsule;

require_once "init.php";

$order_table = Capsule::table('orders')->get();

$print_order = "<html><head><body>";
$print_order .= "<table border='1px' style=' width: 100%;  padding: 10px; top: 40px; right: -70px;   ' >";
$print_order .= "<caption>Таблица заказов</caption>";
$print_order .= "<tr><td>номер заказа</td><td>id</td><td>Улица</td>";
$print_order .= "<td>Дом</td><td>Корпус</td><td>Квартира</td>";
$print_order .= "<td>Этаж</td><td>Пожелания</td><td>Оплата</td><td>Перезвонить(1/0)</td><td>Редактировать</td><td>Удалить</td></tr>";

foreach ($order_table as $value) {
    $print_order .= "<tr>";
    foreach ($value as $keys => $values) {
        $print_order .= "<td>";
        $print_order .= " ". $values ." ";
        $print_order .= "</td>";

   //     $print_order .= "<td></td>";  - изменить  ( cсылка , вызывающая
   //     $print_order .= "<td></td>";  - удалить


    }
    $print_order .= "</tr>";
}
$print_order .= "</table>";
$print_order .= "</body></head></html>";
echo $print_order;