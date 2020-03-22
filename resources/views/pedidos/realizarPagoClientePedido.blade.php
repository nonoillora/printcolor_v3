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
        <h1>Metodo de pago</h1>
    </div>
    <div class="col-lg-12">
        <br/>
        <p>Por favor, revise de nuevo si los datos que nos proporciona son correctos, si es así, seleccione una forma de
        pago y realice el pago según la forma seleccionada.</p>

        <p>Una vez realizado el pago del pedido, se le redireccionará a una nueva ventana donde le explicamos como
        enviarnos sus archivos y además deberá consultar el correo electrónico que ha indicado en el proceso de compra
        (Si no le aparece en su bandeja de entrada compruebe su bandeja de correo no deseado), ya que le enviaremos un
        email con los datos de su pedido.</p>
    </div>

    <div class="padding5">
        <h3>Revise sus datos y seleccione método de pago:</h3>
    </div>

    <div class="col-lg-4">
        <div id="paypal-button"></div>
        <script src="https://www.paypalobjects.com/api/checkout.js"></script>

        <script>
            paypal.Button.render({

                env: 'production', // Or 'sandbox',

                commit: true, // Show a 'Pay Now' button

                payment: function() {
                    // Set up the payment here
                },

                onAuthorize: function(data, actions) {
                    // Execute the payment here
                }

            }, '#paypal-button');
        </script>
    </div>
    <div class="col-lg-4">
        Tarjeta Visa
    </div>
    <div class="col-lg-4">
        {{Form::open(['method'=>'post','class'=>'form','url'=>'pedido-finalizado'])}}
        <button type="submit" class="btn btn-default">
            {{Form::hidden('tipoPago','transferencia')}}
            <img src="{{asset('storage/app/public/logo-transferencia.png')}}" class="img-responsive center-block" title="Transferencia Bancaria -> te lleva a la pagina"/>
        </button>
        {{Form::close()}}
    </div>
    <div class="col-lg-12">
        <hr/>
    </div>
    <div class="col-lg-6">
        <p>Revisión pedido:</p>

        Importe SIN IVA:€<br/>
        IVA (21%):€</br>
        GASTOS ENVÍO:GRATIS</br>
        IMPORTE TOTAL:€(IVA incluido)</br>

    </div>
    <div class="col-lg-6">
        Datos cliente:
        Nombre:</br>
        Empresa:</br>
        DNI:</br>
        Teléfono:</br>
        Dirección:</br>
        Población:</br>
        Codigo postal:</br>
        Provincia:</br>
        Email:</br>
        Observaciones:</br>
    </div>
@endsection