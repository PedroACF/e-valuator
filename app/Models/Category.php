<?php

namespace EV\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name'];

    public function questions(){
        return $this->hasMany('EV\Models\Question');
    }

    public function testRules(){
        return $this->hasMany('EV\Models\Test_rules');
    }
}
