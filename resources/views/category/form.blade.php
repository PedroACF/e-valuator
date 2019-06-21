@extends('layouts.main')

@section('content')
<div class="box box-solid box-primary">
    <div class="box-header">
        <h3 class="box-title">
            Categorias
        </h3>
    </div>
    {{Form::model($category)}}
    <div class="box-body">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-group">
                    {{Form::label('name', 'Nombre')}}
                    {{Form::text('name', null, ['class'=>'form-control upper'])}}
                    @if($errors->has('name'))
                    <span class="label label-danger">{{$errors->first()}}</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="box-footer">
        <a href="{{route('categories.index')}}" class="btn btn-default">
            <i class="fas fa-arrow-left"></i> Cancelar
        </a>
        <button class="btn btn-primary pull-right">
            <i class="fas fa-save"></i> Guardar
        </button>
    </div>
    {{Form::close()}}
</div>
@endsection