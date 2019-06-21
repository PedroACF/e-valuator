<?php

namespace EV\Http\Controllers;

use EV\Models\Course;
use EV\User;

use Illuminate\Http\Request;

class CourseController extends Controller
{
    var $path_view          = "course";
    var $path_controller    = "courses";
    var $title              = "Courses";
    public function index()
    {
        $data=Course::all();
        return view($this->path_view.'.index')
            ->with('path_controller',$this->path_controller)
            ->with('data',$data)
            ->with('title',$this->title);
    }
    public function create()
    {
        return view($this->path_view.'.create')
            ->with('path_controller',$this->path_controller)
            
            ->with('title',$this->title);
    }
    public function store(Request $request)
    {
        //return redirect($this->path_controller);
        try
        {
            $v = \Validator::make($request->all(), [
            
                'name' => 'required',
                'shortname' => 'required',
                'group'    => 'required|numeric'
            ]);
     
            if ($v->fails())
            {
                return redirect()->back()->withInput()->withErrors($v->errors());
            }

            $course= new Course();
            $course->name=$request->name;
            $course->shortname=$request->shortname;
            $course->group=$request->group;
            $course->save();
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
        $course=Course::findOrFail($id);
        $data=$course->users;
        //return $data;



        $users=User::wherenotin('id',function($q) use ($id){
            $q->from('users_courses')->select('user_id')->where('course_id',$id);
        })->get();
        //return $users;

        /*$permiso=Permission::wherenotin('id',function($q) use ($id){
            $q->from('permission_role')->select('permission_id')->where('role_id',$id);
        })->get();*/


        return view($this->path_view.'.show')
            ->with('path_controller',$this->path_controller)
            ->with('id',$id)
            ->with('users',$users)
            ->with('data',$data)
            ->with('title',$this->title);
        
    }
    public function edit($id)
    {
        $item=Course::find($id);
        //return $datos;
        return view($this->path_view.'.edit')
            ->with('path_controller',$this->path_controller)
            ->with('item',$item)
            ->with('title',$this->title)
            ->with('id',$id);
    }
    public function update(Request $request, $id)
    {
        $v = \Validator::make($request->all(), [
            
            'name' => 'required',
            'shortname' => 'required',
            'group'    => 'required|numeric'
        ]);
 
        if ($v->fails())
        {
            return redirect()->back()->withInput()->withErrors($v->errors());
        }

        $course=Course::find($id);
        $course->name=$request->name;
        $course->shortname=$request->shortname;
        $course->group=$request->group;
        $course->update();

        //return $course;
        return redirect($this->path_controller);
    }
    public function destroy($id)
    {
        
    }
}
