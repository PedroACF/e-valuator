@extends('layouts.main')

@section('content')

<div class="box box-solid box-primary">
    <div class="box-header">
        <h3 class="box-title">
            Categorias
        </h3>
    </div>
    <div class="box-body no-padding">

    <div class="mailbox-controls">
        <a href="{{route('categories.create')}}" class="btn btn-primary pull-right">
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
    @forelse($categories as $category)
    <tr>
    <td>
    {{$category->name}}
    </td>
    <td>
    </td>
    <td>
        <a class="btn btn-primary btn-xs" href="{{route('questions.index', ['category_id'=>$category->id])}}">
            <i class="fas fa-list"></i> Preguntas
        </a>
        <a class="btn btn-primary btn-xs" href="{{route('categories.edit', ['id'=>$category->id])}}">
            <i class="fas fa-edit"></i> Editar
        </a>
    </td>
    </tr>
    @empty
        <tr>
            <td colspan="3">No existen items</td>
        </tr>
    @endforelse
    </tbody>
    </table>
    </div>
</div>
@endsection