<nav class="navbar navbar-default" style="margin-top: -3px;">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand hidden-xs" href="{!! url('/') !!}">
                <img src="{!! asset('img/logo.png') !!}" class="img-responsive img-rounded" height="100%" width="100%" alt=""/>
            </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="@if(Request::segment(1)=='') active @endif"><a href="{!! url('/') !!}">Inicio</a></li>
                <li class="@if(Request::segment(1)=='categorias') active @endif"><a href="{!! url('categorias') !!}">Productos</a></li>
                <li class="@if(Request::segment(1)=='faq') active @endif"><a href="{!! url('faq') !!}">Preguntas Frecuentes</a></li>
                <li class="@if(Request::segment(1)=='ofertas') active @endif"><a href="{!! url('ofertas') !!}">Ofertas</a></li>
                <li class="@if(Request::segment(1)=='nosotros') active @endif"><a href="{!! url('nosotros') !!}">Con&oacute;cenos</a></li>
{{--
                <li class="@if(Request::segment(1)=='plantillas') active @endif"><a href="{!! url('plantillas') !!}">Plantillas</a></li>
--}}
                <li class="@if(Request::segment(1)=='subirficheros') active @endif"><a href="{!! url('subirficheros') !!}">Subir Ficheros</a></li>
                <li class="@if(Request::segment(1)=='mi-compra') active @endif"><a href="{!! url('cesta') !!}">Mi Cesta</a></li>
                <li>
                    <a>
                        <div class="fb-like" data-href="https://www.facebook.com/printcolorillora" data-layout="button" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
                    </a>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div>
</nav>