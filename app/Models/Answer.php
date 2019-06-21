<?php

namespace EV\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = ['description', 'correct'];

    public function question(){
        return $this->belongsTo('EV\Models\Question');
    }
}
