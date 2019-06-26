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
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <!-- The time line -->
            <ul class="timeline">
                <!-- timeline time label -->

                @foreach($test_enabled as $key => $item)
                @if($item->num>0)
                <li class="time-label">
                        <span class="bg-red">
                        {{$item->start_at}}
                        </span>
                </li>

                <li>
                    <i class="fa fa-edit bg-blue"></i>

                    <div class="timeline-item">
                    <span class="time"><i class="fa fa-clock-o"></i>Finaliza - {{$item->end_at}}</span>

                    <h3 class="timeline-header"><a href="#">{{$item->shortname}} {{$item->course_name}} G {{$item->group}}</a> {{$item->description}}</h3>

                    <div class="timeline-body">
                        La prueba tiene una duración de {{$item->minutes}} minutos, antes de finalizar la prueba asegurese de haber marcado las respuestas
                    </div>
                    <div class="timeline-footer">
                        <a class="btn btn-primary btn-xs" href="{{url('s/'.$item->id)}}" onclick="return confirm('¿Estas seguro?');"> Iniciar prueba</a>
                        <!--<a class="btn btn-danger btn-xs">Delete</a>-->
                    </div>
                    </div>
                </li>
                @endif
                @endforeach


                

                <li>
                    <i class="fa fa-hourglass-end bg-gray"></i>
                </li>
            </ul>
        </div>
        <!-- /.col -->
    </div>
</section>
@endsection

@push('scripts')
@endpush
