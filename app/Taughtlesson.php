<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Taughtlesson extends Model
{
	use Notifiable;
      /**
    * The attributes that are mass assignable.
    *
    * @var array
    */

    protected $fillable = [
    	'year_id', 'course_id', 'date', 'start_time', 'stop_time', 'venue','what_taught', 'lesson_number', 'number_subsection',
    ];

    public function user(){

        return $this->belongsTo('App\User');

    } 

    public function course(){

        return $this->belongsTo('App\Course');

    } 


    public function students(){

        return $this->belongsToMany('App\Student');

    }
}

