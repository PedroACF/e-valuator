<?php

namespace EV\Http\Controllers;

use Carbon\Carbon;
use EV\Http\Requests\TestRequest;
use EV\Models\Solution;
use EV\Models\Test;
use EV\Models\UserAnswer;
use http\Env\Response;
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
                $end_test = Carbon::now();
                $end_test->addMinutes($test->minutes);
                $solution = new Solution([
                    'user_id'=>$user->id,
                    'end_at'=>$end_test
                ]);
                $test->solutions()->save($solution);
                foreach($test->rules()->inRandomOrder()->get() as $rule){
                    foreach($rule->category->questions()->inRandomOrder()->limit($rule->num_questions)->get() as $question){
                        foreach($question->answers()->inRandomOrder()->get() as $answer){
                            $solution->userAnswers()->create([
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

        if( (new Carbon($solution->end_at))->isBefore(Carbon::now()) ){
            $solution->ended = true;
            $solution->save();
        }
        if($solution->ended){
            //calificamos
            $num_answers = 0;
            $num_correct = 0;
            foreach($solution->userAnswers()->get() as $userAnswer){
                if($userAnswer->marked == $userAnswer->answer->correct){
                    $num_correct++;
                }
                $num_answers++;
            }
            $solution->total = (100.0/$num_answers)*$num_correct;
            $solution->save();
        }

        return view('solution.test', ['solution'=>$solution, 'test'=>$test]);
    }

    public function solution(Request $request, $test_id){
        $solutions = $request->get('solution', []);
        $sid = $request->get('sid', 0);
        $solution = Solution::findOrFail($sid);
        $onlyForm = $request->get('f_t', "0");
        DB::transaction(function() use($onlyForm, $solution, $solutions){
            if($onlyForm=='1'){
                $solution->ended = true;
                $solution->save();
            }
            foreach ($solution->userAnswers()->get() as $answer){
                $answer->marked = false;
                $answer->save();
            }
            foreach($solutions as $solution){
                if(is_array($solution)){
                    foreach ($solution as $item){
                        $answer = UserAnswer::find($item);
                        if($answer){
                            $answer->marked = true;
                            $answer->save();
                        }
                    }
                }else{
                    $answer = UserAnswer::find($solution);
                    if($answer){
                        $answer->marked = true;
                        $answer->save();
                    }
                }
            }
        });

        if($onlyForm=='0'){
            return response()->json(['success'=>true]);
        }
        return redirect()->route('solution.solution',['test_id'=>$test_id]);
    }
}
