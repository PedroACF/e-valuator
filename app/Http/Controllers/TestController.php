<?php

namespace EV\Http\Controllers;

use EV\Models\Course;
use EV\User;
use EV\Models\Test;
use EV\Models\Category;

use Illuminate\Http\Request;

class TestController extends Controller
{
    var $path_view          = "test";
    var $path_controller    = "tests";
    var $title              = "Tests";
    public function index()
    {
        $data=Test::all();
        return view($this->path_view.'.index')
            ->with('path_controller',$this->path_controller)
            ->with('data',$data)
            ->with('title',$this->title);
    }
    public function create()
    {
        $courses=course::all();
        return view($this->path_view.'.create')
            ->with('path_controller',$this->path_controller)
            ->with('courses',$courses)
            ->with('title',$this->title);
    }
    public function store(Request $request)
    {
        //return redirect($this->path_controller);
        try
        {
            $v = \Validator::make($request->all(), [
            
                'description' => 'required',
                'course' => 'required',
                'minutes'    => 'required|numeric',
                'start_at'    => 'required',
                'end_at'    => 'required',
            ]);
     
            if ($v->fails())
            {
                return redirect()->back()->withInput()->withErrors($v->errors());
            }

            $test= new Test();
            $test->description=$request->description;
            $test->course_id=$request->course;
            $test->minutes=$request->minutes;
            $test->start_at=$request->start_at;
            $test->end_at=$request->end_at;
            $test->save();
            return redirect($this->path_controller);
        }
        catch(Exception $e)
        {
            return "Fatal error - ".$e->getMessage();
        }
        
    }
    public function show($id)
    {
        //$users=User::all();

        //return "show";
        
        $test=Test::findOrFail($id);
        $data=$test->category;
        //return $data;



        $category=Category::wherenotin('id',function($q) use ($id){
            $q->from('test_rules')->select('category_id')->where('test_id',$id);
        })->get();
        //return $users;

        /*$permiso=Permission::wherenotin('id',function($q) use ($id){
            $q->from('permission_role')->select('permission_id')->where('role_id',$id);
        })->get();*/


        return view($this->path_view.'.show')
            ->with('path_controller',$this->path_controller)
            ->with('id',$id)
            ->with('category',$category)
            ->with('data',$data)
            ->with('title',$this->title);
        
    }
    public function edit($id)
    {
        $item=Test::find($id);
        //return $item;
        $courses=Course::all();
        //return $datos;
        return view($this->path_view.'.edit')
            ->with('path_controller',$this->path_controller)
            ->with('item',$item)
            ->with('courses',$courses)
            ->with('title',$this->title)
            ->with('id',$id);
    }
    public function update(Request $request, $id)
    {
        try
        {
            $v = \Validator::make($request->all(), [
            
                'description' => 'required',
                'course' => 'required',
                'minutes'    => 'required|numeric',
                'start_at'    => 'required',
                'end_at'    => 'required',
            ]);
     
            if ($v->fails())
            {
                return redirect()->back()->withInput()->withErrors($v->errors());
            }

            $test=Test::find($id);
            $test->description=$request->description;
            $test->course_id=$request->course;
            $test->minutes=$request->minutes;
            $test->start_at=$request->start_at;
            $test->end_at=$request->end_at;
            $test->update();
            return redirect($this->path_controller);
        }
        catch(Exception $e)
        {
            return "Fatal error - ".$e->getMessage();
        }
    }
    public function destroy($id)
    {
        
    }    
}
