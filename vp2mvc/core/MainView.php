<?php

namespace App;

class MainView
{
    private $twig;
    public function __construct()
    {
        $loader = new \Twig_Loader_Filesystem('views');
        $this->twig = new \Twig_Environment($loader, array(
            'cache' => false));
    }

    public function render($filename, $date = null)
    {
//        require_once __DIR__.'views/'.$filename.'.html';
        echo $this->twig->render($filename, $date);
    }

    public static function render404 ( $mess = NULL ) {
        echo "404 ".$mess;
}
}