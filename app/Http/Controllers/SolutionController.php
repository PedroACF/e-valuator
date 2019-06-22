<?php

namespace EV\Http\Controllers;

use Carbon\Carbon;
use EV\Http\Requests\TestRequest;
use EV\Models\Solution;
use EV\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SolutionController extends Controller
{
    public function openTest(TestRequest $request, $test_id){
        $test = Test::findOrFail($test_id);
        $user = Auth::user();
        $solution =  $user->solutions()->where('test_id', $test->id)->first();
        if(!$solution){
            DB::transaction(function() use ($solution, $user, $test){
                $solution = new Solution([
                    'end_at'=>$test->end_at,
                    'user_id'=>$user->id,
                ]);
                $test->solutions()->save($solution);
                foreach($test->rules()->inRandomOrder()->get() as $rule){
                    foreach($rule->category->questions()->inRandomOrder()->limit($rule->num_questions)->get() as $question){
                        foreach($question->answers()->inRandomOrder()->get() as $answer){
                            $solution->user_answers()->create([
                                'user_id'=> $user->id,
                                'question_id' =>$answer->question_id,
                                'answer_id' => $answer->id
                            ]);
                        }
                    }
                }
            });
            $solution =  $user->solutions()->where('test_id', $test->id)->first();

        }
        $questionArray = Arr::pluck($solution->user_answers()->select('question_id as id')->distinct()->get(), 'id');
        return view('solution.test', ['solution'=>$solution, 'test'=>$test, 'questionArray' => $questionArray]);
    }

    public function solution(Request $request){
        dd($request->all());
    }
}
