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
        <h1>Proceso de compra finalizado</h1>
    </div>
    <div class="col-lg-12">
        <br/>
        <p>Hemos recibido correctamente su pedido, una vez confirmado el pago y revisado por el departamento de preimpresión, sera enviado al departamento de producción.<p/>

        <p>Indique en el "concepto" de la transferencia el número de pedido que aparece en el correo electrónico que le hemos enviado. Una vez tengamos confirmación del banco,
            pasaremos a procesar tu pedido.</p>

        <p>Nº de cuenta para realizar la TRANSFERENCIA BANCARIA:<p/>
        XXXX XXXX XXXX XXXX XXXX XXXX

        <p>Si tienes cualquier duda en el proceso, estaremos encantados de atender sus consultas en el teléfono 958 46 41 68 o en el correo info@printcolorillora.com .<p/>

        <p>¡Gracias por confiar en nosotros! Consulte el correo electrónico que ha indicado en el proceso de compra (Si no le aparece en su bandeja de entrada compruebe su bandeja
            de correo no deseado), le hemos enviado un email con los datos de su pedido.</p>

        <p>Si el diseño del producto/s nos lo proporciona usted, envíenos lo antes posible su diseño.<p/>
        <p>Para enviarnos su diseño siga los pasos indicados en esta sección "Subir Archivos".<p/>

        <p>Para cualquier duda, consulta o aviso de algún error en sus datos, pongase en contacto a través del Teléfono: 958 46 41 68 o el email: info@printcolorillora.com<p/>

        <p>Gracias por confiar en PrintColor<p/>
    </div>
@endsection