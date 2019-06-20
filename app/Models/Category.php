<?php

namespace EV\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function index(){
        return view('category.index');
    }
}
