@extends('administracion.adminTemplate')
@section('titleAdmin')
    {{$title}}
@endsection
@section('adminContent')
    <div class="breadcrumb">
        <a href="{{url('admin')}}">Administraci&oacute;n</a> <span class="glyphicon glyphicon-chevron-right"></span> <a
                href="{{url('admin/config')}}">Configuración</a>
 <span
         class="glyphicon glyphicon-chevron-right"></span> {{$config->config_key}}

        <div class="pull-right">
            @include('administracion/notificacionBreadcrumb')
        </div>
    </div>

    <div class="col-lg-12">&nbsp;</div>
    @if(Session::has('successEditConfig'))
        <div class="col-lg-12 alert alert-success">
            <b>{{Session::get('successEditConfig')}}</b>
        </div>
    @endif
    @if(Session::has('ErrorEditConfig'))
        <div class="col-lg-12 alert alert-danger">
            <b>{{Session::get('ErrorEditConfig')}}</b>
        </div>
    @endif

    <div class="col-lg-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Datos de la variable</h3>
            </div>
            <div class="panel-body">
                {!! Form::open(['method'=>'POST','url'=>'admin/config/edit']) !!}
                {!! Form::hidden('idConfig',$config->idConfig) !!}
                <div class="col-lg-12">
                    {{$config->description }}
                </div>
                <div class="col-lg-12"><br/></div>
                <div class="col-lg-2">
                    <b>Valor</b>
                </div>
                <div class="col-lg-10">
                    {!! Form::text('config_value',$config->value,['class'=>'form-control']) !!}
                </div>
                <div class="col-lg-12"><br/></div>

                <div class="col-lg-12">
                    {!! Form::submit('Guardar',['class'=>'btn btn-success btn-block']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <a href="{{url('admin/config')}}" class="btn btn-primary btn-block"><span
                    class="glyphicon glyphicon-chevron-left"></span> Volver</a>
    </div>

@endsection