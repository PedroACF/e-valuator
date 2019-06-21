@extends('layouts.main')

@section('content')
<div class="box box-solid box-primary">
    <div class="box-header">
        <h3 class="box-title">
            LISTADO DE CATEGORIAS
        </h3>
    </div>
    <div class="box-body no-padding">
    <div>
        <a href="{{route('categories.create')}}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Nueva categoria
        </a>
    </div>

    <table class="table table-condensed">
    <thead>
    <tr>
    <th>Categoria</th>
    <th>Num. Preg.</th>
    <th>Opciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($categories as $category)
    <tr>
    <td>
    {{$category->name}}
    </td>
    <td>
    </td>
    <td>
        <a class="btn btn-primary btn-xs" href="{{route('categories.detail', ['id'=>$category->id])}}">
            <i class="fas fa-list"></i> Preguntas
        </a>
    </td>
    </tr>
    @endforeach
    </tbody>
    </table>
    </div>
</div>
@endsection