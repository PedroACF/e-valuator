<?php

namespace EV\Models;

use Illuminate\Database\Eloquent\Model;

class UserAnswer extends Model
{
    protected $table="user_answers";
    protected $fillable = ['user_id', 'question_id', 'answer_id'];

    public function solution(){
        return $this->belongsTo('EV\Models\Solution');
    }

    public function question(){
        return $this->belongsTo('EV\Models\Question');
    }

    public function answer(){
        return $this->belongsTo('EV\Models\Answer');
    }
}
