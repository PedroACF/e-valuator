<?php

namespace EV\Models;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    protected $table="tests";
    protected $fillable = [
        'description', 'course_id', 'minutes','start_at','end_at',
    ];

    public function category(){
        return $this->belongsToMany('EV\Models\Category','test_rules');
        //return $this->belongsToMany('App\Role', 'role_user', 'userId', 'roleId');
    }

    public function course(){
        return $this->belongsTo('EV\Models\Course');
    }

    public function solutions(){
        return $this->hasMany('EV\Models\Solution');
    }

    public function rules(){
        return $this->hasMany('EV\Models\Test_rules');
    }
}
