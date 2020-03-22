@extends('administracion.adminTemplate')
@section('titleAdmin')
    {{$title}}
@endsection
@section('adminContent')
    <div class="breadcrumb">
        <a href="{{url('admin')}}">Administraci&oacute;n</a> <span class="glyphicon glyphicon-chevron-right"></span> <a href="{{url('admin/pedidos/pendientes')}}">Pedidos Pendientes</a>
        <div class="pull-right">
            @include('administracion/notificacionBreadcrumb')
        </div>
    </div>
    <ul class="list-group">
        @if(count($pedidos)>0)
            @foreach($pedidos as $pedido)
                <li class="list-group-item">
                    <div class="row">
                        <a class="col-lg-11" href="{{url('admin/pedidos/pedido/'.$pedido->idPedido)}}">
                            {{$pedido->idPedido}}
                        </a>
                        </a>
                        <div class="col-lg-1">
                            </a>
                            <a target="_blank" class="pull-right btn btn-primary"
                               href="{{url('admin/pedidos/factura/'.$pedido->idPedido)}}" data-toggle="tooltip"
                               data-placement="right" title="Descargar factura"><span class="fa fa-file-pdf-o"></span>
                            </a>
                        </div>
                    </div>
                </li>
            @endforeach
        @else
            <h3><span class="label label-default">No hay pedidos pendientes aun</span></h3>
        @endif
    </ul>
    <div class="text-center">
        {{$pedidos->links()}}
    </div>
@endsection