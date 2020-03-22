@extends('template')
@section('title')
    {{$title}}
@endsection
@section('content')
    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs">
        @include('components/lateral',['id'=>$producto->idCategoria])
    </div>
    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="breadcrumb">
                    <a href="{!! url('/') !!}"><span class="glyphicon glyphicon-home"></span> Inicio</a> <span
                            class="glyphicon glyphicon-menu-right"></span> <a
                            href="{!! url('categoria/'.$categoria->id.'/'.str_slug($categoria->name,'-')) !!}">{{$categoria->name}}</a>
                    <span class="glyphicon glyphicon-menu-right"></span> <a
                            href="{!! url('producto/'.$producto->id.'/'.str_slug($producto->name,'-')) !!}">{{$producto->name}}</a>
                </div>
                @if(Session::has('productAddedSuccessfully'))
                    <div class="alert alert-success">
                        <b>{{Session::get('productAddedSuccessfully')}}</b>
                    </div>
                @endif
                <div class="amarillo padding5">
                    <h3>{{$producto->name}}</h3>
                </div>
                @if($producto->image=='')
                    <img src="{!! asset('img/imageProduct.png') !!}" class="img-responsive center-block"/>
                @else
                    <img src="{{ url('getFile/productos/'.$producto->image)}}" class="img-responsive center-block"/>
                @endif
                @if(isset($producto->footer_image) && !empty($producto->footer_image))
                    <label class="label label-default center-block">
                        {{$producto->footer_image}}
                    </label>
                @endif
                <br/>

                <div class="amarillo padding5">
                    <h3>Descripci&oacute;n</h3>
                </div>
                @include('components/informacion')
                {{--@include('precios/tarjetas_visita_simples')--}}
                {!! Form::open(['method'=>'post','url'=>'save']) !!}
                @if($producto->id==7)
                    @include('precios/table_precios_producto_7')
                @elseif($producto->id==37)
                    @include('precios/table_precios_producto_37')
                @else
                    @include('precios/table_precios')
                @endif
                @include('productos/personalizacion/base')
                {{--form contacto--}}
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <br/>
                </div>
                <button type="submit" class="btn btn-success center-block" disabled="disabled" id="saveProductCart">A&ntilde;adir
                    a cesta
                </button>
                {!! Form::close() !!}
                <br/>
            </div>
        </div>
    </div>
@endsection