<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Subsection extends Model
{
    use Notifiable;

    protected $fillable = [
    	'course_id', 'section_id', 'sub_section', 
    ];


    public function section()
    {
        return $this->belongsTo('App\Section');
    }
}
