<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Level extends Model
{
    use Notifiable;


     protected $fillable = [
    	 'name',
    ];


    public function courses(){

    	return $this->hasMany('App\Course');
    }

    public function departments(){
    	return $this->belongsTo('App\Department');
    }

    public function faculties(){
    	return $this->belongsTo('App\Faculty');
    }
}
