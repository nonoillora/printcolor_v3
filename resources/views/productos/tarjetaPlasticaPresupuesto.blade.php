@extends('template')
@section('title')
    {{$title}}
@endsection
@section('content')
    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs">
        @include('components/lateral',['id'=>$producto->idCategoria])
    </div>
    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
        <div class="breadcrumb">
            <a href="{!! url('/') !!}"><span class="glyphicon glyphicon-home"></span> Inicio</a> <span
                    class="glyphicon glyphicon-menu-right"></span> <a
                    href="{!! url('categoria/'.$categoria->id.'/'.str_slug($categoria->name,'-')) !!}">{{$categoria->name}}</a>
            <span class="glyphicon glyphicon-menu-right"></span> <a
                    href="{!! url('producto/'.$producto->id.'/'.str_slug($producto->name,'-')) !!}">{{$producto->name}}</a>
        </div>
        <div class="amarillo padding5">
            <h3>{{$producto->name}}</h3>
        </div>
        @if($producto->image=='')
            <img src="{!! asset('img/imageProduct.png') !!}" class="img-responsive center-block"/>
        @else
            <img src="{!! asset('storage/app/public/productos/'.$producto->image) !!}"
                 class="img-responsive center-block"/>
        @endif
        <br/>

        <div class="amarillo padding5">
            <h3>Presupuesto personalizado para tarjetas de visita plásticas / pvc:</h3>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            Puedes rellenar el siguiente formulario, o escribirnos un correo electrónico a info@printcolorillora.com, con las características de tus tarjetas de visita plásticas / pvc.
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <br/>
        </div>
        @if(Session::has('presupuestoOK'))
            <br/>
            <div class="alert alert-success">
                <b>Solicitud enviada correctamente.</b>
            </div>
        @endif
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            @include('components/errors')
        </div>
        {!! Form::open(['url'=>'newpresupuesto','method'=>'post','class'=>'form']) !!}

        Cantidad:
        {{Form::number('cantidad',20,['class'=>'form-control','placeholder'=>'Introduzca una cantidad','required'=>'required','min'=>20])}}

        Número de caras:
        {{Form::select('caras',['1'=>'1 Cara','2'=>'2 Caras'],null,['class'=>'form-control','placeholder'=>'Seleccionar','required'=>'required'])}}

        Numeración:
        {{Form::select('numeracion',['si'=>'Si','no'=>'No'],null,['class'=>'form-control','placeholder'=>'Seleccionar','required'=>'required'])}}

        Fotografía:
        {{Form::select('fotografia',['si'=>'Si','no'=>'No'],null,['class'=>'form-control','placeholder'=>'Seleccionar','required'=>'required'])}}

        Nombre y apellidos:
        {{Form::select('full_name',['si'=>'Si','no'=>'No'],null,['class'=>'form-control','placeholder'=>'Seleccionar','required'=>'required'])}}

        Código de barras:
        {{Form::select('codBarras',['si'=>'Si','no'=>'No'],null,['class'=>'form-control','placeholder'=>'Seleccionar','required'=>'required'])}}

        Banda Magnética:
        {{Form::select('coercitividad',['no'=>'No','alta'=>'Alta Coercitividad','baja'=>'Baja Coercitividad'],null,['class'=>'form-control','placeholder'=>'Seleccionar','required'=>'required'])}}

        <hr/>

        Su nombre <b>*</b>
        <input type="text" class="form-control" name="nombre" placeholder="Nombre" required>

        Su email<b>*</b>
        <input type="email" class="form-control" name="email" placeholder="Email" required>

        Tel&eacute;fono<b>*</b>
        <input class="form-control" name="telefono" placeholder="Tel&eacute;fono" required>

        Empresa
        <input type="text" class="form-control" name="empresa" placeholder="Empresa">

        Provincia
        @include('productos/provincias')

        Comentarios<b>*</b>
        <textarea class="form-control" name="comentario" placeholder="Expl&iacute;quenos que desea" required></textarea>

        <input type="hidden" class="form-control" name="idProducto" value="{{$producto->id}}">
        <br/>
        <button type="submit" class="center-block btn btn-success btn-block">Enviar</button>
        {!! Form::close() !!}
        <br/>
    </div>
@endsection