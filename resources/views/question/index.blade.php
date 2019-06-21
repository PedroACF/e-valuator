@extends('layouts.main')

@section('content')
    <div class="box box-solid box-primary">
        <div class="box-header">
        </div>
        <div class="box-body">
            <a href="{{route('questions.create', ['category_id'=>$category->id])}}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Nuevo
            </a>
            hello world
        </div>
    </div>
@endsection