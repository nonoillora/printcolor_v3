@extends('template')
@section('title')
    {{$title}}
@endsection
@section('content')
    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs">
        @include('components/lateral')
    </div>
    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="breadcrumb">
                    <a href="{!! url('/') !!}"><span class="glyphicon glyphicon-home"></span> Inicio</a> <span
                            class="glyphicon glyphicon-menu-right"></span> <a
                            href="{!! url('/'.Request::segment(2).'/'.str_slug($name,'-')) !!}">{{$name}}</a>
                </div>
                <div class="amarillo padding5">
                    <h3>{{$name}}</h3>
                </div>
                @foreach($productos as $producto)
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 productoItem">
                        <a target="_self"
                           href="{!! url('producto/'.$producto->id.'/'.str_slug($producto->name,'-')) !!}">
                            <div class="thumbnail noUnderline" style="border:none">
                                @if(empty($producto->cover))
                                    <img src="{!! asset('img/camera_icon.jpg')  !!}" alt="..." class="img-responsive">
                                @else
                                    <img src="{!! asset('storage/app/public/productos/'.$producto->cover)  !!}"
                                         alt="..." class="img-responsive">
                                @endif
                                <div class="caption amarillo text-center tituloCat">
                                    <h4>{{$producto->name}}</h4>
                                </div>
                            </div>
                        </a>
                    </div>
                    @if($loop->iteration%2==0)
                        <div class="clearfix"></div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    <link type="text/css" rel="stylesheet" href="{{asset('css/animate.css')}}">
    <script type="text/javascript">
        $(document).ready(function () {
                    $('.productoItem').hover(
                            function () {
                                $(this).addClass('tada animated');
                            }, function () {
                                $(this).removeClass('tada animated');
                            }
                    );
                }
        )
        ;
    </script>
@endsection
