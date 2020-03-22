@extends('administracion.adminTemplate')
@section('titleAdmin')
    {{$title}}
@endsection
@section('adminContent')
    <div class="breadcrumb">
        <a href="{{url('admin')}}">Administraci&oacute;n</a> <span class="glyphicon glyphicon-chevron-right"></span> <a
                href="">Utilidades</a>

        <div class="pull-right">
            @include('administracion/notificacionBreadcrumb')
        </div>
    </div>
    <div class="col-lg-12">
        <div class="col-lg-4 text-center">
            <a href="{{url('admin/utilidades/cache')}}">
                <div class="thumbnail">
            <span class="btn btn-circle btn-primary btn-lg">
                <span class="glyphicon glyphicon-wrench"></span>
                <br/>
            </span>
                    <p> Limpiar cache</p>
                </div>
            </a>
        </div>
        <div class="col-lg-4 text-center">
            <a href="{{url('admin/utilidades/view')}}">
                <div class="thumbnail">
                        <span class="btn btn-circle btn-primary btn-lg">
                <span class="glyphicon glyphicon-wrench"></span>
                <br/>
            </span>
                    <p> Regenerar vistas</p>
                </div>
            </a>
        </div>
        <div class="col-lg-4 text-center">
            <a href="{{url('admin/utilidades/autoload')}}">
                <div class="thumbnail">
                        <span class="btn btn-circle btn-primary btn-lg">
                <span class="glyphicon glyphicon-refresh"></span>
                <br/>
            </span>
                    <p>Refrescar clases</p>
                </div>
            </a>
        </div>
        <div class="col-lg-4 text-center">
            <a href="{{url('admin/utilidades/events')}}">
                <div class="thumbnail">
                    <button class="btn btn-circle btn-primary btn-lg">
                        <span class="glyphicon glyphicon-refresh"></span>
                        <br/>
                    </button>
                    <p> Generar eventos y escuchadores</p>
                </div>
            </a>
        </div>
        <div class="col-lg-4 text-center">
            <a href="{{url('admin/utilidades/generateBackup')}}">
                <div class="thumbnail">
                        <span class="btn btn-circle btn-primary btn-lg">
                <span class="glyphicon glyphicon-wrench"></span>
                <br/>
            </span>
                    <p>Generar copia de seguridad ahora</p>
                </div>
            </a>
        </div>
        <div class="col-lg-4 text-center">
            <a href="{{url('admin/utilidades/clean')}}">
                <div class="thumbnail">
                        <span class="btn btn-circle btn-primary btn-lg">
                <span class="glyphicon glyphicon-cog"></span>
                <br/>
            </span>
                    <p>Limpiar copias de seguridad</p>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-12">
        @if(Session::has('utilityOK'))
            <div class="alert alert-success">
                <b>{{Session::get('utilityOK')}}</b>
            </div>
        @endif
        @if(Session::has('utilityKO'))
            <div class="alert alert-danger">
                <b>{{Session::get('utilityKO')}}</b>
            </div>
        @endif
    </div>
@endsection