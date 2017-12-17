<?php

namespace App;

use erdiko\eloquent\Model;

class MainController
{
    protected $view;

    public function __construct()
    {
        $this->view = new MainView();
    }

}