<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    public function assignment()
    {
        //return $this->belongsTo('App\Assignment');
        return $this->hasOne('App\Assignment', 'id', 'assignment_id');
    }

    public function student()
    {
        return $this->hasOne('App\Student', 'id', 'student_id');
    }
}
