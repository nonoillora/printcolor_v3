@extends('administracion/adminTemplate')
@section('titleAdmin')
    {{$title}}
@endsection
@section('adminContent')
    <div class="breadcrumb"><a href="{{url('admin')}}">Administraci&oacute;n</a> <span
                class="glyphicon glyphicon-chevron-right"></span> <a
                href="{{url('admin/producto')}}">Producto</a> <span class="glyphicon glyphicon-chevron-right"></span> <a
                href="{{url('admin/producto/editar')}}">Editar Producto</a>

        <div class="pull-right">
            @include('administracion/notificacionBreadcrumb')
        </div>
    </div>
    <div class="row">
        @if(count($productsWithoutImage)>0)
            <div class="col-lg-12 text-center">
                <div class="panel-group" id="accordionProductEmpty" role="tablist" aria-multiselectable="true">
                    <div class="panel panel-warning">
                        <div class="panel-heading" role="tab" id="headingProductEmpty">
                            <h4 class="panel-title">
                                <a role="button" data-toggle="collapse" data-parent="#accordionProductEmpty"
                                   href="#collapseProductEmpty"
                                   aria-expanded="true" aria-controls="collapseProductEmpty">
                                    Hay {{count($productsWithoutImage)}} productos sin imagen establecida
                                </a>
                            </h4>
                        </div>
                        <div id="collapseProductEmpty" class="panel-collapse collapse" role="tabpanel"
                             aria-labelledby="headingProductEmpty">
                            <div class="panel-body">
                                <table class="table table-hover">
                                    <tr>
                                        <td>Producto</td>
                                        <td>Imagen exterior</td>
                                        <td>Imagen interior</td>
                                    </tr>
                                    @foreach($productsWithoutImage as $product)
                                        <tr>
                                            <td>
                                                <a href="{{url('admin/producto/editar/'.$product->id)}}">{{$product->name}}</a>
                                            </td>
                                            <td>@if($product->cover=='') <span
                                                        class="glyphicon glyphicon-remove"></span> @else <span
                                                        class="glyphicon glyphicon-ok-sign"></span> @endif</td>
                                            <td>@if($product->image=='') <span
                                                        class="glyphicon glyphicon-remove"></span> @else <span
                                                        class="glyphicon glyphicon-ok-sign"></span> @endif</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="col-lg-12">
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
                                <a href="{{url('admin/producto/editar/'.$producto->id)}}"
                                   class="btn btn-primary center-block">
                                    <span class="glyphicon glyphicon-pencil"></span>&nbsp; Editar
                                </a>
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
@endsection