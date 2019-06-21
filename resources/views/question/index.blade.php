@extends('layouts.main')

@section('content')
<div class="box box-widget box-primary box-solid">
    <div class="box-header">
        <h3 class="box-title">
        {{$category->name}}
        </h3>
    </div>
    <div class="box-body">
        <a href="{{route('questions.create', ['category_id'=>$category->id])}}" class="btn btn-primary pull-right">
            <i class="fas fa-plus"></i> Nueva pregunta
        </a>
    </div>
    <div class="box-footer box-comments">
        @foreach($category->questions as $question)
            <div class="box-comment">
                <div class="comment-text" style="margin-left: 3px">
                    <div class="username">
                        <button type="button" class="btn btn-primary btn-xs" title="Respuestas">
                            <i class="fas fa-list"></i> Respuestas
                        </button>
                        <a href="{{route('questions.edit', ['category_id'=>$category->id, 'id'=>$question->id])}}" class="btn btn-xs btn-primary">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                    </div>
                    {!!$question->description!!}
                </div>
            </div>
        @endforeach
    </div>   
    <div class="box-footer">
        <a href="{{route('categories.index')}}" class="btn btn-default">
            
            <i class="fas fa-arrow-left"></i> Volver
        </a>
    </div>     
</div>
@endsection
