<?php

namespace EV\Http\Controllers;

use Illuminate\Http\Request;
use EV\Models\Category;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::all();
        return view('category.index', ['categories'=>$categories]);
    }

    public function create(){
        return view('category.form', ['category'=> new Category()]);
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'name'=> 'required|unique:categories'
        ]);
        $categories = new Category($validatedData);
        $categories->save();
        return redirect()->route('categories.index');
    }

    public function edit($id){
        $category = Category::findOrFail($id);
        return view('category.form', ['category'=>$category]);
    }

    public function update(Request $request, $id){
        $category = Category::findOrFail($id);
        $validatedData = $request->validate([
            'name'=> [
                'required',
                Rule::unique('categories')->ignore($category->id),
            ]
        ]);
        $category->fill($validatedData);
        $category->save();
        return redirect()->route('categories.index');
    }
}
