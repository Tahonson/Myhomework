<?php

namespace App;
// age - совершеннолетник / несовершеннолетник
class UsersModel extends MainModel
{

    public function GetAll()
    {
        $users = User::all();
        return $users;
    }

    // create

    public function AddSmth($description, $age, $photo, $id)
    {
        $user = new User;
        $user->description = $description;
        $user->age = $age;
        $user->photo = $photo;
        $user->save();

        $filelist = new filelist;
        $filelist->user_id = $id;
        $filelist->filename = $photo;
        $filelist->save();
    }

}


//create read update delete