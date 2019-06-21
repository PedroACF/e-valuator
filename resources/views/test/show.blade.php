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
    <li><a href="{{ route($path_controller.'.index') }}" class="cargar_href"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li class="active">Ver</li>
    </ol>
</section>

    <!-- Main content -->
<section class="content">
        






    <div class="row">
        
        <div class="col-xs-12">
          <!-- /.box -->

            <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">User Course</h3>
            </div>
            <div class="box-body">
                <form class="" role="form" method="POST" action="{{ route('test_rules.store') }}">
                {{ csrf_field() }}
                <input type="hidden" value="{{$id}}" name="test_id">
                <div class="row">
                    <div class="col-xs-4 col-md-offset-2">
                        <label>Category</label>
                    </div>
                    <div class="col-xs-4">
                        <label>Number questions</label>
                    </div>
               
                </div>
              
                <div class="row">
                    
                 
                    <div class="form-group col-xs-4 col-md-offset-2" id="permiso_error_div">
                        <select class="form-control selectpicker" name="category_id" data-live-search="true">
                        <option value="">Select</option>
                        @foreach($category as $key => $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                        </select>
                      
                    </div>
                    <div class="form-group col-xs-4" id="rol_error_div">
                        <input type="text" class="form-control" placeholder="Introduzca ..." name="num_questions" value="" >
                        <span class="help-block error" id="rol_error"></span>
                    </div>

                </div>
                
                <div class="row">
                    <div class="col-xs-12">
                        <div class="pull-right">
                            
                            <input type="submit" class="btn btn-block btn-primary" value="Insertar" >
                        </div>
                    </div>
                </div>
                </form>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>

    <div class="row">
      <div class="col-xs-12">
        <!-- /.box -->

        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Lista</h3>
            <div class="pull-right">
              {{--<a class="btn btn-sm btn-success cargar_href" href="{{ route($path_controller.'.create') }}" role="button">
              <i class="fa fa-plus">
              </i>
              Nuevo
              </a>--}}
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                  <th>Id</th>
                  <th>Name</th>
                  <th>Acciones</th>
              </tr>
              </thead>
              <tbody id="tablaDatos">
                  
                @foreach($data as $key=>$item)
                <tr>
                  <td>{{$item->id}}</td>
                  <td>{{$item->name}}</td>
                  <td></td>
                </tr>
                @endforeach

              </tbody>
              <tfoot>
              <tr>
                  <th>Nombre</th>
                  <th>Descripcion</th>
                  <th>Acciones</th>
              </tr>
              </tfoot>
            </table>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>
  <!-- /.row -->
</section>
@endsection

@push('scripts')
<script>
  $(function () {
    $('#example1').DataTable()

  })
  $(document).ready(function () {
    $('.selectpicker').selectpicker({
    style: 'btn-default'
    });
});
</script>
@endpush
