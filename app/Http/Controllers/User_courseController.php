<?php

namespace EV\Http\Controllers;

use EV\User_course;
use EV\User;
use EV\Course;

use Illuminate\Http\Request;

class User_courseController extends Controller
{
    var $path_view          = "layouts.course";
    var $path_controller    = "courses";
    var $title              = "User Course";

    public function store(Request $request)
    {
        $v = \Validator::make($request->all(), [
            
            'id_course' => 'required',
            'user' => 'required'
        ]);
 
        if ($v->fails())
        {
            return redirect()->back()->withInput()->withErrors($v->errors());
        }

        $course = Course::find($request->id_course);
        //return $course;
        $course->users()->attach($request->user);
        return redirect($this->path_controller."/".$request->id_course);
    }
}
