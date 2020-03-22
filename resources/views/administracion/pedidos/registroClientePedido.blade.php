@extends('template')
@section('content')
    <div class="breadcrumbs">
        <ol class="breadcrumb">
            <li>
                <a href="{{url('/')}}">Inicio</a>
                <span class="glyphicon glyphicon-chevron-right"></span>
                <a href="{{url('checkout')}}">Confirmación del pedido</a>
            </li>
        </ol>
    </div>
    @if(Session::has('cartDestroy'))
        <div class="alert alert-success">
            {{Session::get('cartDestroy')}}
        </div>
    @endif
    <div class="amarillo padding5">
        <h1>envío y facturación</h1>
    </div>
    <div class="col-lg-6">
        {!! Form::open(['method'=>'post','url'=>'','class'=>'form']) !!}
        Nombre Completo*
        {!! Form::text('nombre',null,['class'=>'form-control','placeholder'=>'Introduzca su nombre','required'=>'required']) !!}
        <br/>
        Empresa
        {!! Form::text('empresa',null,['class'=>'form-control','placeholder'=>'Introduzca su empresa','required'=>'required']) !!}
        <br/>
        Móvil / Teléfono*
        {!! Form::text('nombre',null,['class'=>'form-control','placeholder'=>'Introduzca su teléfono','required'=>'required']) !!}
        <br/>
        NIF, CIF o NIE*
        {!! Form::text('nombre',null,['class'=>'form-control','placeholder'=>'Introduzca su DNI','required'=>'required']) !!}
        <br/>
        Dirección completa (Con Número de vivienda)*
        {!! Form::text('nombre',null,['class'=>'form-control','placeholder'=>'Introduzca su nombre','required'=>'required']) !!}
        <br/>
        Población*
        {!! Form::text('nombre',null,['class'=>'form-control','placeholder'=>'Introduzca su población','required'=>'required']) !!}
        <br/>
        Código Postal*
        {!! Form::text('nombre',null,['class'=>'form-control','placeholder'=>'Introduzca su código postal','required'=>'required']) !!}
        <br/>
        Provincia*
        {!! Form::text('nombre',null,['class'=>'form-control','placeholder'=>'Introduzca su provincia','required'=>'required']) !!}
        <br/>
        Email*
        {!! Form::text('nombre',null,['class'=>'form-control','placeholder'=>'Introduzca su email','required'=>'required']) !!}
        <br/>
        Observaciones
        {!! Form::textarea('nombre',null,['class'=>'form-control']) !!}
        <br/>
        {!! Form::checkbox('terms',1,false) !!}&nbsp;He leído y acepto la Política de Protección de Datos
        <br/>
        {!! Form::submit('Enviar',['class'=>'form-control btn btn-success']) !!}
        {!! Form::close() !!}
    </div>
    <div class="col-lg-6">
        Envío archivos
        Una vez confirmado el pago podrá enviarnos su diseño mediante los pasos indicados en esta sección "Subir Archivos". (Solo en el caso en el que usted nos proporcione el diseño).

        evisión del pedido
        Importe SIN IVA: 0.00€
        IVA (21%): 0.00€
        IMPORTE TOTAL: 0.00€(IVA incluido)

        He leído y acepto la Política de Protección de Datos

        Cuando realice click sobre "Realizar compra", por favor espere a que se le redirija a una nueva página y le aparezca una nueva pestaña con el proceso para realizar el pago del pedido según la forma de pago seleccionada. Gracias
    </div>
@endsection