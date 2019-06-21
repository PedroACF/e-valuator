<?php

namespace EV\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table="courses";
    protected $fillable = [
        'name', 'shortname', 'group',
    ];
    
    /*public function users_courses(){
        return $this->belongsToMany('App\User_Course');
    }*/
    public function users(){
        return $this->belongsToMany('EV\User','users_courses');
        //return $this->belongsToMany('App\Role', 'role_user', 'userId', 'roleId');
    }
}
