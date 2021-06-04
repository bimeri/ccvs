<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Statistic extends Model
{
    use Notifiable;
     /**
    * The attributes that are mass assignable.
    *
    * @var array
    */

    protected $fillable = [
    	'course_id', 'semester_id', 'department_id', 'time', 'percent', 'total_lecture', 'lecture_considered',
    ];

    public function year(){

        return $this->belongsTo('App\Year');

    }

    public function semeter(){

        return $this->belongsTo('App\Semester');

    }
    
    public function course(){

        return $this->belongsTo('App\Course');

    }

    public function admin(){

        return $this->belongsTo('App\Admin');

    }

    public function department(){

        return $this->belongsTo('App\Department');

    }
}
