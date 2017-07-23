<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Qualification extends Model
{
    protected $fillable = ['teacher_id','experience','degree','course','institution'];
}
