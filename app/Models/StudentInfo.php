<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentInfo extends Model
{
    protected $fillable = [
        'student_id',
        'name',
        'course',
        'birthdate',
        'email_address',
        'path',
    ];
}
