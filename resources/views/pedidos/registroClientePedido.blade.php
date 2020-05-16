@extends('template')
@section('title')
    {{$title}}
@endsection
@section('content')
    <div class="breadcrumbs">
        <ol class="breadcrumb">
            <li>
                <a href="{{url('/')}}">Inicio</a>
                <span class="glyphicon glyphicon-chevron-right"></span>
                <a href="{{url('pedido/confirmacion')}}">Confirmación del pedido</a>
            </li>
        </ol>
    </div>
    @if(Session::has('cartDestroy'))
        <div class="alert alert-success">
            {{Session::get('cartDestroy')}}
        </div>
    @endif
    <div class="amarillo padding5">
        <h1>Envío y facturación</h1>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <br/>
    </div>
    <div class="col-lg-6">
        {!! Form::open(['method'=>'post','url'=>'pedido/finalizar','class'=>'form','id'=>"registerOrderForm"]) !!}
        Nombre Completo*
        {!! Form::text('full_name',old('full_name'),['class'=>'form-control','placeholder'=>'Introduzca su nombre','required'=>'required']) !!}
        <br/>
        Empresa
        {!! Form::text('enterprise',old('enterprise'),['class'=>'form-control','placeholder'=>'Introduzca su empresa']) !!}
        <br/>
        Móvil / Teléfono*
        {!! Form::text('phone',old('phone'),['class'=>'form-control','placeholder'=>'Introduzca su teléfono','required'=>'required']) !!}
        <br/>
        NIF, CIF o NIE*
        {!! Form::text('nif',old('nif'),['class'=>'form-control','placeholder'=>'Introduzca su DNI','required'=>'required']) !!}
        <br/>
        Dirección completa (Con Número de vivienda)*
        {!! Form::text('address',old('address'),['class'=>'form-control','placeholder'=>'Introduzca su dirección','required'=>'required']) !!}
        <br/>
        Población*
        {!! Form::text('poblation',old('poblation'),['class'=>'form-control','placeholder'=>'Introduzca su población','required'=>'required']) !!}
        <br/>
        Código Postal*
        {!! Form::text('cp',old('cp'),['class'=>'form-control','placeholder'=>'Introduzca su código postal','required'=>'required']) !!}
        <br/>
        Provincia*
        {!! Form::text('provence',old('provence'),['class'=>'form-control','placeholder'=>'Introduzca su provincia','required'=>'required']) !!}
        <br/>
        Email*
        {!! Form::email('email',old('email'),['class'=>'form-control','placeholder'=>'Introduzca su email','required'=>'required','pattern'=>'[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$','title'=>'nombre@dominio']) !!}
        <br/>
        Observaciones
        {!! Form::textarea('observations',old('observations'),['class'=>'form-control']) !!}
        <br/>
        {!! Form::checkbox('terms',1,false,['required'=>'required']) !!}&nbsp;He leído y acepto la Política de
        Protección de Datos
        <br/>
    </div>
    <div class="col-lg-6">
        <p>Envío archivos</p>

        <p>Una vez confirmado el pago podrá enviarnos su diseño mediante los pasos indicados en esta sección "Subir
            Archivos". (Solo en el caso en el que usted nos proporcione el diseño).</p>


        <p><b>Revisión del pedido</b></p>

        <p><b>Importe SIN IVA: {{Cart::subtotal()}}€</b></p>

        <p><b>IVA (21%): {{Cart::tax()}}€</b></p>

        <p><b>Gastos de envio: 5 €</b></p>

        <p><b>IMPORTE TOTAL: {{Cart::total()+5}}€ (IVA incluido)</b></p>
        {!! Form::hidden('totalPedido',(Cart::total()+5),['id'=>'priceTotalOrder']) !!}
        {!! Form::hidden('isPaidOrder',0,['id'=>'isPaidOrder']) !!}

        <br/>
        Por ahora el método de pago es <b>transferencia bancaria</b>, recibirá un correo donde se le explica cómo
        realizar el pago y el identificador del pedido,
        una vez este su pedido listo le notificaremos su estado y el numero de seguimiento. Estamos trabajando para
        implantar un sistema de pago por tarjeta, próximamente disponible
        <br/><br/>
    <div class="alert alert-info">
        <b>Metodos de pago*</b>
    </div>

        <div class="clearfix"></div>
        <div class="col-lg-12 center-block text-center alert @if(old('methodPayUserSelected')==1) alert-success @else alert-info @endif" id="trans_bancaria" data-content="Transferencia Bancaria" data-id="1">
            <span class="glyphicon glyphicon-transfer"></span>
            Transferencia Bancaria
        </div>
        <div class="col-lg-12 center-block text-center alert  @if(old('methodPayUserSelected')==2) alert-success @else alert-info @endif" id="paypal-button" data-content="Paypal" data-id="2">
            <img src="{{asset('storage/app/public/paypal-logo.png')}}"/>
        </div>
        <div class="col-lg-12 center-block text-center alert  @if(old('methodPayUserSelected')==3) alert-success @else alert-info @endif" id="tpv-button" data-content="TPV" data-id="3">
            <span class="glyphicon glyphicon-credit-card"></span>
            TPV Virtual
        </div>

        <div class="clearfix"></div>
        Metodo seleccionado:
        {!! Form::select('methodPayUserSelected', ['0'=>'No seleccionado','1' => 'Transeferencia', '2' => 'Paypal','3'=>'TPV  Virtual'], '0',['class'=>'form-control','disabled'=>'disabled','required'=>'required','id'=>'methodPayUserSelected']) !!}
       <br/>

        {!! Form::submit('Finalizar pedido',['class'=>'form-control btn btn-success','id'=>'submitRegisterOrder', 'disabled'=>'disabled']) !!}
        {!! Form::close() !!}
    </div>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <br/>
    </div>
    <script src="{{asset('js/payments/paymentsUI.js')}}" type="text/javascript"></script>
@endsection