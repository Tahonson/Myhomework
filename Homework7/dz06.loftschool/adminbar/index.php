<?php
//twig
require_once "../vendor/autoload.php";
include '../includes/connection.php';

$loader = new Twig_Loader_Filesystem('templates');
$twig = new Twig_Environment($loader, array(
    'cache' => false
));


echo "<a href=\" / \">Вернуться обратно</a>";