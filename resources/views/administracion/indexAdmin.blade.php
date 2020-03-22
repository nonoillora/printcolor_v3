@extends('administracion/adminTemplate')
@section('titleAdmin')
    {{$title}}
@endsection
@section('adminContent')
    <div class="breadcrumb"> Administracion
        <div class="pull-right">
            @include('administracion/notificacionBreadcrumb')
        </div>
    </div>
    <div class="col-lg-12" style="overflow: auto">
        <div class="panel panel-info">
            <div class="panel-heading"><b>Novedades</b></div>
            <div class="panel-body text-center">
                <div class="col-lg-4">
                    <a href="{{url('pruesupuestos')}}" class="noUnderline">
                        <button class="btn-circle bt-xl btn btn-success">
                            <span class="glyphicon glyphicon-list-alt"></span></button>
                        <br/>
                        @if($newBudgets)
                            @if($newBudgets==1)
                                {{$newBudgets}} nueva solicitud de presupuesto
                            @else
                                {{$newBudgets}} nuevas solicitudes de presupuesto
                            @endif
                        @else
                            No hay solicitudes de presupuesto nuevas
                        @endif
                    </a>
                </div>
                <div class="col-lg-4">
                    <a href="{{url('admin/pedidos')}}" class="noUnderline">
                        <button class="btn-circle bt-xl btn btn-success">
                            <img src="{{asset('storage/app/public/newPedido.png')}}" class="img-responsive"
                                 width="22px" height="22px" style="margin: 0px -5px 3px 3px;"/>
                        </button>
                        <br/>
                        @if($newOrders)
                            @if($newOrders==1)
                                {{$newOrders}} pedido nuevo
                            @else
                                {{$newOrders}} pedidos nuevos
                            @endif
                        @else
                            No hay pedidos nuevos
                        @endif
                    </a>
                </div>
                <div class="col-lg-4">
                    <a href="{{url('admin/contactos')}}" class="noUnderline">
                        <button class="btn-circle bt-xl btn btn-warning">
                            <span class="glyphicon glyphicon-envelope"></span></button>
                        <br/>
                        @if($newMessages)
                            @if($newMessages==1)
                                {{$newMessages}} nuevo mensaje
                            @else
                                {{$newMessages}} nuevos mensajes
                            @endif
                        @else
                            No hay mensajes nuevos
                        @endif
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="panel panel-info">
            <div class="panel-heading"><b>Últimos Pedidos</b></div>
            <ul class="list-group">
                @foreach($pedidos as $pedido)
                    <li class="list-group-item">
                        <a href="{{url('admin/pedidos/pedido/'.$pedido->idPedido)}}">
                            {{$pedido->numIdentificacionPedido}}
                            <span class="pull-right">{{$pedido->totalPedido}} &euro;</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="col-lg-12 hidden">
        <div class="panel panel-info">
            <div class="panel-heading"><b>Ventas</b></div>
            <div class="panel-body text-center">
                <div class="col-lg-6">
                    <a href="{{url('')}}" class="noUnderline">
                        <button class="btn-circle bt-xl btn btn-success">
                            <span class="glyphicon glyphicon-list-alt"></span></button>
                        <br/>Ver Ventas
                    </a>
                </div>
                <div class="col-lg-6">
                    <a href="{{url('')}}" class="noUnderline">
                        <button class="btn-circle bt-xl btn btn-danger">
                            <span class="glyphicon glyphicon-trash"></span></button>
                        <br/>Eliminar categor&iacute;a

                    </a>
                </div>
                <div class="col-lg-6">
                    <a href="{{url('')}}" class="noUnderline">
                        <button class="btn-circle bt-xl btn btn-warning">
                            <span class="glyphicon glyphicon-pencil"></span></button>
                        <br/>Editar categor&iacute;a

                    </a>
                </div>
                <div class="col-lg-6">
                    <a href="{{url('')}}" class="noUnderline">
                        <button class="btn-circle bt-xl btn btn-success">
                            <span class="glyphicon glyphicon-plus-sign"></span></button>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="panel panel-info">
            <div class="panel-heading"><b>Productos</b></div>
            <div class="panel-body text-center">
                <div class="col-lg-4">
                    <a href="{{url('admin/producto/editar')}}" class="noUnderline">
                        <button class="btn-circle bt-xl btn btn-info">
                            <span class="glyphicon glyphicon-list"></span></button>
                        <br/>Ver/Editar Productos
                    </a>
                </div>
                <div class="col-lg-4">
                    <a href="{{url('admin/producto/nuevo')}}" class="noUnderline">
                        <button class="btn-circle bt-xl btn btn-success">
                            <span class="glyphicon glyphicon-plus-sign"></span></button>
                        <br/>A&ntilde;adir Producto
                    </a>
                </div>
                <div class="col-lg-4">
                    <a href="{{url('admin/producto/borrar')}}" class="noUnderline">
                        <button class="btn-circle bt-xl btn btn-danger">
                            <span class="glyphicon glyphicon-trash"></span></button>
                        <br/>Eliminar Producto
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="panel panel-info">
            <div class="panel-heading"><b>Categor&iacute;as</b></div>
            <div class="panel-body text-center">
                <div class="col-lg-4">
                    <a href="{{url('admin/categoria/editar')}}" class="noUnderline">
                        <button class="btn-circle bt-xl btn btn-info">
                            <span class="glyphicon glyphicon-list"></span>
                            </span>
                        </button>
                        <br/>Ver Categor&iacute;as
                    </a>
                </div>
                <div class="col-lg-4">
                    <a href="{{url('admin/categoria/nueva')}}" class="noUnderline">
                        <button class="btn-circle bt-xl btn btn-success">
                            <span class="glyphicon glyphicon-plus-sign"></span></button>
                        <br/>A&ntilde;adir categor&iacute;a
                    </a>
                </div>
                <div class="col-lg-4">
                    <a href="{{url('admin/categoria/borrar')}}" class="noUnderline">
                        <button class="btn-circle bt-xl btn btn-danger">
                            <span class="glyphicon glyphicon-trash"></span></button>
                        <br/>Eliminar categor&iacute;a
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="panel panel-info">
            <div class="panel-heading"><b>Ofertas</b></div>
            <div class="panel-body text-center">
                <div class="col-lg-4">
                    <a href="{{url('admin/ofertas')}}" class="noUnderline">
                        <button class="btn-circle bt-xl btn btn-success">
                            <span class="glyphicon glyphicon-pencil"></span></button>
                        <br/>Ver/Editar Ofertas
                    </a>
                </div>
                <div class="col-lg-4">
                    <a href="{{url('admin/ofertas/nueva')}}" class="noUnderline">
                        <button class="btn-circle bt-xl btn btn-success">
                            <span class="glyphicon glyphicon-plus-sign"></span></button>
                        <br/>A&ntilde;adir Ofertas
                    </a>
                </div>
                <div class="col-lg-4">
                    <a href="{{url('admin/ofertas/borrar')}}" class="noUnderline">
                        <button class="btn-circle bt-xl btn btn-danger">
                            <span class="glyphicon glyphicon-trash"></span></button>
                        <br/>Eliminar categor&iacute;a
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="panel panel-info">
            <div class="panel-heading"><b>Mensajes</b></div>
            <div class="panel-body text-center">
                <div class="col-lg-12">
                    <a href="{{url('admin/contactos')}}" class="noUnderline">
                        <button class="btn-circle bt-xl btn btn-info">
                            <span class="glyphicon glyphicon-eye-open"></span></button>
                        <br/>Ver Mensajes
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
