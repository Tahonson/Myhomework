<?php

namespace App;

require_once 'init.php';

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public $timestamps = false;

    public static function getIdByEmail($email)
    {
        $user = User::where('email', $email)->first();

        if (!empty($user)) {
            return $user->id;
        } else {
            return NULL;
        }
    }


    public static function AddUser($email, $name, $phone, $ip, $image)
    {

        $user = new User;
        $user->email = $email;
        $user->name = $name;
        $user->phone = $phone;
        $user->ip = $ip;
        $user->image = $image;

        $user->save();
        return $user->id;
    }


}