@extends('template')
@section('title')
    {{$title}}
@endsection
@section('content')
    <div>
        <h2><b><span style="margin-left:10px;">Imprenta Rapida y Segura</span></b></h2>
    </div>
    <div class="amarillo">
        <h3 id="titleIndex" style="padding: 3px;">Seleccione el producto que necesita:</h3>
    </div>
    <br/>
    @foreach($categorias as $categoria)
        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6" >
            <a target="_self" href="{!! url('categoria/'.$categoria->id.'/'.str_slug($categoria->name,'-')) !!}" class="noUnderline">
                <div class="thumbnail">
                    <img src="@if($categoria->image=='') {!!asset('img/camera_icon.jpg')!!} @else {!!  url('image/categoria/'.$categoria->image)!!} @endif" alt="..." class="img-responsive">

                    <div class="caption amarillo categoria text-center">
                        <span class="hidden-xs truncate"><b>{{$categoria->name}}</b></span>
                        <span class="hidden-lg hidden-md hidden-sm truncate"><b>{{$categoria->name_xs}}</b></span>
                    </div>
                </div>
            </a>
        </div>
        @if($loop->iteration%6==0)<div class="clearfix hidden-lg hidden-sm hidden-md"></div> @endif
    @endforeach
@endsection
