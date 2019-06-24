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
<h1>Bienvenido {{Auth::user()->name}}</h1>
<h3>
<a href="{{url('/test')}}">
<i class=""></i> <span>Ver examanes disponibles</span>
</a>
</h3>
@endsection

@push('scripts')
@endpush
