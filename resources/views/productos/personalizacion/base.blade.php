<script src="{{asset('js/prices/prices.js')}}" type="text/javascript"></script>
<span class="label label-info">* IVA no incluido</span>
<p><b>Producto</b>: {{$producto->name}} <span id="InfoProductSelect"></span></p>
{!! Form::hidden('idProducto',Request::segment(2),['id'=>'idProductoInput']) !!}
{!! Form::hidden('idTypeProduct',null,['id'=>'idTypeProduct']) !!}
{!! Form::hidden('precio',null,['id'=>'precioProductoInput']) !!}
{!! Form::hidden('tipoAcabado',null,['id'=>'nametypeend']) !!}
<p><b>Precio</b>: <span id="precioProducto">0,00</span> €</p>

@if($producto->id==7)
    <br/>
    Color del papel: {!! Form::select('color_papel',['mezcla'=>'Colores mezclados (por defecto)','rosa'=>'Rosa','amarillo'=>'Amarillo','naranja'=>'naranja','verde'=>'Verde'],null,['class'=>'form-control']) !!}
@endif
@if ($producto->id==54 || $producto->id==55 || $producto->id==56 || $producto->id==57)
    <br/>
    Posición de tu imagen:
    {!! Form::select('posicion',['centrada'=>'Centrada (por defecto)','derecha_asa'=>'A la derecha del asa','izquierda_asa'=>'A la izquierda del asa'],null,['class'=>'form-control']) !!}
@endif
@if($producto->id==22 || $producto->id==78)
    <br/>
    Talonarios: {!! Form::select('talonarios',['50uds'=>'Tacos de 50 uds (Gratis)','25uds'=>'Tacos de 25 uds (+10.00 €)'],null,['class'=>'form-control']) !!}
@endif
@if($producto->id==34)
    <br/>
    Plegado:{!! Form::select('plegado',['no'=>'No','diptico'=>'Si (Díptico) (+9,00€)','triptico'=>'Si (Tríptico) (+9,00€)'],null,['class'=>'form-control']) !!}
@endif
@if($producto->id==33)
    <br/>
    Tipo de papel:{!! Form::select('plegado',['90'=>'90 gr. (Gratis)','estucado_brillo'=>'Estucado Brillo 125gr. (+9,90€)'],null,['class'=>'form-control']) !!}
@endif
@if($producto->id==32)
    <br/>
    Ojales de sujección:
    {!! Form::select('ojales',['no'=>'No','100cm'=>'Si, cada 100 cm. (+5,00 €)','50cm'=>'Si, cada 50 cm. (+10,00 €)'],null,['class'=>'form-control']) !!}
    <br/>
    Refuerzo lateral (Dobladillo):
    {!! Form::select('refuerzo',['no'=>'No','hasta400cm'=>'Si, hasta 400 cm. (+19,00 €)','hasta1000cm'=>'Si, de 401cm a 1000cm.(+39,00 €)'],null,['class'=>'form-control']) !!}

@endif
@if($producto->id!=0  && $producto->id!=5 && $producto->id!=6 && $producto->id!=7 && $producto->id!=8 && $producto->id!=9 && $producto->id!=54 && $producto->id!=55 && $producto->id!=56 && $producto->id!=57
&& $producto->id!=58 && $producto->id!=63 && $producto->id!=22 && $producto->id!=78 && $producto->id!=42 && $producto->id!=33 && $producto->id!=34 && $producto->id!=35 && $producto->id!=23 && $producto->id!=75
&& $producto->id!=76 && $producto->id!=77 && $producto->id!=25 && $producto->id!=26 && $producto->id!=27 && $producto->id!=29 && $producto->id!=30 && $producto->id!=32 && $producto->id!=10 && $producto->id!=71
&& $producto->id!=72 && $producto->id!=73 && $producto->id!=36 && $producto->id!=37 && $producto->id!=38 && $producto->id!=13 && $producto->id!=14 && $producto->id!=15 && $producto->id!=16 && $producto->id!=17
&& $producto->id!=18 && $producto->id!=19 && $producto->id!=20 && $producto->id!=81)
    <br/>
    Seleccione tipo de acabado: {!! Form::select('acabado',['brillo'=>'Brillo','mate'=>'Mate'],null,['class'=>'form-control','required'=>'required','placeholder'=>'Seleccione una opción']) !!}
@endif

@if($producto->id==37)
    <br/>
    Cantidad:
    {!! Form::number('cantidad',0,['class'=>'form-control','required'=>'required','placeholder'=>'Seleccione una cantidad','id'=>'cantidad']) !!}
    <br/>
    ¿Retoque fotográfico?:
    {!! Form::select('retoque_fotografico',['no'=>'No','si'=>'Si. (+6,00 €)'],null,['class'=>'form-control','required'=>'required','placeholder'=>'Seleccione una opción']) !!}
@endif

@if($producto->id>12 && $producto->id<21)
    <br/>
    Numeración:
    {!! Form::select('numeracion',['no'=>'No (Por defecto)','250'=>'Si, 250 números (+10 €)','500'=>'Si, 500 números (+15€)','1000'=>'Si, 1000 números (+30€)','2000'=>'Si, 2000 números (+40€)','2500'=>'Si, 2500 números (+45€)','5000'=>'Si, 5000 números (+50€)'],null,['class'=>'form-control','required'=>'required','placeholder'=>'Seleccione una opción']) !!}
@endif

@if($producto->id==63)
    <script src="{{asset('js/prices/setPrice63.js')}}" type="text/javascript"></script>
    <br/>
    Forma de tu alfombrilla de ratón:
    {!! Form::select('forma_alfombrilla',['no'=>'Rectangular (por defecto)','circular'=>'Circular','corazon'=>'Corazón'],null,['class'=>'form-control','required'=>'required','placeholder'=>'Seleccione una opción']) !!}
@endif
@if($producto->id==38)
    <br/>
    ¿4 agujeros de sujección?:
    {!! Form::select('sujeccion',['no'=>'No','si'=>'Si. (+6,00 €)'],null,['class'=>'form-control','required'=>'required','placeholder'=>'Seleccione una opción']) !!}
    <br/>
    Kit de tornillería:
    {!! Form::select('kit_tornilleria',['no'=>'No (Gratis)','si'=>'Si (+18,00 €)'],null,['class'=>'form-control','required'=>'required','placeholder'=>'Seleccione una opción']) !!}
@endif

<br/>
@if($producto->id!=81)
¿Cual es tu urgencia?: {!! Form::select('urgencia',['free'=>'Normal (Gratis)','pay'=>'Urgente (+4,95 €)'],null,['class'=>'form-control','required'=>'required','placeholder'=>'Seleccione una opción','id'=>'urgencia']) !!}
<br/>
@endif
@if($producto->id!=37 && $producto->id!=24 && $producto->id!=81)
¿Desea diseño gráfico?:
{!! Form::select('diseno',['no'=>'No, ya dispongo de mi diseño','si_unacara'=>'Si, deseo diseño de una cara (+12,00 €)','si_doscara'=>'Si, deseo diseño de las dos caras (+20,00 €)'],null,['class'=>'form-control','required'=>'required','placeholder'=>'Seleccione una opción','id'=>'design']) !!}
@endif