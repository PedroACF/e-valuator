<?php

namespace EV\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['description'];

    public function category(){
        return $this->belongsTo('EV\Models\Category');
    }

    public function answers(){
        return $this->hasMany('EV\Models\Answer');
    }
}
