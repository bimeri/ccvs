<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Year extends Model
{
	use Notifiable;
     /**
    * The attributes that are mass assignable.
    *
    * @var array
    */

    protected $fillable = [
    	'year',
    ];

     public function semester(){

        return $this->hasMany('App\Semester');

    }

     public function statistics(){

        return $this->hasMany('App\Statistic');

    }
}
