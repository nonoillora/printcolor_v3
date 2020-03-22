@extends('administracion/adminTemplate')
@section('titleAdmin')
    {{$title}}
@endsection
@section('adminContent')
    <div class="breadcrumb">
        <a href="{{url('admin')}}">Administraci&oacute;n</a> <span class="glyphicon glyphicon-chevron-right"></span> <a
                href="{{url('admin/contactos')}}">Contactos</a><span class="glyphicon glyphicon-chevron-right"></span>
        <a href="{{url('')}}">Mensaje de {{$mensaje->nombre}}</a>
        <div class="pull-right">
            @include('administracion/notificacionBreadcrumb')
        </div>
    </div>
    <div class="col-lg-12">

        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title"><b>{{ucfirst($mensaje->nombre)}}</b> solicita
                    <b>{{$mensaje->nombre}}</b></h3>
            </div>
            <div class="panel-body">
                <b>{{$mensaje->nombre}}</b> comenta:<br/>
                <div class="well">
                    {{$mensaje->mensaje}}
                </div>
                <div class="pull-right">
                    <a href="mailto:{{$mensaje->email}}" class="btn btn-primary">Enviar correo</a>
                </div>
            </div>
            <div class="panel-footer text-right">
                Enviado el <b>{{date_format(date_create($mensaje->created_at),'d/m/Y H:i:s')}}</b>
            </div>
        </div>
    </div>
@endsection