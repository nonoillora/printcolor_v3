@extends('administracion.adminTemplate')
@section('titleAdmin')
    {{$title}}
@endsection
@section('adminContent')
    <div class="breadcrumb">
        <a href="{{url('admin')}}">Administraci&oacute;n</a> <span class="glyphicon glyphicon-chevron-right"></span> <a
                href="">Pedidos</a> <span
                class="glyphicon glyphicon-chevron-right"></span> {{$pedido->numIdentificacionPedido}}
        <div class="pull-right">
            @include('administracion/notificacionBreadcrumb')
        </div>
    </div>
        @if(is_null($pedido->company_shipping))
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center">
                <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#modalEmpresaSeguimiento">
                    Compañia de envio
                </button>
            </div>
        @endif
    <div class="hidden-lg hidden-md col-sm-12 col-xs-12">
        <br/>
    </div>
        @if(empty($pedido->num_seguimiento))
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center">
                <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#modalNumSeguimiento">
                    Número de seguimiento
                </button>
            </div>
        @endif
    <div class="hidden-lg hidden-md col-sm-12 col-xs-12">
        <br/>
    </div>
        @if($pedido->num_seguimiento!='')
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center">
                <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#modalEditarNumSeguimiento">
                    Editar Núm. seguimiento
                </button>
            </div>
        @endif
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center" id="divPedidoPaid">
            @if($pedido->isPaid)
                <span class="btn btn-success btn-block">
            <span class="glyphicon glyphicon-info-sign" data-toggle="tooltip" data-placement="left"
                  title="pagado el {{date_format(date_create($pedido->paid_at),'d-m-Y H:i:s')}}"></span> Pagado <span class="glyphicon glyphicon-ok"></span>
                </span>
            @else
                <button class="btn btn-warning btn-block" id="setPaidPedido" data-id="{{$pedido->idPedido}}">Pagado</button>
            @endif
        </div>
    <div class="hidden-lg hidden-md col-sm-12 col-xs-12">
        <br/>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center" id="divPedidoSent">
            @if($pedido->isSent)
                <button class="btn btn-success btn-block">
            <span class="glyphicon glyphicon-send" data-toggle="tooltip" data-placement="left"
                  title="enviado el {{date_format(date_create($pedido->sent_at),'d-m-Y H:i:s')}}"></span> Enviado <span class="glyphicon glyphicon-ok"></span>
                </button>
            @else
                <button class="btn btn-primary btn-block" id="setSentPedido" data-id="{{$pedido->idPedido}}" data-toggle="tooltip"
                        data-placement="top" title="Marcar pedido enviado y notificar al
                cliente los datos del envio"
                        @if($pedido->isPaid==0 || empty($pedido->company_shipping) || $pedido->num_seguimiento=="") disabled @endif>
                    Enviar pedido*
                </button>
            @endif
        </div>
    <div class="col-lg-12">&nbsp;</div>
    <div class="col-lg-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Datos del cliente</h3>
            </div>

            <table class="table">
                <tr>
                    <td><b>Nombre completo</b>: {{$cliente->full_name}}</td>
                    <td><b>Teléfono</b>: {{$cliente->phone}}</td>
                    <td><b>Correo</b>: {{$cliente->email}}</td>
                </tr>
                <tr>
                    <td><b>Dirección</b>: {{$cliente->address}}</td>
                    <td><b>Población</b>: {{$cliente->poblation}}, {{$cliente->postal_code}}</td>
                    <td><b>Provincia</b>: {{$cliente->provence}}</td>
                </tr>
            </table>
        </div>
    </div>
    @if(isset($cliente->observations) && strlen($cliente->observations)>0)
        <div class="col-lg-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">Observaciones del cliente</h3>
                </div>
                <div class="panel-body">
                    {{$cliente->observations}}
                </div>
            </div>
        </div>
    @endif
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <!-- Default panel contents -->
            <div class="panel-heading">
                <h3 class="panel-title">Productos del pedido</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-6">Producto y cantidad</div>
                    <div class="col-lg-6">Caracteristicas</div>
                </div>
            </div>

            <!-- List group -->
            <ul class="list-group">
                @foreach($lineas as $linea)
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-lg-5">
                                @foreach(unserialize($linea->description) as $name => $valor)
                                    {{$name}} - {{$valor}}<br/>
                                @endforeach
                            </div>
                            <div class="col-lg-6">
                                @foreach(unserialize($linea->options) as $name => $valor)
                                    {{$name}} - {{$valor}}<br/>
                                @endforeach
                            </div>
                            <div class="col-lg-1">
                                {{$linea->price}}&euro;
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Datos del pedido</h3>
            </div>
            <table class="table">
                <tr>
                    <td><b>Creado</b>: {{date_format(date_create($pedido->created_at),'d-m-Y H:i:s')}}</td>
                    <td><b>Enviado</b>: <span
                                id="SentAt">{{date_format(date_create($pedido->sent_at),'d-m-Y H:i:s')}}</span></td>
                    <td><b>Total Pedido</b>: {{$pedido->totalPedido}}&euro;</td>
                </tr>
                <tr>
                    <td><b>Empresa de transporte</b>: <span id="companyShippingSelected">{{$empresaTransporte}}</span>
                    </td>
                    <td><b>Numero de seguimiento</b>: <span id="idNumSeguimiento">{{$pedido->num_seguimiento}}</span>
                    </td>
                    <td><b>Metodo de pago</b>: {{$metodoPago}}</td>
                </tr>
            </table>
        </div>
    </div>
    @if($pedido->idTipoPago==2 && !empty($payer))
        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="panel panel-success {{--card text-white border-success bg-success mb-3--}}">
                <div class="panel-heading card-header">
                    {{--<h3>--}}Datos del pago{{--</h3>--}}
                </div>
                <div class="{{--card-body--}}">
                    <table class="table text-center">
                        <tr>
                            <td><b>Pago realizado</b></td>
                            <td><b>Cantidad pagada</b></td>
                            <td><b>Estado de la Transacción</b></td>
                        </tr>
                        <tr>
                            <td>{{ date_format(date_create($payer->created_at),'d-m-Y H:i:s')}}</td>
                            <td>{{$payer->amountPay}} &euro;</td>
                            <td>{{$payer->statusTransaction}}</td>
                        </tr>
                        <tr>
                            <td><b>Navegador usado</b></td>
                            <td><b>Versión navegador usado</b></td>
                            <td><b>Plataforma</b></td>
                            @if(!empty($payer->deviceFamily))
                                <td><b>Dispositivo</b></td>
                                <td><b>Modelo disposito</b></td>
                            @endif
                        </tr>
                        <tr>
                            <td>{{$payer->browser}}</td>
                            <td>{{$payer-> version_browser}} </td>
                            <td>{{$payer->platform}}</td>
                            @if(!empty($payer->deviceFamily))
                                <td>{{$payer->deviceFamily}}</td>
                                <td>{{$payer->deviceModel}}</td>
                            @endif
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    @endif
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <a href="{{url('admin/pedidos/')}}" class="btn btn-primary btn-block"><span
                    class="glyphicon glyphicon-chevron-left"></span> Volver</a>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <br/>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel" id="modalNumSeguimiento">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="gridSystemModalLabel">Añadir número de seguimiento al pedido</h4>
                </div>
                <div class="modal-body">
                    <h4><label class="label label-info">Numero de seguimiento</label></h4>
                    <input type="text" class="form-control" placeholder="Añadir número de seguimiento"
                           id="numSeguimientoPedido">
                    <br/>

                    <div class="alert alert-success hidden" id="infoNumSeguimientoSuccess">
                        <b>Número de seguimiento añadido correctamente</b>
                    </div>
                    <div class="alert alert-warning hidden" id="infoNumSeguimientoAlert">
                        Por favor, rellena el número de seguimiento
                    </div>

                    <button type="button" class="btn btn-primary center-block"><span
                                class="glyphicon glyphicon-ok-circle" id="addNumSeguimientoPedido"
                                data-id="{{$pedido->idPedido}}"> Añadir</button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel"
         id="modalEmpresaSeguimiento">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="gridSystemModalLabel">Establecer empresa de transporte</h4>
                </div>
                <div class="modal-body center-block">
                    <span class="hidden" id="idPedido">{{$pedido->idPedido}}</span>
                    @foreach($shipppings as $company)
                        <button class="btn btn-info btn-block empresaTransportePedido" href="{{$company->idCompany}}"
                                data-idcompany="{{$company->idCompany}}"
                                data-namecompany="{{$company->name_company}}">{{$company->name_company}}</button>
                    @endforeach
                    <span class="hidden" id="showInfoProcessShipping">
                        <br/>
                    <div class="alert alert-success">
                        <span class="glyphicon glyphicon-ok-circle"></span> Se ha realizado el cambio correctamente
                    </div>
                        </span>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- modal editar numero de seguimiento -->
    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel"
         id="modalEditarNumSeguimiento">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="gridSystemModalLabel">Editar número de seguimiento</h4>
                </div>
                <div class="modal-body center-block">
                    <span class="hidden" id="idPedido">{{$pedido->idPedido}}</span>

                    <input class="form-control" type="text" data-numSeguimiento="{{$pedido->idPedido}}"
                           value="{{$pedido->num_seguimiento}}" id="numSeguimientoEdit">
                    <br/>
                    <button class="btn btn-block btn-success" id="EditarNumSeguimientoPedido">Actualizar Número de
                        seguimiento
                    </button>

                    <span class="hidden" id="showInfoUpdateNumSeguimiento">
                        <br/>
                    <div class="alert alert-success">
                        <span class="glyphicon glyphicon-ok-circle"></span> Se ha realizado el cambio correctamente
                    </div>
                        </span>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <script type="text/javascript" src="{{asset('js/editarPedido.js')}}"></script>
    <script type="text/javascript">
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
@endsection