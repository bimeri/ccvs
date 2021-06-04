<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Outline extends Model
{
	use Notifiable;


     protected $fillable = [
    	 'user_id', 'admin_id', 'course_id', 'description', 'number_of_weeks', 'number_of_assignment', 'number_of_continuous_accessment',
    ];


    public function admin(){

        return $this->belongsTo('App\Admin');

    }  

    public function department(){

        return $this->belongsTo('App\Department');

    } 

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