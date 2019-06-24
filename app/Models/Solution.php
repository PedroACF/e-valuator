<?php

namespace EV\Models;

use Illuminate\Database\Eloquent\Model;

class Solution extends Model
{
    protected $fillable = ['user_id', 'end_at'];

    public function test(){
        return $this->belongsTo('EV\Models\Test');
    }

    public function user(){
        return $this->belongsTo('EV\User');
    }

    public function userAnswers(){
        return $this->hasMany('EV\Models\UserAnswer')->orderBy('id');
    }
}
