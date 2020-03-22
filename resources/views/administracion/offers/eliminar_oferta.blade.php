@extends('administracion/adminTemplate')
@section('titleAdmin')
    {{$title}}
@endsection
@section('adminContent')
    <div class="breadcrumb">
        <a href="{{url('admin')}}">Administraci&oacute;n</a> <span class="glyphicon glyphicon-chevron-right"></span> <a
                href="{{url('admin/ofertas/')}}">Ofertas</a> <span class="glyphicon glyphicon-chevron-right"></span>
        Borrar Ofertas
        <div class="pull-right">
            @include('administracion/notificacionBreadcrumb')
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            @if(Session::has('failOffer'))
                <div class="alert alert-danger">
                    <b>{{Session::get('failOffer')}}</b>
                </div>
            @endif
            @if(Session::has('successOffer'))
                <div class="alert alert-success">
                    <b>{{Session::get('successOffer')}}</b>
                </div>
            @endif
            <div class="list-group">
                @foreach($products as $producto)
                    <div class="list-group-item">
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                @if(empty($producto->cover))
                                    <img src="{{asset('storage/app/public/image_not_found.jpg')}}"
                                         class="img-responsive img-rounded">
                                @else
                                    <img src="{{asset('storage/app/public/ofertas/'.$producto->cover)}}"
                                         class="img-responsive" width="25%" height="25%"/>
                                @endif

                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                {{$producto->name}}
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <span data-id="{{$producto->id}}" class="btn btn-danger center-block deleteOffer"
                                      data-toggle="modal" data-target="#deleteOffer" data-name="{{$producto->name}}">
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
    <div class="modal fade" id="deleteOffer" tabindex="-1" role="dialog" aria-labelledby="deleteOffer">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Eliminar Oferta</h4>
                </div>
                <div class="modal-body text-center">
                    <span class="glyphicon glyphicon-trash"></span>
                    ¿Eliminar <span id="nameOffer"></span>?
                    <br/>
                    <span class="btn btn-danger" data-toggle="tooltip" data-placement="bottom"
                          title="No eliminar y cerrar esta ventana" id="closeDeleteOffer">
                        <span class="glyphicon glyphicon-remove"></span>
                    </span>
                    &nbsp;
                    <span class="btn btn-success" data-toggle="tooltip" data-placement="bottom" title="Si"
                          id="confirmDeleteOffer">
                        <span class="glyphicon glyphicon-ok"></span>
                    </span>
                    {!! Form::hidden('idOffer',null,['id'=>'idOffer']) !!}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{asset('js/borrarOferta.js')}}"></script>
@endsection
