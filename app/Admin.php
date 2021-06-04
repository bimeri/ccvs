<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Admin extends Authenticatable
{
    use Notifiable;

    protected $guard = 'admin';

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */

    protected $fillable = [
    	'name', 'email', 'password', 'department_id',
    ];

     /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */

     protected $hidden = [
     	'password', 'remember_token',
     ];

     //protected $table = 'admins';

  
     public function department(){

        return $this->belongsTo('App\Department');

    }

    public function outlines(){
        return $this->hasMany('App\Outline', 'admin_id');
    }

    public function courses(){
        return $this->hasMany('App\Course', 'course_id');
    }

     public function workcontents(){

        return $this->hasMany('App\Workcontent', 'admin_id');

    }
     public function statistics(){

        return $this->hasMany('App\Statistic');

    }

      
}
