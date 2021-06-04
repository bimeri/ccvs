<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Semester extends Model
{
	use Notifiable;
     /**
    * The attributes that are mass assignable.
    *
    * @var array
    */

    protected $fillable = [
    	'name',
    ];

    public function year(){

        return $this->belongsTo('App\Year');

    }
    
    public function courses(){

        return $this->hasMany('App\Course');

    }

     public function statistics(){

        return $this->hasMany('App\Statistic');

    }

     public function departments(){

        return $this->belongsToMany('App\Department', 'department_semester', 'department_id', 'semester_id');
    }
}
