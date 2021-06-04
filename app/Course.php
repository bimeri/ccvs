<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Course extends Model
{
    use Notifiable;

    protected $fillable = [
    	'code', 'title', 'semester_id', 'user_id',
    ];

     public function user(){

        return $this->belongsTo('App\User');

    }

    public function topics(){
        return $this->hasMany('App\Topic');
    }

     public function students(){

        return $this->belongsToMany('App\Student');

    } //$student = App\Student::find(1); foreach($student->courses as $course)....

    public function statistics(){

        return $this->hasMany('App\Statistic');

    }

    public function registers(){

            return $this->belongsToMany('App\Register');
        }

    public function outline(){

            return $this->hasOne('App\Outline');
        }
    public function semester(){

        return $this->belongsTo('App\Semester');
    }
    public function department(){

        return $this->belongsTo('App\Department');
    }

     public function selectedstudents(){

        return $this->hasMany('App\Selectedstudent', 'course_id');
    }

    public function taughtlessons(){

        return $this->hasMany('App\Taughtlesson');
    }

    public function level()
    {
        return $this->belongsTo('App\Level');
    } 

    public function rejectedlessons()
    {
        return $this->hasMany('App\Rejectedlesson');
    }
}
