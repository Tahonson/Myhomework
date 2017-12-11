<?php

namespace App;

require_once '../init.php';
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Migrations\Migration;

class  CreateFlightsTable extends Migration
{

    public static function up()
    {


        Capsule::schema()->create('category', function ($table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description');
            $table->timestamps();
        });

        Capsule::schema()->create('burgers', function ($table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description');
            $table->integer('category_id');
            $table->timestamps();
        });
    }

}

CreateFlightsTable::up();