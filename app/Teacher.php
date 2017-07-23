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

    // protected $dates = ['date_of_birth'];

    // public function getDateOfBirthAttribute($value){

    // 	return $value->toDateString();
    // }

    public function getUsernameAttribute($value){
    	return ucfirst($value);
    }

    public function setNameAttribute($value){
    	$this->attributes['name']=  ucwords($value);
    }

    public function setDateOfBirthAttribute($value){

        $array = explode('-', $value);
        $y = $array[0];
        $m = $array[1];
        $d = $array[2];
        $date = Carbon::createFromDate($y,$m, $d);
        $this->attributes['date_of_birth'] = $date;
    }

    public function getDateOfBirthAttribute($date)
    {
        return Carbon::parse($date);
    }


    	
}
