<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Workcontent extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'description', 'main_content', 'admin_id', 'course_id', 
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'admin_id', 'course_id', 'remember_token',
    ];




     public function course(){

        return $this->belongsTo('App\Course', 'course_id');

    }

    public function admin(){

        return $this->belongsTo('App\Admin', 'admin_id');

    }
    public function user(){

        return $this->belongsTo('App\User', 'user_id');

    }

    public function students(){

        return $this->belongsToMany('App\Student',  'student_workcontent', 'student_id', 'workcontent_id');

    }
}
