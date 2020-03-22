@extends('administracion.adminTemplate')
@section('adminContent')
    <div class="breadcrumb">
        <a href="{{url('admin')}}">Administraci&oacute;n</a> <span class="glyphicon glyphicon-chevron-right"></span> <a href="{{url('admin/pedidos/pendientes')}}">Pedidos Pendientes</a>
        <div class="pull-right">
            @if(true)
                <span class="animated infinite swing glyphicon glyphicon-bell"></span>&nbsp;&nbsp;<b
                        class="label label-success" data-toggle="tooltip" data-placement="bottom"
                        title="3 Notificaiones Nuevas">3</b>
            @endif
        </div>
    </div>
    pedidos pendientes here
    <ul class="list-group">
        @for($i=0;$i<5;$i++)
            <li class="list-group-item">{{$i+1}}</li>
        @endfor
    </ul>
@endsection