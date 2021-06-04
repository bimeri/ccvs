<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class DepartmentSemester extends Model
{
    use Notifiable;

    protected $fillable = [
    	'department_id', 'semester-id',
    ];
}
