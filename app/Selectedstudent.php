<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Selectedstudent extends Model
{
     use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
     'student_id', 'course_id', 'student_matricule', 'year_id',
    ];

    protected $hidden = [
    	'student_password',
    ];

    public function user(){

        return $this->belongsTo('App\User');
    } 

    public function course(){

        return $this->belongsTo('App\Course');
    }

    public function student(){

    	return $this->belongsTo('App\Student');
    }

}
