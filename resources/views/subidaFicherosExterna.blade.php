@extends('template')
@section('title')
    {{$title}}
@endsection
@section('content')
    <h3>Subir archivos</h3>
    <p>Una vez hayas realizado la compra de tu producto/s, puedes enviarnos al correo
        <i><b>{{HelperConfig::getConfig('_MAIL_VIEW_UPLOAD_FILES')}}</b></i> los ficheros para personalizarlos</p>

    <p><h3 class="label label-default"><b>Si son archivos muy pesados, te ofrecemos estos 2 servicios para enviarnos los
            ficheros, sigue estos dos sencillos pasos</b>:</h3></p>

    <h4 class="alert alert-info">FileMail</h4>
    <p>1º. Accedemos a <b><a href="https://www.filemail.com/" target="_blank">filemail</a></b> nos aparecerá un formulario de envío (sin
        necesidad de registrarse).</p>

    <p>2º. Rellenamos los datos como en la foto inferior, pulsamos en añadir archivos y después en el botón enviar que
        aparecerá cuando los archivos se hayan subido. ¡Listo!</p>

    <img src="{{asset('storage/app/public/image_filemail.jpg')}}" class="img-responsive center-block img-rounded">
    <br/>

    <h4 class="alert alert-info">WeTransfer</h4>

    <p>1º. Accedemos a <b><a href="https://wetransfer.com/?to={{HelperConfig::getConfig('_MAIL_VIEW_UPLOAD_FILES')}}" target="_blank">WeTransfer</a></b> nos aparecerá un formulario de envío
        (sin necesidad de registrarse).</p>

    <p>2º. Rellenamos los datos como en la foto inferior, pulsamos en añadir archivos y después en el botón enviar que
        aparecerá cuando los archivos se hayan subido. ¡Listo!</p>

    <img src="{{asset('storage/app/public/wetransfer-form.jpg')}}" class="img-responsive center-block img-rounded">
    <br/>

    <p>Una vez confirmado el pago, los archivos se enviarán automáticamente a nuestro departamento de producción.</p>

    <p>¡Gracias por confiar en nosotros!</p>
@endsection