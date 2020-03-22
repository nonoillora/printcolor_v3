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
            <img src="{!! asset('storage/app/public/productos/'.$producto->image) !!}"
                 class="img-responsive center-block"/>
        @endif
        <br/>

        <div class="amarillo padding5">
            <h3>Descripción</h3>
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
        {!! Form::open(['url'=>'save','method'=>'post','class'=>'form']) !!}

        <p>Puedes rellenar el siguiente formulario, o escribirnos un correo electrónico a info@printcolorillora.com, con las
        características de tu libro, revista o catálogo.</p>

        <p>1º Tipo de impresión:</p>
        {{Form::select('tipo_impresion',['b/n'=>'B/N - '.HelperConfig::getConfig('_PRICE_IMPRESS_TYPE_BLACK_WHITE').'€ / página',
'color'=>'Color - '.HelperConfig::getConfig('_PRICE_IMPRESS_TYPE_COLOR').'€ / página'],
'b/n',['class'=>'form-control','id'=>'tipo_impresion'])}}
        <br/>
        <p>2º Número de páginas:</p>
        {{Form::number('numPaginas',null,['class'=>'form-control','id'=>'numPaginas'])}}
        <br/>

        <p>3º Doble cara:</p>
        {{Form::select('doblecara',['no'=>'No',
        'si'=>'Si'],'no',['class'=>'form-control','id'=>'doblecara'])}}
        <br/>
        <p>4º Encuadernación:</p>
        {{Form::select('encuadernado',['no_encuadernado'=>'No',
        'hojas_grapadas'=>'Hojas grapadas (Gratis)',
        'si_encuadernado'=>'SI, en espiral(+ 1,50€/libro)'],
        'no_encuadernado',['class'=>'form-control','id'=>'encuadernado'])}}
        <br/>
        <p>5º ¿Cuantos ejemplares necesitas? Desde uno hasta los que necesites:</p>
        {{Form::number('numEjemplares',1,['class'=>'form-control','id'=>'numEjemplares','min'=>1])}}

        <br/>
        <p>6º ¿Te lo enviamos o recoges?:</p>
        {{Form::select('tipo_envio',['recogida_oficina'=>'Recojo en vuestra oficina (Gratis)',
        'envio'=>'Enviadlo a mi domicilio (+ 4,95 € ) - (Envío peninsular)'],
        null,['class'=>'form-control','id'=>'tipo_envio','placeholder'=>'Seleccionar envío o recogida'])}}
        <br/>
        <p>Tus documentos, serán procesados e impresos de forma automática una vez recibido el documento.</p>
<br/>
        <p>Nota: Si realizas la Impresión digital de varios documentos diferentes y necesitas envío a domicilio, solo debes
        elegir un envío a domicilio para todos los documentos en el carro de compra.</p>

        TOTAL: <span id="precioDocumentoOnline">0,00</span> €
        {!! Form::hidden('idProducto',$producto->id) !!}
        {!! Form::hidden('precioDocumentoOnline',null,['id'=>'precioDocumentoOnlineInput']) !!}
        {!! Form::hidden('precioDocumentoOnlineBN',HelperConfig::getConfig('_PRICE_IMPRESS_TYPE_BLACK_WHITE'),['id'=>'precioDocumentoOnlineBN']) !!}
        {!! Form::hidden('precioDocumentoOnlineColor',HelperConfig::getConfig('_PRICE_IMPRESS_TYPE_COLOR'),['id'=>'precioDocumentoOnlineColor']) !!}

        <br/>
        <br/>
        {!! Form::submit('Añadir a la cesta',['class'=>'center-block btn btn-success btn-block','id'=>'addItem']) !!}
        {!! Form::close() !!}
        <br/>
    </div>
    <script type="text/javascript" src="{{asset('js/producto/documentoOnline.js')}}"></script>
@endsection