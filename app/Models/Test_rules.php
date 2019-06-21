<?php

namespace EV\Models;

use Illuminate\Database\Eloquent\Model;

class Test_rules extends Model
{
    protected $table="test_rules";
    protected $fillable = [
        'test_id', 'category_id','num_questions'
    ];
}
