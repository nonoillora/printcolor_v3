@extends('administracion/adminTemplate')
@section('titleAdmin')
    {{$title}}
@endsection
@section('adminContent')
    <div class="breadcrumb"><a href="{{url('admin')}}">Administraci&oacute;n</a> <span class="glyphicon glyphicon-chevron-right"></span> <a
                href="{{url('admin/producto')}}">Producto</a> <span class="glyphicon glyphicon-chevron-right"></span> <a href="{{url('admin/producto/')}}">Ver Producto</a>
        <div class="pull-right">
            @include('administracion/notificacionBreadcrumb')
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="list-group">
                @foreach($products as $product)
                    <div class="list-group-item">
                        <div class="row">
                            <div class="col-lg-3">
                                <img src="{{asset('storage/app/public/productos/'.$product->cover)}}"
                                     class="img-responsive"/>
                            </div>
                            <div class="col-lg-6">
                                <span class="vertical-align">{{$product->name}}</span>
                            </div>
                            <div class="col-lg-3">
                                <a href=""class="btn btn-primary">
                                    <span class="glyphicon glyphicon-wrench"></span>
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