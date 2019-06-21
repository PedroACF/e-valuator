<?php

namespace EV\Models;

use Illuminate\Database\Eloquent\Model;

class User_course extends Model
{
    protected $table="users_courses";
    protected $fillable = [
        'user_id', 'course_id'
    ];
}
