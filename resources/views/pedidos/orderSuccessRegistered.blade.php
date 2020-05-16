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
                Pedido Finalizado
            </li>
        </ol>
    </div>

    <div class="col-lg-8 col-lg-offset-2 alert alert-success">
        <h2 class="text-center">Pedido registrado</h2>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <br/>
    </div>
    <div class="col-lg-8 col-lg-offset-2">
        <p>Muchas gracias por su compra y confianza depositada en nosotros.</p>
        @if($pago==1)
            <p>En breve, recibir&aacute;s un correo electr&oacute;nico de confirmaci&oacute;n del pedido, en el cual se explican las instrucciones para realizar la
            transferencia y el n&uacute;mero de identificaci&oacute;n del pedido realizado. Una vez confirmada
            la transferencia comenzaremos a preparar el pedido.</p>
            <p>Se te notificara cuando sea enviado a la agencia de
            transporte junto con el n&uacute;mero de seguimiento del mismo para poder seguir el
            envi&oacute; del pedido.</p>
        @endif
        @if($pago==2)
            <p>En breve, recibir&aacute;s un correo electr&oacute;nico de confirmaci&oacute;n del pedido, en el cual hay un resumen del pedido realizado.</p>
            <p>Se te notificara cuando sea enviado a la agencia de transporte junto con el n&uacute;mero de seguimiento del
            mismo para poder seguir el envi&oacute; del pedido.<p>
        @endif
        <br/><br/>
    </div>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <br/>
    </div>
@endsection