@extends('layouts.main')

@section('content')
<div class="box box-solid box-primary">
    <div class="box-header">
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
            <form method="post" action="{{route('categories.store')}}">
                @csrf
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input id="name" type="text" name="name" class="form-control upper">
                </div>
                <hr>
                <button class="btn btn-primary pull-right">
                    <i class="fas fa-save"></i> Guardar
                </button>
            </form>
            </div>
        </div>
    </div>
</div>
@endsection