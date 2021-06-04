<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class CourseStudent extends Model
{
    use Notifiable;


    protected $fillable = [
    	'course_id', 'student_id',
    ];
}
