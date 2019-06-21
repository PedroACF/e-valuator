@extends('layouts.main')

@section('content-header')
    <h1><i class="fas fa-truck"></i> Tractocamiones</h1>
@endsection

@section('breadcrumb')
    <li class="active">
        <a href="#"><i class="fas fa-truck"></i> Tractocamiones</a>
    </li>
@endsection 

@section('content')
<section class="content-header">
    <h1>
    {{$title}}
    <small>vista previa</small>
    </h1>
    <ol class="breadcrumb">
    <li><a href="{{ route($path_controller.'.index') }}" class="cargar_href"><i class="fa  fa-newspaper-o"></i> Home</a></li>
    <li class="active">Create</li>
    <!--<li class="active">Data tables</li>-->
    </ol>
</section>
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                <h3 class="box-title">Edit</h3>
                </div>
                <!-- /.box-header -->
                <form class="form-horizontal" role="form" method="POST" action="{{ route($path_controller.'.update',$id) }}">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="PUT">
                <div class="box-body">
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="col-md-4 control-label">Name :</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control" name="name" value="{{$item->name}}" autofocus>

                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('shortname') ? ' has-error' : '' }}">
                        <label for="shortname" class="col-md-4 control-label">Shortname :</label>

                        <div class="col-md-6">
                            <input id="shortname" type="text" class="form-control" name="shortname" value="{{ $item->shortname}}" autofocus>

                            @if ($errors->has('shortname'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('shortname') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('group') ? ' has-error' : '' }}">
                        <label for="group" class="col-md-4 control-label">Group :</label>

                        <div class="col-md-6">
                            <input id="group" type="text" class="form-control" name="group" value="{{ $item->group}}" autofocus>

                            @if ($errors->has('group'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('group') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Edit
                            </button>
                        </div>
                    </div>
                </div>
                </form>
                <!-- /.box-body -->
            
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
@endpush
