<?php

namespace App;

class authoController extends MainController
{

    protected $model;

    public function __construct()
    {
        $this->model = new authoModel();
        parent::__construct();

    }

    public function index()
    {
        // входная точка .
        // вывести через view свою страницу (  страницу регистрации , например )
        $data = [
            'title' => "Регистрация"
        ];
        $this->view->render('main/login.html', $data);
    }

    public function registration()
    {

        if (!empty($_POST['login']) && !empty($_POST['password']) && !empty($_POST['repassword']) && ($_POST['password']) == ($_POST['repassword'])) {

            $login = htmlspecialchars($_POST['login']);
            $pass = htmlspecialchars($_POST['password']);
            $pass_hash = password_hash($pass, PASSWORD_DEFAULT);

            if ($this->model->getIdByLogin($login) !== NULL) {
                $id = $this->model->RegUser($login, $pass_hash);
                $message = [
                    'title' => "Аккаунт успешно создан"
                ];
                $this->view->render('users/users.html', $message);
            } else {
                $message = [
                    'title' => "Такой пользователь уже существует, попробуйте другой логин"
                ];
                $this->view->render('main/index.html', $message);
            }
        } else {
            $message = [
                'title' => "Не все поля заполнены, либо неверно подтвержден пароль"
            ];

            $this->view->render('main/index.html', $message);
        }


    }

    public function userAuth()
    {
        $login = htmlspecialchars($_POST['login']);
        $pass = htmlspecialchars($_POST['password']);

        if ($this->model->checkLoginAuth($login, $pass) !== NULL) {

            setcookie('login', 1, time() + 24 * 60 * 60);
            header('Location: views/users/users.html');
        } else {
            header('Location: views/main/index.html');
        }


    }


}