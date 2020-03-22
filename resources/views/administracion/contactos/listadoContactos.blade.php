@extends('administracion/adminTemplate')
@section('titleAdmin')
    {{$title}}
@endsection
@section('adminContent')
    <div class="breadcrumb">
        <a href="{{url('admin')}}">Administraci&oacute;n</a> <span class="glyphicon glyphicon-chevron-right"></span>
        <a href="{{url('admin/contactos')}}">Contactos</a> <span class="glyphicon glyphicon-chevron-right"></span>
        <a href="{{url('admin/contactos')}}">Ver Mensajes</a>
        <div class="pull-right">
            @include('administracion/notificacionBreadcrumb')
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <ul class="list-group">
                @foreach($mensajes as $mensaje)
                    <li class="list-group-item">
                        <a href="{{url('admin/contactos/mensaje/'.$mensaje->id)}}">Mensaje
                            de {{$mensaje->nombre}}({{$mensaje->email}})</a>
                    </li>
                @endforeach
                <div class="text-center">
                    {!! $mensajes->links() !!}
                </div>
            </ul>
        </div>
    </div>
@endsection