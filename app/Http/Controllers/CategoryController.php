<?php

namespace EV\Http\Controllers;

use Illuminate\Http\Request;
use EV\Models\Category;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::all();
        return view('category.index', ['categories'=>$categories]);
    }

    public function create(){
        return view('category.form');
    }

    public function store(Request $request){
        $categories = new Category($request->all());
        $categories->save();
        return redirect()->route('categories.index');
    }

    public function detail($id){
        $category = Category::findOrFail($id);
        return view('category.detail', ['category'=>$category]);
    }

    public function edit($id){

    }
}
