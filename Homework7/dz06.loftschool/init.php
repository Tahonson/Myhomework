<?php

namespace App;

use Illuminate\Database\Capsule\Manager as Capsule;

require_once 'vendor/autoload.php';
require_once 'includes/constants.php';
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
