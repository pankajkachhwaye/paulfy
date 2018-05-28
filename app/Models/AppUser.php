<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppUser extends Model
{
    protected $table = 'app_users';

    protected $hidden = [
        'password'
    ];

    public function scopeGetByNameOrEmail($query,$email,$username){
        return $query->where(function($query) use ($email,$username){
            $query->where('email', $email)
                ->orWhere('user_name',$username);

        });

    }

    public function scopeGetByValue($query,$value){
        return $query->where(function($query) use ($value){
            $query->where('email', $value)
                ->orWhere('user_name',$value);

        });



    }

    public function scopecheckUser($query,$value){
        return $query->where(function ($query) use ($value){

            $query->where('id',$value);
        });
    }
}
