@extends('layouts.main')

@section('content')
    <div class="box box-widget box-primary box-solid">
        <div class="box-header">
            <h3 class="box-title">
                {{$test->description}}
                <span>( RESTAN <span>))12</span> )</span>
            </h3>
        </div>
        <div class="box-body">

        </div>
        <div class="box-footer box-comments" style="background: white; padding: 0;">
            {{Form::open()}}
            <input type="hidden" name="solution[sid]" value="{{$solution->id}}">
            @foreach(\EV\Models\Question::whereIn('id', $questionArray )->inRandomOrder()->get() as $question)
                <div class="box-comment" style="border: solid 1px #0f74a8; margin: 5px; background: whitesmoke">
                    <div class="comment-text" style="margin-left: 3px">
                        <div class="username">
                            <input type="hidden" name="solution[questions][{{$loop->index}}][qid]" value="{{$question->id}}">
                            PREGUNTA {{$loop->index+1}}:
                        </div>
                        {!!$question->description!!}

                        <ul class="nav nav-stacked" style="margin-left: 1%; margin-right: 3px;">
                            @php  $question_index = $loop->index; @endphp
                            @foreach($question->answers()->inRandomOrder()->get() as $answer)
                                <li style="border: solid 1px #e1e1a5; margin-top: 5px;background: #cbffc4; padding: 3px;">
                                    @if($question->answers()->where('correct', true)->count() > 1)
                                        <input type="checkbox" name="solution[questions][{{$question_index}}][aids][]" value="{{$answer->id}}">
                                    @else
                                        <input type="radio" name="solution[questions][{{$question_index}}][aids][]" value="{{$answer->id}}">
                                    @endif
                                        {!! $answer->description !!}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endforeach

        </div>
        <div class="box-footer">
            <button type="submit" class="btn btn-primary pull-right" id="btn-submit">
                <i class="fas fa-paper-plane"></i> Enviar
            </button>
        </div>
        {{Form::close()}}
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script>
        $(function(){
            $("form").on("submit", function(e){
                var result =  confirm("Esta seguro de terminar?");
                console.log(result);
                return result;
            });

            $("form input").on("click", function(){
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
        });
    </script>
@endpush