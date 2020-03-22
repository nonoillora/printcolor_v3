@extends('administracion/adminTemplate')
@section('titleAdmin')
    {{$title}}
@endsection
@section('adminContent')
    <div class="breadcrumb">
    <a href="{{url('admin')}}">Administraci&oacute;n</a> <span class="glyphicon glyphicon-chevron-right"></span>
    <a href="{{url('admin/producto')}}">Producto </a> <span class="glyphicon glyphicon-chevron-right"></span> <a href="{{url('admin/producto/borrar')}}">Borrar Productos</a>
        <div class="pull-right">
            @include('administracion/notificacionBreadcrumb')
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            @if(Session::has('failProduct'))
            <div class="alert alert-danger">
                <b>{{Session::get('failProduct')}}</b>
            </div>
            @endif
            @if(Session::has('successProduct'))
            <div class="alert alert-success">
                <b>{{Session::get('successProduct')}}</b>
            </div>
            @endif
            <div class="list-group">
                @foreach($products as $producto)
                    <div class="list-group-item">
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                @if(empty($producto->cover))
                                    <img src="{{asset('storage/app/public/image_not_found.jpg')}}"
                                         class="img-responsive img-rounded"></img>
                                @else
                                    <img src="{{asset('storage/app/public/productos/'.$producto->cover)}}"
                                         class="img-responsive" width="25%" height="25%"/>
                                @endif

                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                {{$producto->name}}
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <span data-id="{{$producto->id}}" class="btn btn-danger center-block deleteProduct"
                                      data-toggle="modal" data-target="#deleteProduct" data-name="{{$producto->name}}">
                                    <span class="glyphicon glyphicon-trash"></span>&nbsp; Borrar
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="text-center">
                    {!! $products->links() !!}
                </div>
            </div>
        </div>
    </div>

    <!-- delete type Price product -->
    <div class="modal fade" id="deleteProduct" tabindex="-1" role="dialog" aria-labelledby="deleteProduct">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Eliminar Producto</h4>
                </div>
                <div class="modal-body text-center">
                    <span class="glyphicon glyphicon-trash"></span>
                    ¿Eliminar <span id="nameProduct"></span>?
                    <br/>
                    <h4 class="">Este proceso borrara todas imagenes, precios y tipos de acabado asociados a este
                        producto</h4>
                    <br/>
                    <span class="btn btn-danger" data-toggle="tooltip" data-placement="bottom"
                          title="No eliminar y cerrar esta ventana" id="closeDeleteProduct">
                        <span class="glyphicon glyphicon-remove"></span>
                    </span>
                    &nbsp;
                    <span class="btn btn-success" data-toggle="tooltip" data-placement="bottom" title="Si"
                          id="confirmDeleteProduct">
                        <span class="glyphicon glyphicon-ok"></span>
                    </span>
                    {!! Form::hidden('idProduct',null,['id'=>'idProduct']) !!}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{asset('js/borrarProducto.js')}}"></script>
@endsection
