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
        <h1>Envío y facturación</h1>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <br/>
    </div>
    <div class="col-lg-6">
        {!! Form::open(['method'=>'post','url'=>'finished_order','class'=>'form']) !!}
        Nombre Completo*
        {!! Form::text('full_name',null,['class'=>'form-control','placeholder'=>'Introduzca su nombre','required'=>'required']) !!}
        <br/>
        Empresa
        {!! Form::text('enterprise',null,['class'=>'form-control','placeholder'=>'Introduzca su empresa']) !!}
        <br/>
        Móvil / Teléfono*
        {!! Form::text('phone',null,['class'=>'form-control','placeholder'=>'Introduzca su teléfono','required'=>'required']) !!}
        <br/>
        NIF, CIF o NIE*
        {!! Form::text('nif',null,['class'=>'form-control','placeholder'=>'Introduzca su DNI','required'=>'required']) !!}
        <br/>
        Dirección completa (Con Número de vivienda)*
        {!! Form::text('address',null,['class'=>'form-control','placeholder'=>'Introduzca su dirección','required'=>'required']) !!}
        <br/>
        Población*
        {!! Form::text('poblation',null,['class'=>'form-control','placeholder'=>'Introduzca su población','required'=>'required']) !!}
        <br/>
        Código Postal*
        {!! Form::text('cp',null,['class'=>'form-control','placeholder'=>'Introduzca su código postal','required'=>'required']) !!}
        <br/>
        Provincia*
        {!! Form::text('provence',null,['class'=>'form-control','placeholder'=>'Introduzca su provincia','required'=>'required']) !!}
        <br/>
        Email*
        {!! Form::email('email',null,['class'=>'form-control','placeholder'=>'Introduzca su email','required'=>'required']) !!}
        <br/>
        Observaciones
        {!! Form::textarea('observations',null,['class'=>'form-control']) !!}
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
        <div>
            <div id="paypal-button" class="col-lg-6 center-block text-center hidden" data-content="Paypal" data-id="2"></div>
            <script src="https://www.paypalobjects.com/api/checkout.js"></script>
            <script>
                paypal.Button.render({
                    // Configure environment
                    env: 'sandbox',
                    client: {
                        sandbox: '{!!  HelperConfig::getConfig('_DEMO_SANDBOX_CLIENT_ID')!!}',
                        production: '{!!  HelperConfig::getConfig('_DEMO_PRODUCTION_CLIENT_ID')!!}'
                    },
                    // Customize button (optional)
                    locale: 'es_ES',
                    style: {
                        size: 'small',
                        color: 'gold',
                        shape: 'pill',
                    },
                    // Set up a payment
                    payment: function (data, actions) {
                        return actions.payment.create({
                            transactions: [{
                                amount: {
                                    total: {{Cart::total()}},
                                    currency: 'EUR'
                                }
                            }]
                        });
                    },
                    // Execute the payment
                    onAuthorize: function (data, actions) {
                        return actions.payment.execute()
                                .then(function () {
                                    $('#isPaidOrder').val('1');
                                    // Show a confirmation message to the buyer
                                    window.alert('Thank you for your purchase!');
                                });
                    }
                }, '#paypal-button');

            </script>
        </div>
        <div class="col-lg-12 center-block text-center alert alert-success" id="trans_bancaria" data-content="Transferencia Bancaria" data-id="1">
            <span class="glyphicon glyphicon-transfer"></span>
            Transferencia Bancaria
        </div>
        <div class="clearfix"></div>
        <div class="alert alert-warning hidden" id="divMethodPayUser">
            Metodo seleccionado: <span id="methodPayUserSelect">Ninguno</span>
          {!! Form::hidden('methodPayUserSelectInput','1',['id'=>'methodPayUserSelectInput','required'=>'required']) !!}
        </div>

        {!! Form::submit('Finalizar pedido',['class'=>'form-control btn btn-success','id'=>'submitRegisterOrder']) !!}
        {!! Form::close() !!}
    </div>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <br/>
    </div>
    <script src="{{asset('js/payments/paymentsUI.js')}}" type="text/javascript"/>
@endsection