@extends('administracion.adminTemplate')
@section('titleAdmin')
    {{$title}}
@endsection
@section('adminContent')
    <div class="breadcrumb">
        <a href="{{url('admin')}}">Administraci&oacute;n</a> <span class="glyphicon glyphicon-chevron-right"></span> <a
                href="{{url('admin/config')}}">Configuración</a>

        <div class="pull-right">
            @include('administracion/notificacionBreadcrumb')
        </div>
    </div>
    <ul class="list-group">
        @foreach($configs as $config)
            <a href="{{url('admin/config/'.$config->idConfig.'/'.$config->config_key)}}" class="list-group-item">
                <h4 class="list-group-item-heading">
                        {{$config->config_key}}
                </h4>
                <p class="list-group-item-text">{{$config->description}}</p>
            </a>
        @endforeach
    </ul>
@endsection