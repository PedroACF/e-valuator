<?php

namespace EV\Http\Controllers;



use EV\Models\Test_rules;

use Illuminate\Http\Request;

class Test_rulesController extends Controller
{
    var $path_view          = "test";
    var $path_controller    = "tests";
    var $title              = "Test Rules";

    public function store(Request $request)
    {
        //return "entro";
        $v = \Validator::make($request->all(), [
            
            'test_id' => 'required',
            'category_id' => 'required',
            'num_questions' => 'required'
        ]);
 
        if ($v->fails())
        {
            return redirect()->back()->withInput()->withErrors($v->errors());
        }


        $test_rules= new Test_rules();
        $test_rules->test_id=$request->test_id;
        $test_rules->category_id=$request->category_id;
        $test_rules->num_questions=$request->num_questions;
        $test_rules->save();

        return redirect($this->path_controller."/".$request->test_id);
    }
}
