<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'fname', 'lname', 'email', 'phone', 'password', 'image','faculty', 'department', 
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

     public function courses(){

        return $this->hasMany('App\Course');

    }

    public function students(){

        return $this->belongsToMany('App\Student', 'student_user', 'student_id', 'user_id');

    }

    public function taughtlesson(){

        return $this->hasMany('App\Taughtlesson');

    }

    public function quizzes(){

        return $this->hasMany('App\Quiz');

    } 
    
    public function outline(){

        return $this->hasMany('App\Outline');

    } 

    public function department(){

        return $this->belongsTo('App\Department');

    } 


    public function selectedstudents(){

        return $this->hasMany('App\Selectedstudent');

    } 

    /* public function students(){

        return $this->belongsToMany('App\Student');

    } */
}
