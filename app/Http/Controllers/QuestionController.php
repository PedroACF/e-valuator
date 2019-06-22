<?php

namespace EV\Http\Controllers;

use EV\Models\Answer;
use EV\Models\Category;
use EV\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuestionController extends Controller
{

    public function index($category_id){
        $category = Category::findOrFail($category_id);
        return view('question.index', ['category'=>$category]);
    }

    public function create($category_id){
        $category = Category::findOrFail($category_id);
        return view('question.form', ['category'=>$category, 'question'=>new Question()]);
    }

    public function store(Request $request, $category_id){
        $validatedData = $request->validate([
            'description' => 'required',
            'answers.*.description'=>'required',
            'answers.*.correct'=>'nullable'
        ]);
        $category = Category::findOrFail($category_id);

        DB::transaction(function() use ($category, $validatedData){
            $question = new Question($validatedData);
            $category->questions()->save($question);
            foreach ($validatedData['answers'] as $answerData){
                $answer = new Answer($answerData);
                $question->answers()->save($answer);
            }
        });
        return redirect()->route('questions.index', ['category_id'=>$category->id]);
    }

    public function edit($category_id, $id){
        $question = Question::findOrFail($id);
        return view('question.form', ['category'=> $question->category, 'question'=>$question]);
    }

    public function update(Request $request, $category_id, $id){
        $validatedData = $request->validate([
            'description' => 'required',
            'answers.*.description'=>'required',
            'answers.*.correct'=>'nullable'
        ]);
        $question = Question::findOrFail($id);

        DB::transaction(function() use ($question, $validatedData){
            $question->fill($validatedData);
            $question->save();
            foreach($question->answers as $answer){
                $answer->delete();
            }
            foreach ($validatedData['answers'] as $answerData){
                $answer = new Answer($answerData);
                $question->answers()->save($answer);
            }
        });
        return redirect()->route('questions.index', ['category_id'=>$category_id]);
    }
}
