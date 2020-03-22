<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    <div class="panel panel-info">
        <div class="panel-heading" role="tab" id="headingOne">
            <h4 class="panel-title">
                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne"
                   aria-expanded="true" aria-controls="collapseOne" class="noUnderline">
                    <b>Pedidos</b>
                </a>
            </h4>
        </div>
        <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel"
             aria-labelledby="headingOne">
            <ul class="list-group">
                <a href="{{url('admin/pedidos')}}"
                   class="list-group-item noUnderline @if(Request::segment(2)=='pedidos' && Request::segment(3)=='') active @endif">Ver
                    Todos
                </a>
                <a href="{{url('admin/presupuestos')}}"
                   class="list-group-item noUnderline @if(Request::segment(2)=='presupuestos') active @endif">
                    Presupuestos
                </a>
                <a href="{{url('admin/pedidos/pendientes')}}"
                   class="list-group-item noUnderline @if(Request::segment(3)=='pendientes' && Request::segment(2)=='pedidos') active @endif">
                    Pedidos Pendientes
                </a>
                <a href="{{url('admin/pedidos/enviados')}}"
                   class="list-group-item noUnderline @if(Request::segment(3)=='enviados' && Request::segment(2)=='pedidos') active @endif">Pedidos Enviados</a>
                <a href="{{url('admin/pedidos/pagados')}}"
                   class="list-group-item noUnderline @if(Request::segment(3)=='pagados' && Request::segment(2)=='pedidos') active @endif">Pedidos Sin Pagar</a>
            </ul>
        </div>
    </div>
    <br/>

    <div class="panel panel-info">
        <div class="panel-heading" role="tab" id="headingTwo">
            <h4 class="panel-title">
                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"
                   aria-expanded="true" aria-controls="collapseTwo">
                    <b>Categor&iacute;as</b>
                </a>
            </h4>
        </div>
        <div id="collapseTwo" class="panel-collapse collapse in" role="tabpanel"
             aria-labelledby="headingTwo">
            <ul class="list-group">
                <a class="list-group-item noUnderline @if(Request::segment(2)=='categoria' && Request::segment(3)=='editar') active @endif"
                   href="{{url('admin/categoria/editar')}}">Ver/Editar Categoría</a>
                <a class="list-group-item noUnderline @if(Request::segment(2)=='categoria' && Request::segment(3)=='nueva') active @endif"
                   href="{{url('admin/categoria/nueva')}}">A&ntilde;adir Categor&iacute;a</a>
                <a class="list-group-item noUnderline @if(Request::segment(2)=='categoria' && Request::segment(3)=='borrar') active @endif"
                   href="{{url('admin/categoria/borrar')}}">Eliminar Categoria</a>
            </ul>
        </div>
    </div>
    <br/>

    <div class="panel panel-info">
        <div class="panel-heading" role="tab" id="headingThree">
            <h4 class="panel-title">
                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree"
                   aria-expanded="true" aria-controls="collapseThree">
                    <b>Productos</b>
                </a>
            </h4>
        </div>
        <div id="collapseThree" class="panel-collapse collapse in" role="tabpanel"
             aria-labelledby="headingThree">
            <ul class="list-group">
                <a class="list-group-item noUnderline @if(Request::segment(2)=='producto' && Request::segment(3)=='editar') active @endif"
                   href="{{url('admin/producto/editar')}}">Ver/Editar Producto</a>
                <a class="list-group-item noUnderline @if(Request::segment(2)=='producto' && Request::segment(3)=='nuevo') active @endif"
                   href="{{url('admin/producto/nuevo')}}">A&ntilde;adir Producto</a>
                <a class="list-group-item noUnderline @if(Request::segment(2)=='producto' && Request::segment(3)=='borrar') active @endif"
                   href="{{url('admin/producto/borrar')}}">Eliminar Producto</a>
            </ul>
        </div>
    </div>
    <br/>

    <div class="panel panel-info">
        <div class="panel-heading" role="tab" id="headingFour">
            <h4 class="panel-title">
                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour"
                   aria-expanded="true" aria-controls="collapseFour">
                    <b>Ofertas</b>
                </a>
            </h4>
        </div>
        <div id="collapseFour" class="panel-collapse collapse in" role="tabpanel"
             aria-labelledby="headingFour">
            <ul class="list-group">
                <a class="list-group-item noUnderline @if(Request::segment(2)=='ofertas' && Request::segment(3)=='') active @endif"  href="{{url('admin/ofertas/')}}" >Ver/Editar Ofertas</a>
                <a class="list-group-item noUnderline @if(Request::segment(2)=='ofertas' && Request::segment(3)=='nueva') active @endif"  href="{{url('admin/ofertas/nueva')}}" >Añadir Oferta</a>
                <a class="list-group-item noUnderline @if(Request::segment(2)=='ofertas' && Request::segment(3)=='borrar') active @endif"  href="{{url('admin/ofertas/borrar')}}">Eliminar Oferta</a>
            </ul>
        </div>
    </div>
    <br/>

    <div class="panel panel-danger">
        <div class="panel-heading" role="tab" id="headingFive">
            <h4 class="panel-title">
                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFive"
                   aria-expanded="true" aria-controls="collapseFive">
                    <b>Administraci&oacute;n</b>
                </a>
            </h4>
        </div>
        <div id="collapseFive" class="panel-collapse collapse" role="tabpanel"
             aria-labelledby="headingFive">
            <ul class="list-group">
                <a class="list-group-item noUnderline @if(Request::segment(2)=='shipping' && Request::segment(3)=='') active @endif"
                   href="{{url('admin/shipping/')}}">Empresas de transporte</a>
                <a class="list-group-item noUnderline @if(Request::segment(2)=='utilidades' && Request::segment(3)=='') active @endif"
                   href="{{url('admin/utilidades')}}">Utilidades</a>
                <a class="list-group-item noUnderline @if(Request::segment(2)=='config' && Request::segment(3)=='') active @endif"
                   href="{{url('admin/config')}}">Configuración</a>
                <a class="list-group-item noUnderline @if(Request::segment(2)=='ficheros' && Request::segment(3)=='') active @endif"
                   href="{{url('admin/ficheros')}}">Ficheros</a>
            </ul>
        </div>
    </div>
</div>