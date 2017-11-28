<?php
//twig
require_once "../vendor/autoload.php";

$loader = new Twig_Loader_Filesystem('templates');
$twig = new Twig_Environment($loader, array(
    'cache' => false
));

$email = array(
    1,2,3
);
$name = array(
    1,2,3
);
$phone = array(
    1,2,3
);
echo $twig->render('index.html', array(
    'email' => $email,
    'name' => $name,
    'phone' => $phone
));

echo "<a href=\" / \">Вернуться обратно</a>";