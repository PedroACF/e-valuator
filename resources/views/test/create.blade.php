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
                <h3 class="box-title">Registro</h3>
                </div>
                <!-- /.box-header -->
                
                <form class="form-horizontal" role="form" method="POST" action="{{ route($path_controller.'.store') }}">
                {{ csrf_field() }}
                <div class="box-body">
                    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                        <label for="description" class="col-md-4 control-label">Description :</label>

                        <div class="col-md-6">
                            <input id="description" type="text" class="form-control" name="description" value="{{ old('description') }}" autofocus>

                            @if ($errors->has('description'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="form-group{{ $errors->has('course') ? ' has-error' : '' }}">
                        <label for="course" class="col-md-4 control-label">Course :</label>

                        <div class="col-md-6">
                            <select class="form-control selectpicker" name="course" data-live-search="true">
                                <option value="">Select</option>
                                @foreach($courses as $key => $item)
                                <option value="{{$item->id}}">{{$item->shortname}} {{$item->name}} ({{$item->group}})</option>
                                @endforeach
                            </select>

                            @if ($errors->has('minutes'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('minutes') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('minutes') ? ' has-error' : '' }}">
                        <label for="minutes" class="col-md-4 control-label">Minutes :</label>

                        <div class="col-md-6">
                            <input id="minutes" type="text" class="form-control" name="minutes" value="{{ old('minutes') }}" autofocus>

                            @if ($errors->has('minutes'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('minutes') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('start_at') ? ' has-error' : '' }}">
                        <label for="start_at" class="col-md-4 control-label">Start_at :</label>

                        <div class="col-md-6">
                            <input id="start_at" type="datetime-local" class="form-control" name="start_at" value="{{ old('start_at') }}" autofocus>

                            @if ($errors->has('start_at'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('start_at') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('end_at') ? ' has-error' : '' }}">
                        <label for="end_at" class="col-md-4 control-label">End_at :</label>

                        <div class="col-md-6">
                            <input id="end_at" type="datetime-local" class="form-control" name="end_at" value="{{ old('end_at') }}" autofocus>

                            @if ($errors->has('end_at'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('end_at') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Create
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
<script>
  $(document).ready(function () {
    $('.selectpicker').selectpicker({
    style: 'btn-default'
    });
});
</script>
@endpush
