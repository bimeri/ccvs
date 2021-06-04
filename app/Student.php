<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
	use Notifiable;


     protected $fillable = [
    	'name', 'matricule', 'password', 'department_id',
    ];

     public function courses(){

        return $this->belongsToMany('App\Course');

    } 
 

     public function registers(){

        return $this->hasMany('App\Register');

    } 

    public function department(){

        return $this->belongsTo('App\Department');
    }


    public function workcontents(){

     return $this->belongsToMany('App\Workcontent', 'student_workcontent', 'student_id', 'workcontent_id');

    }

    public function quizzes(){

        return $this->belongsToMany('App\Quiz');

    }

    public function outlines(){

        return $this->belongsToMany('App\Outline');
    }

    public function selectedstudents(){

        return $this->hasMany('App\Selectedstudent');
    } 

    public function rejectedlessons(){

        return $this->hasMany('App\Rejectedlesson');
    }



}
