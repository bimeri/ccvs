<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Teacheregister extends Model
{
	use Notifiable;
     /**
    * The attributes that are mass assignable.
    *
    * @var array
    */

    protected $fillable = [
    	'teacher_id', 'course_id', 'L1', 'L2','L3', 'L4','L5', 'L6','L7', 'L8','L9', 'L10','L11', 'L12','L13', 'L14','L15', 'L16','L17', 'L18','L19', 'L20','L21', 'L22','L23', 'L24','L25', 'L26','L27', 'L28','L29', 'L30',
    ];
}
