<?php

namespace App;

class Main extends MainController
{

    public function index()
    {
        $title = [
            'title' => 'Регистрация'
        ];
        $this->view->render('main/index.html', $title);
    }

}