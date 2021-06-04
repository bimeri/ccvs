<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Topic extends Model
{
    use Notifiable;

    protected $fillable = [
    	'course_id', 'topic', 
    ];


    public function course(){
        return $this->belongsTo('App\Course');
    }

    public function sections(){
        return $this->hasMany('App\Section');
    }
}


