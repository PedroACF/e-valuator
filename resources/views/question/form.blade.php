@extends('layouts.main')

@section('content')
    <div class="box box-solid box-widget box-primary">
        {{Form::model($question)}}
        <div class="box-header">
            <h3 class="box-title">
            {{$category->name}}
            </h3>
        </div>
        <div class="box-body">
            <div class="form-group">
                {{Form::label('description', 'PREGUNTA')}}
                {{Form::textarea('description', null, ['class'=>'form-control rich-control'])}}
                @if($errors->has('description'))
                    <span class="label label-danger">{{$errors->first('description')}}</span>
                @endif
            </div>
            <div class="form-group">
                <label>RESPUESTAS</label>
            </div>
            <button class="btn btn-xs btn-primary" id="btn-add-answer" type="button">
                <i class="fas fa-plus"></i> Agregar respuestas
            </button>
        </div>
        <div class="box-footer box-comments">
        @foreach($question->answers as $answer)
        <div class='box-comment'>
            {{Form::checkbox("answers[{$loop->index}][correct]", 1, null, ['class'=>'img-sm img-circle'])}}
            <div class='comment-text'>
                <span class='username'>
                    <span>PREGUNTA {{$loop->index+1}}</span>
                    <button class='btn btn-xs btn-danger pull-right remove-answer' type='button'>
                        <i class='fas fa-trash'></i> Quitar
                    </button>
                </span>
                {{Form::textarea("answers[{$loop->index}][correct]", null, ['class'=>'form-control'])}}
            </div>
        </div>
        @endforeach
        </div>
        <div class="box-footer">
            <a href="{{route('questions.index', ['category_id'=>$category->id])}}" class="btn btn-default">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
            <button type="submit" class="btn btn-primary pull-right">
                <i class="fas fa-save"></i> Guardar
            </button>
        </div>
        {{Form::close()}}
    </div>
@endsection

@push('scripts')
    <script src="/plugins/ckeditor/ckeditor.js"></script>
    <script>


        $(function(){
            function addAnswer(){
                var $block = "<div class='box-comment'>"
                            + "<input type='checkbox' class='img-sm img-circle' value='1'>"
                            + "<div class='comment-text'>"
                            + "<span class='username'>"
                            + "<span></span><button class='btn btn-xs btn-danger pull-right remove-answer' type='button'><i class='fas fa-trash'></i> Quitar</button>"
                            + "</span>"
                            + "<textarea class='form-control'></textarea>"
                            + "</div>"
                            + "</div>";

                var $content = $(".box-comments");
                $content.append($block);
                removeHandler();
                rename();
            }

            function rename(){
                $(".box-comments .box-comment").each(function(index){
                    var $item = $(this);
                    $item.find(".username span").html("RESPUESTA "+(index+1));
                    $item.find("input").prop('name', 'answers['+index+'][correct]');
                    $item.find("textarea").prop('name', 'answers['+index+'][description]');
                });
            }

            $("#btn-add-answer").on("click", function(e){
                e.preventDefault();
                addAnswer();
            });

            function removeHandler(){
                $(".remove-answer").on("click", function(e){
                    e.preventDefault();
                    $(this).closest(".box-comment").remove();
                    rename();
                });
            }

            removeHandler();
            CKEDITOR.replaceAll('rich-control');
        });
    </script>
@endpush