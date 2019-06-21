@extends('layouts.main')

@section('content')


<a href="{{route('questions.create', ['category_id'=>$category->id])}}" class="btn btn-primary">
    <i class="fas fa-plus"></i> Nueva pregunta
</a>
@foreach($category->questions()->inRandomOrder()->get()  as $question)
    <div class="box box-solid">
        <div class="box-header pull-right">
            <a href="#" class="btn btn-primary btn-xs">
                <i class="fas fa-edit"></i> Editar
            </a>
        </div>
        <div class="box-body">
            {!! $question->description !!}
        </div>
    </div>
@endforeach
@endsection
