<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Rejectedlesson extends Model
{

     use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'course_id', 'student_id', 'lesson_number', 'reason', 'year',
    ];


 		public function student(){

 			return $this->belongsTo('App\Student');
 		}

 		public function course(){

 			return $this->belongsTo('App\Course');
 		}
}
