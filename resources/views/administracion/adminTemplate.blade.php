<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Print Color Íllora -
        @yield('titleAdmin')
    </title>
    <script type="text/javascript" src="{!! asset('js/jquery-3.1.1.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('js/app.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('js/js.js') !!}"></script>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script type="text/javascript">
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <a href="{!! url('/') !!}"><img src="{{asset('storage/app/public/logo.png')}}"
                                                class="img-responsive center-block"/></a>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center hidden">
                <h3>Impresi&oacute;n r&aacute;pida<br/>
                    y<br/>
                    Segura</h3>
                <a href="https://www.twitter.com/{!! HelperConfig::getConfig('_LINK_TWITTER') !!}" target="_blank"><img
                            src="{{asset('img/icons_social/twitter.png')}}" width="40px" height="40px"/></a>
                <a href="https://www.instagram.com/{!! HelperConfig::getConfig('_LINK_INSTAGRAM') !!}"
                   target="_blank"><img
                            src="{{asset('img/icons_social/instagram.jpg')}}" class="img-circle" width="40px"
                            height="40px"/></a>
                <a href="https://www.facebook.com/{!! HelperConfig::getConfig('_LINK_FACEBOOK') !!}"
                   target="_blank"><img
                            src="{{asset('img/icons_social/facebook.png')}}" width="40px" height="40px"/></a>
                <a href="https://www.pinterest.es/{!! HelperConfig::getConfig('_LINK_PINTEREST') !!}"
                   target="_blank"><img
                            src="{{asset('img/icons_social/pinterest.png')}}" width="40px" height="40px"/></a>
                <a href="https://plus.google.com/{!! HelperConfig::getConfig('_LINK_GOOGLE+') !!}" target="_blank"><img
                            src="{{asset('img/icons_social/googleplus.png')}}" width="40px" height="40px"/></a>
                <br/>
                <br/>
            </div>
            <div class="col-lg-3 col-md-3 hidden-sm hidden-xs text-center">
                <img src="{{asset('storage/app/public/tia_sin.jpg')}}" class="center-block img-responsive" width="140px"
                     height="140px"/>
            </div>
            <div class="col-lg-3 col-md-3 hidden-sm hidden-xs"><b>Tel&eacute;fono de contacto:<br/>
                    657 46 41 68<br/>
                    <a href="mailto:info@printcolorillora.com">info@printcolorillora.com</a></b><br/>
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
            <div class="row">
                <div class="col-lg-3">
                    @include('administracion/lateralAdmin')
                </div>
                <div class="col-lg-9">
                    @yield('adminContent')
                </div>
            </div>
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