<?php
namespace App;
use erdiko\eloquent\Model;

require_once "vendor/autoload.php";
require_once 'core/init.php';
require_once 'core/MainModel.php';
require_once 'core/MainView.php';
require_once 'core/MainController.php';

$routes = explode('/', $_SERVER['REQUEST_URI']);

$controller_name = "Main";
$action_name = 'index';
// получаем контроллер
if (!empty($routes[1])) {

    $filename = "controllers/".strtolower($routes[1]).".php";
    $controller_name = $routes[1].'Controller';  //$controller_name+'Controller' Поменял  authoController

} else {
    $filename = "controllers/".strtolower($controller_name).".php";
}
// получаем действие
if (!empty($routes[2])) {
    $action_name = $routes[2];
}

//$filename = "controllers/".strtolower(($controller_name)).".php";


try {
    if (file_exists($filename)){
        require_once  $filename;
    } else {
        throw new \Exception("File not found");
    }

    $class_name = '\App\\'.ucfirst($controller_name);

    if (class_exists($class_name)) {
        $controller = new $class_name();
    } else {
        // MainView::render404();
            throw new \Exception("File found but class not found");
        }

        if (method_exists($controller, $action_name)) {
            $controller->$action_name(); // еще параметры нужны для вп
        } else {
            throw new \Exception("Method not found");
        }
    } catch (\Exception $e) {
    require  "errors/404.php";
}

echo "<br>контроллер:" .$controller_name. "<br>";
echo "<br>экшн:" .$action_name."<br>";
echo "<br>файл:" .$filename."<br>";
//router + controller + model;