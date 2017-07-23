<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Teacher extends Model
{
    protected $fillable = [
        'name', 'institution', 'date_of_birth',
        'email', 'phone', 'skills',
        'username',
    	];

    protected $dates = ['date_of_birth'];

    // public function getDateOfBirthAttribute($value){

    // 	return $value->toDateString();
    // }

    public function getUsernameAttribute($value){
    	return ucfirst($value);
    }

    public function setNameAttribute($value){
    	$this->attributes['name']=  ucwords($value);
    }

    	
}
