<?php

namespace EV\Models;

use Illuminate\Database\Eloquent\Model;

class Test_rules extends Model
{
    protected $table="test_rules";
    protected $fillable = [
        'test_id', 'category_id','num_questions'
    ];

    public function test(){
        return $this->belongsTo('EV\Models\Test');
    }

    public function category(){
        return $this->belongsTo('EV\Models\Category');
    }

}
