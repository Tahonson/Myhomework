<?php

namespace App;

class AuthoModel extends MainModel {

    public function __construct()
    {

    }

    public function getIdByLogin($login)
    {
        $user = User::where('login', $login)->first();

        if (!empty($user)) {
            return $user->id;
        } else {
            return NULL;
        }
    }

    public function checkLoginAuth($login,$pass)
    {
        $user = User::where('login', $login)->first();
        $scan = password_verify($pass, $user->password);
        return $scan;
    }

//    public function CheckLoginAuth()
//    {
//        // хеширование пароля тут
//        // достаем из базы по логину пароль
//        // сравниваем хеш
//        //return - если совпали .
//    }
    // регистрация
    public function RegUser($login, $pass_hash)
    {
        $user = new User;
        $user->login = $login;
        $user->password = $pass_hash;
        $user->save();
        return  $user->id;

    }
    // проверка существования пользователя

}