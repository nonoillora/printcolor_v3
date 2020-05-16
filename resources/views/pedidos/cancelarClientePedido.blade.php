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
        {!! Form::open(['method'=>'post','url'=>'pedido/actualizar','class'=>'form','id'=>"updateOrderForm"]) !!}
        Nombre Completo*
        {!! Form::text('full_name',$pedido->full_name,['class'=>'form-control','placeholder'=>'Introduzca su nombre','readonly'=>true]) !!}
        <br/>
        Empresa
        {!! Form::text('enterprise',$pedido->enterprise,['class'=>'form-control','placeholder'=>'Introduzca su empresa','readonly'=>true]) !!}
        <br/>
        Móvil / Teléfono*
        {!! Form::text('phone',$pedido->phone,['class'=>'form-control','placeholder'=>'Introduzca su teléfono','readonly'=>true]) !!}
        <br/>
        NIF, CIF o NIE*
        {!! Form::text('nif',$pedido->nif_cif,['class'=>'form-control','placeholder'=>'Introduzca su DNI','readonly'=>true]) !!}
        <br/>
        Dirección completa (Con Número de vivienda)*
        {!! Form::text('address',$pedido->address,['class'=>'form-control','placeholder'=>'Introduzca su dirección','readonly'=>'true']) !!}
        <br/>
        Población*
        {!! Form::text('poblation',$pedido->poblation,['class'=>'form-control','placeholder'=>'Introduzca su población','readonly'=>true]) !!}
        <br/>
        Código Postal*
        {!! Form::text('cp',$pedido->postal_code,['class'=>'form-control','placeholder'=>'Introduzca su código postal','readonly'=>true]) !!}
        <br/>
        Provincia*
        {!! Form::text('provence',$pedido->provence,['class'=>'form-control','placeholder'=>'Introduzca su provincia','readonly'=>true]) !!}
        <br/>
        Email*
        {!! Form::email('email',$pedido->email,['class'=>'form-control','placeholder'=>'Introduzca su email','readonly'=>true]) !!}
        <br/>
        Observaciones
        {!! Form::textarea('observations',$pedido->observations,['class'=>'form-control','readonly'=>true]) !!}
        <br/>
    </div>
    <div class="col-lg-6">
        <p>Envío archivos</p>

        <p>Una vez confirmado el pago podrá enviarnos su diseño mediante los pasos indicados en esta sección "Subir
            Archivos". (Solo en el caso en el que usted nos proporcione el diseño).</p>


        <p><b>Revisión del pedido</b></p>

        <p><b>Importe SIN IVA: {{$pedido->withoutIVA}}€</b></p>

        <p><b>IVA (21%): {{$pedido->totalIVA}}€</b></p>

        <p><b>Gastos de envio: 5 €</b></p>

        <p><b>IMPORTE TOTAL: {{$pedido->totalPedido}}€ (IVA incluido)</b></p>

        <br/>
        Por favor, seleccione el método de pago, hemos comprobado en su pedido que tenia marcado <b>{{$pedido->tipoPago()->first()->nombre}}</b> como método de pago preseleccionado.<br/>
        Una vez este su pedido listo le notificaremos su estado y el numero de seguimiento. {{--Estamos trabajando para
        implantar un sistema de pago por tarjeta, próximamente disponible--}}
        <br/><br/>
    <div class="alert alert-info">
        <b>Metodos de pago*</b>
    </div>
        {!! Form::hidden('idPedido',$pedido->idPedido) !!}
        <div class="clearfix"></div>
        <div class="col-lg-12 center-block text-center alert @if($pedido->idTipoPago==1) alert-success @else alert-info @endif" id="trans_bancaria" data-content="Transferencia Bancaria" data-id="1">
            <span class="glyphicon glyphicon-transfer"></span>
            Transferencia Bancaria
        </div>
        <div class="col-lg-12 center-block text-center alert  @if($pedido->idTipoPago==2) alert-success @else alert-info @endif" id="paypal-button" data-content="Paypal" data-id="2">
            <img src="{{asset('storage/app/public/paypal-logo.png')}}"/>
        </div>
        <div class="col-lg-12 center-block text-center alert  @if($pedido->idTipoPago==3) alert-success @else alert-info @endif" id="tpv-button" data-content="TPV" data-id="3">
            <span class="glyphicon glyphicon-credit-card"></span>
            TPV Virtual
        </div>

        <div class="clearfix"></div>
        Metodo seleccionado:
        {!! Form::select('methodPayUserSelected', ['0'=>'No seleccionado','1' => 'Transeferencia', '2' => 'Paypal','3'=>'TPV  Virtual'], $pedido->idTipoPago,['class'=>'form-control','disabled'=>'disabled','readonly'=>true,'id'=>'methodPayUserSelected']) !!}
       <br/>

        {!! Form::submit('Finalizar pedido',['class'=>'form-control btn btn-success','id'=>'submitRegisterOrder', 'disabled'=>'disabled']) !!}
        {!! Form::close() !!}
    </div>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <br/>
    </div>
    <script src="{{asset('js/payments/paymentsUI.js')}}" type="text/javascript"></script>
@endsection