@extends('layouts.main')

@section('content')
    <div class="box box-widget box-primary box-solid">
        <div class="box-header">
            <h3 class="box-title">
                {{$test->description}}
            </h3>
        </div>
        <div class="box-body">
            @if($solution->ended)
                <h3>Prueba terminada ({{round($solution->total)}}/100)</h3>
            @else
                <h4>Quedan <span id="minutos"></span> minutos, <span id="segundos"></span> segundos.</h4>
            @endif
        </div>
        @if(!$solution->ended)
        <div class="box-footer box-comments" style="background: white; padding: 0;">
            @if(!$solution->ended){{Form::open(['id'=>'question_form'])}}@endif
            <input type="hidden" name="sid" value="{{$solution->id}}">
                <input type="hidden" name="f_t" value="0" id="f_t">
            @php
                $used_questions = [];
                $index = 0;
            @endphp
            @foreach($solution->userAnswers()->get() as $userAnswer)
                @if(array_search($userAnswer->question_id, $used_questions)===false)
                    <div style="border: solid 2px #0f74a8; margin: 5px; padding:5px;background: whitesmoke">
                        <label>PREGUNTA {{count($used_questions)+1}}:</label>
                        {!!$userAnswer->question->description!!}
                        @php  $question_index = $loop->index; @endphp
                        @foreach($solution->userAnswers()->get() as $userAnswer2)
                            @if($userAnswer2->question_id==$userAnswer->question_id)
                                <div class="answers-block" >
                                    @if($solution->ended)
                                        <i class="far {{($userAnswer2->marked)?'fa-check-square':'fa-square'}} fa-2x"></i>
                                    @else
                                        @if($userAnswer2->question->answers()->where('correct', true)->count() > 1)
                                            <input type="checkbox" name="solution[{{count($used_questions)}}][]" value="{{$userAnswer2->id}}" {{$userAnswer2->marked?'checked':''}}>
                                        @else
                                            <input type="radio" name="solution[{{count($used_questions)}}]" value="{{$userAnswer2->id}}" {{$userAnswer2->marked?'checked':''}}>
                                        @endif
                                    @endif
                                    <div class="answer-text {{($solution->ended && $userAnswer2->answer->correct)?'correct':''}} ">
                                        {!! $userAnswer2->answer->description !!}
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    @php $used_questions[] = $userAnswer->question_id; @endphp
                @endif
            @endforeach
        </div>
        @endif
        <div class="box-footer">
            @if($solution->ended)
                <a href="/" class="btn btn-default">
                    <i class="fas fa-arrow-left"></i> Volver
                </a>
            @else
            <button type="submit" class="btn btn-primary pull-right" id="btn-submit">
                <i class="fas fa-paper-plane"></i> Enviar
            </button>
            @endif
        </div>
        @if(!$solution->ended){{Form::close()}}@endif
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="/plugins/iCheck/all.css">
    <style>
        .answers-block{
            margin: 5px 0px 0px 10px; padding: 10px;
            display: -webkit-box;      /* OLD - iOS 6-, Safari 3.1-6 */
            display: -moz-box;         /* OLD - Firefox 19- (buggy but mostly works) */
            display: -ms-flexbox;      /* TWEENER - IE 10 */
            display: -webkit-flex;     /* NEW - Chrome */
            display: flex;
        }
        .answer-text{
            -webkit-box-flex: 1;      /* OLD - iOS 6-, Safari 3.1-6 */
            -moz-box-flex: 1;         /* OLD - Firefox 19- */
            -webkit-flex: 1;          /* Chrome */
            -ms-flex: 1;              /* IE 10 */
            flex: 1;
            background: #d8e8f1;
            margin-left: 5px;
            padding: 5px;
        }
        .correct{
            border: solid 2px green;
            border-radius: 5px;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script src="/plugins/iCheck/icheck.js"></script>
    <script>
        $(function(){


            @if(!$solution->ended)
                var f_t = false;
                @php
                    $interval = \Carbon\Carbon::now()->diffInSeconds(new \Carbon\Carbon($solution->end_at), false);
                @endphp
                @if($interval>0)
                    var tempInterval = {{$interval}};
                    var tempo = setInterval(function(){
                        $("#minutos").html(parseInt(tempInterval/60));
                        $("#segundos").html(tempInterval%60);
                        tempInterval-=1;
                        if(tempInterval<0){
                            f_t = true;
                            $("#question_form").submit();
                            clearInterval(tempo);
                        }
                    },1000);
                @endif


            $("#question_form").on("submit", function(e){
                $("#question_form").find("#f_t").val(1);
                if(!f_t){
                    var result =  confirm("Esta seguro de terminar?");
                    return result;
                }
                alert("La prueba ha terminado...");
            });

            $("#question_form input").on("click", function(){
                var $form = $(this).closest("form");
                $.ajax({
                    url: "{{route('solution.solution', ['test_id'=>$test->id])}}",
                    method: 'post',
                    data: $form.serialize(),
                    success: function(data){
                        console.log(data);
                    }
                });
            });

            $('input[type="checkbox"], input[type="radio"]').on('ifChanged', function(event){
                var $form = $(this).closest("form");
                $.ajax({
                    url: "{{route('solution.solution', ['test_id'=>$test->id])}}",
                    method: 'post',
                    data: $form.serialize(),
                    success: function(data){
                        console.log(data);
                    }
                });
            });

            /*$("form li, form input[type='checkbox'], form input[type='radio']").on('click', function(e){
                e.stopImmediatePropagation();
                var $input = $(this).closest("li").find("input").first();
                $input.prop("checked", !$input.prop("checked"));
            });*/
            $('input[type="radio"], input[type="checkbox"]').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue'
            });
            @endif
        });
    </script>
@endpush