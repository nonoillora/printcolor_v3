@extends('administracion/adminTemplate')
@section('titleAdmin')
    {{$title}}
@endsection
@section('adminContent')
    <div class="breadcrumb">
        <a href="{{url('admin')}}">Administraci&oacute;n</a> <span class="glyphicon glyphicon-chevron-right"></span> <a
                href="{{url('admin/presupuestos')}}">Presupuestos</a>

        <div class="pull-right">
            @include('administracion/notificacionBreadcrumb')
        </div>
    </div>
    <ul class="list-group">
        @foreach($presupuestos as $presupuesto)
            <a href="{{url('admin/presupuestos/'.$presupuesto->id)}}" class="list-group-item">
                <b>{{$presupuesto->nombre}}</b> solicita <b>{{$presupuesto->name}}</b>
                <span class="pull-right">
                    @if($presupuesto->respondido)
                        <span class="glyphicon glyphicon-send" data-toggle="tooltip" data-placement="right" title="Respondido el {{date_format(date_create($presupuesto->updated_at),'d/m/Y H:i:s')}}"></span>
                    @endif
                    &nbsp;&nbsp;{{date_format(date_create($presupuesto->created_at),'d/m/Y H:i:s')}}
                </span>
            </a>
        @endforeach
    </ul>
    <div class="text-center">
        {{$presupuestos->links()}}
    </div>
@endsection