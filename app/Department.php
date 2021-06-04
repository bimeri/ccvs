<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Department extends Model
{
    use Notifiable;

    protected $fillable = [
    	'name', 'faculty_id',
    ];

    public function admin(){

    	return $this->hasMany('App\Admin');

    }

    public function faculty(){

        return $this->belongsTo('App\Faculty');
    }

    public function semesters(){

    	return $this->belongsToMany('App\Semester', 'department_semester', 'department_id', 'semester_id');
    }

    public function users(){

        return $this->hasMany('App\User');
    }

    public function courses(){

        return $this->hasMany('App\Course');
    }

    public function outlines(){

        return $this->belongsToMany('App\Outline');
    }
    public function students(){

        return $this->hasMany('App\Student');
    }

     public function levels(){

    	return $this->hasMany('App\Level');
    }

     public function statistics(){

        return $this->hasMany('App\Statistic');

    }


}
