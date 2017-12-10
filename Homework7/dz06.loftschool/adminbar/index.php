<?php
//twig
require_once "../vendor/autoload.php";
include '../includes/connection.php';
require_once '../order.php';



$loader = new Twig_Loader_Filesystem('templates'); // выбираем деректорию, где храним шаблоны html
$twig = new Twig_Environment($loader, array(
    'cache' => false
));




$orders = \App\Order::GetAllOrders();
echo $twig->render('index.html', ['orders' => $orders]);

//$orders = \App\Order::ChangeOrder();
//echo $twig->render('index.html', ['orders' => $orders]);




//$user = Order::all();
//echo $this->view->render('createOrder.html.twig', ['id' => $user->id ,'email' => $user->email]);


echo "<a href=\" / \">Вернуться обратно</a>";



// у нас идет в php файле полдключение к html .