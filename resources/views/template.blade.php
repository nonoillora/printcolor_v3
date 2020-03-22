<!DOCTYPE html>
<html lang="es" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset=UTF-8>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>
        Print Color Illora -
        @yield('title')
    </title>
    <script type="text/javascript" src="{!! asset('js/jquery-3.1.1.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('js/app.js') !!}"></script>
    <script src="{!! asset('js/js.js') !!}" type="text/javascript"></script>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top: 12px !important;">
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <a href="{!! url('/') !!}" class="hidden-xs hidden-sm"><img
                            src="{{asset('storage/app/public/logo.png')}}"
                            class="img-responsive center-block" width="100%" height="100%"/></a>
                <a href="{!! url('/') !!}" class="hidden-lg hidden-md"><img
                            src="{{asset('storage/app/public/logo.png')}}"
                            class="img-responsive center-block"/></a>
            </div>
            <div class="col-xs-6 col-sm-6 hidden-lg hidden-md">
                <h2 style="font-weight: bold" class="text-right">¡Hazte ver!</h2>
            </div>
            <div class="col-xs-6 col-sm-6 hidden-lg hidden-md">
                <h3 style="margin: 0;">Imprenta</h3>

                <h3 style="margin: 0;">Serigrafia</h3>

                <h3 style="margin-top: 5px;">Publicidad</h3>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center hidden-xs hidden-sm">
                <h1 style="font-weight: bold">¡Hazte ver!</h1>

                <h3 style="margin: 0;">Imprenta</h3>

                <h3 style="margin: 0;">Serigrafia</h3>

                <h3 style="margin-top: 5px;">Publicidad</h3>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center hidden">
                <h3>Impresi&oacute;n r&aacute;pida<br/>
                    y<br/>
                    Segura</h3>
                <a href="{!! HelperConfig::getConfig('_LINK_TWITTER') !!}" target="_blank"><img
                            src="{{asset('img/icons_social/twitter.png')}}" width="40px" height="40px"/></a>
                <a href="{!! HelperConfig::getConfig('_LINK_INSTAGRAM') !!}" target="_blank"><img
                            src="{{asset('img/icons_social/instagram.jpg')}}" class="img-circle" width="40px"
                            height="40px"/></a>
                <a href="{!! HelperConfig::getConfig('_LINK_FACEBOOK') !!}" target="_blank"><img
                            src="{{asset('img/icons_social/facebook.png')}}" width="40px" height="40px"/></a>
                <a href="{!! HelperConfig::getConfig('_LINK_PINTEREST') !!}" target="_blank"><img
                            src="{{asset('img/icons_social/pinterest.png')}}" width="40px" height="40px"/></a>
                <a href="{!! HelperConfig::getConfig('_LINK_GOOGLE+') !!}" target="_blank"><img
                            src="{{asset('img/icons_social/googleplus.png')}}" width="40px" height="40px"/></a>
                <br/>
                <br/>
            </div>
            <div class="col-lg-2 col-md-2 hidden-sm hidden-xs text-center">
                <img src="{{asset('storage/app/public/tia_sin.jpg')}}" class="center-block img-responsive hidden-md"
                     style="margin-top:27px;"/>
                <img src="{{asset('storage/app/public/tia_sin.jpg')}}" class="center-block img-responsive hidden-lg"
                     style="margin-top:57px;"/>

            </div>
            <div class="col-lg-1 col-md-1 hidden-sm hidden-xs text-center">
                <br/>
                <br/>
                <img src="{{asset('storage/app/public/reloj.jpg')}}" class="center-block img-responsive"/>
            </div>
            <div class="col-lg-3 col-md-3 hidden-sm hidden-xs"><b>Tel&eacute;fono de contacto:<br/>
                    {{HelperConfig::getConfig('_PHONE_SHOP_INDEX')}}<br/>
                    <a href="mailto:{{HelperConfig::getConfig('_MAIL_SHOP_INDEX')}}">{{HelperConfig::getConfig('_MAIL_SHOP_INDEX')}}</a></b><br/>
                C/Olivo 4, &Iacute;llora (Granada)<br/>
                Horario de L a V<br/>
                @if(date('n')>9 && date('j')>10)
                    Ma&ntilde;anas: 10:00 a 14:00 h.<br/>
                    Tardes: 16:00 a 20:00 h.<br/>
                @else
                    Ma&ntilde;anas: 10:00 a 14:00 h.<br/>
                    Tardes: 16:30 a 20:30 h.<br/>
                @endif
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            @include('components/menu')
        </div>
        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
            @yield('content')
        </div>
        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
            @include('components/lateralDerecha')
        </div>
        <footer class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center amarillo">
            <a href="#">T&eacute;rminos y condiciones de venta</a> - <a href="#">Aviso legal</a> - <a href="#">Pol&iacute;tica
                de privacidad</a> - <a href="{!! url('cookies') !!}">Cookies</a>
        </footer>
    </div>
</div>
<div id="fb-root"></div>
{{--boton like face--}}
<script>(function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/es_ES/sdk.js#xfbml=1&version=v2.8";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'))</script>
</body>
</html>
<link rel="stylesheet" href="{!! asset('css/app.css') !!}"/>
<link rel="stylesheet" href="{!! asset('css/main.css') !!}"/>
<link rel="stylesheet" href="{!! asset('css/animate.css') !!}"/>