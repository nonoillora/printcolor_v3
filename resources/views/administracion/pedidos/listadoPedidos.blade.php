@extends('administracion.adminTemplate')
@section('titleAdmin')
    To define
    {{$title}}
@endsection
@section('adminContent')
    <div class="breadcrumb">
        <a href="{{url('admin')}}">Administraci&oacute;n</a> <span class="glyphicon glyphicon-chevron-right"></span> <a
                href="">Pedidos</a>
        <div class="pull-right">
            @include('administracion/notificacionBreadcrumb')
        </div>
    </div>
    <ul class="list-group">
        @foreach($pedidos as $pedido)
            <li class="list-group-item">
                <div class="row">
                    <a class="col-lg-9" href="{{url('admin/pedidos/pedido/'.$pedido->idPedido)}}">
                        {{$pedido->idPedido}}
                    </a>
                    </a>
                    <div class="col-lg-1">
                        @if($pedido->isPaid && !is_null($pedido->paid_at))
                            <span class="btn btn-success btn-circle" data-toggle="tooltip"
                                  data-placement="bottom"
                                  title="Pagado el {{$pedido->paid_at}}">
                                <span class="glyphicon glyphicon-usd"></span>
                            </span>
                        @else
                            <span class="btn btn-danger btn-circle" data-toggle="tooltip"
                                  data-placement="bottom" title="No pagado">
                                <span class="glyphicon glyphicon-usd"></span>
                            </span>
                        @endif
                    </div>
                    <div class="col-lg-1">
                        @if($pedido->isSent && !is_null($pedido->sent_at))
                            <span class="btn btn-success btn-circle" data-toggle="tooltip"
                                  data-placement="bottom"
                                  title="Enviado el {{$pedido->sent_at}}">
                                <span class="glyphicon glyphicon-send"></span>
                            </span>
                        @else
                            <span class="btn btn-danger btn-circle" data-toggle="tooltip"
                                  data-placement="bottom"
                                  title="Sin enviar">
                                <span class="glyphicon glyphicon-send"></span>
                            </span>
                        @endif
                    </div>
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
    </ul>
    <script type="text/javascript">
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endsection