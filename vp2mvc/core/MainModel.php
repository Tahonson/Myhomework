<?php

namespace App;

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Eloquent\Model;

// работа с таблицей USERS
class User extends Model
{
    public $timestamps = false;

}
// работа с таблицей filelist
class filelist extends Model
{
    public $timestamps = false;
}
// коннект к базе
class MainModel
{
    public $capsule;

    public function __construct()
    {
        $capsule = new Capsule;
        $capsule->addConnection([
            'driver' => 'mysql',
            'host' => DB_SERVER,
            'database' => DB_NAME,
            'username' => DB_USER,
            'password' => DB_PASS,
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
        ]);
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }

}

