<?php

namespace EV\Http\Controllers;

use EV\Models\Answer;
use EV\Models\Category;
use EV\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuestionController extends Controller
{

    public function create($category_id){
        $category = Category::findOrFail($category_id);
        return view('question.form', ['category'=>$category]);
    }

    public function store(Request $request, $category_id){
        $category = Category::findOrFail($category_id);
        $question = $request->get('question', []);
        $answers = $request->get('answers', []);

        DB::transaction(function() use ($category, $question, $answers){
            $questionModel = new Question($question);
            $category->questions()->save($questionModel);
            foreach ($answers as $answer){
                $answerModel = new Answer($answer);
                $questionModel->answers()->save($answerModel);
            }
        });
        return redirect()->route('categories.detail', ['id'=>$category->id]);
    }
}
