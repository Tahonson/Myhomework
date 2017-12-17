<?php

namespace App;

//получать список всех файлов, которые были загружены пользователем
//получать список пользователей зарегистрированных в системе, отсортированных по возрасту.
//Возможность загружать файлы(изображения). Все файлы (имена) сохранять в БД
//Возможность создавать пользователя через админку
//Возможность регистрации и авторизации пользователя
//Возможность устанавливать фотографию(аватар) для себя или другого пользователя
class UsersController extends MainController
{

    protected $model;

    public function __construct()
    {
        $this->model = new UsersModel();
        parent::__construct();
    }

    public function index()
    {
        if (isset($_COOKIE['login'])) {
            // кука логина ;
            // Полчить массив пользователей
            $users = $this->model->getAll();
            $data = [
                'title' => "Список пользователей" , 'users' => $users
            ];
            $this->view->render('users/users.html', $data);
        } else {
         //   header(index)
        }
    }
    // функции тут пишем , всё что в контроле - методы
}