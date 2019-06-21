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
        <li><i class="fa  fa-newspaper-o"></i class="active"> Home</li>
        <!--<li><a href="#">Tables</a></li>
        <li class="active">Data tables</li>-->
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <!-- /.box -->

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Lista</h3>
              <div class="pull-right">
                <a class="btn btn-sm btn-success cargar_href" href="{{ route($path_controller.'.create') }}" role="button">
                <i class="fa fa-plus">
                </i>
                Nuevo
                </a>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Shortname</th>
                    <th>group</th>
                    <th>action</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($data as $key=>$item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->shortname}}</td>
                        <td>{{$item->group}}</td>
                        <td class="text-center">
                            <a class="btn btn-primary" href="{{ route($path_controller.'.edit',$item->id) }}"><i class="fa fa-edit"></i></a>
                            
                            <a class="btn btn-info btn-info" href="{{ route($path_controller.'.show', $item->id) }}" alt="Mostar"><i class="fa fa-eye"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Shortname</th>
                    <th>group</th>
                    <th>action</th>
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
</script>
@endpush
