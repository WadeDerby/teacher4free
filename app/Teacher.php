<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = [
        'name', 'institution', 'date_of_birth',
        'email', 'phone', 'skills',
        'username',
    	];
}
