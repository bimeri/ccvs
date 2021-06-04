<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Section extends Model
{
    use Notifiable;

    protected $fillable = [
    	'subtopic', 'topic_id', 
    ];


    public function topic(){
        return $this->belongsTo('App\Topic');
    }

    public function subsections(){
    	return $this->hasMany('App\Subsection');
    }
}
