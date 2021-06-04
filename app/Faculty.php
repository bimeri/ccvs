<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Faculty extends Model
{
	use Notifiable;


     protected $fillable = [
    	'name',
    ];

     public function department(){

        return $this->hasMany('App\Department');

    }

    public function levels(){

        return $this->hasMany('App\Level');

    }
}
