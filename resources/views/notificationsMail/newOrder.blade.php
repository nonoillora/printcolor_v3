<style>
    .header_table, .info_precio {
        background-color: #6E665A;
        color: white;
        font-weight: bold;;
    }

    .unidad, .info {
        background-color: rgba(231, 225, 208, 0.41);
        color: black;
        text-align: center;
    }

    .precio {
        background-color: #9ABBC4;
        text-align: right;
        color: black
    }

    .recuadro {
        border: 1px solid #000000;
    }

    .text-center {
        text-align: center;
    }

</style>
Acabas de recibir un nuevo pedido,<br/>
<b>{{$cliente->full_name}}</b> realizo un nuevo pedido <br/>

Ha pedido los siguientes productos: <br/>
<table>
    @foreach($lineas as $linea)
        <tr>
            <td class="unidad recuadro" width="10%">1</td>
            <td width="60%" class="recuadro">
                {{unserialize($linea->description)['producto']}}
                -
                {{unserialize($linea->description)['Cantidad seleccionada']}}
                -
                {{unserialize($linea->description)['Tipo Acabado']}}
                @if(count(unserialize($linea->options))>0)
                    <hr/>
                    @foreach (unserialize($linea->options) as $tipo=>$option)
                        <b>{{$tipo}}</b>: {{$option}}<br/>
                    @endforeach
                @endif
            </td>
            <td width="10%" class="text-center recuadro">{{$linea->price}} &euro;</td>
        </tr>
    @endforeach
</table>
<br/>
el {{date_format(date_create($pedido->created_at),'d-m-y')}} a las {{date_format(date_create($pedido->created_at),'H:i:s')}}
<br/>
@if($pedido->isPaid)
    El pedido se ha marcado como <b>pagado</b>, se ha realizado la operacion a traves de
    <b>{{$pedido->tipoPago()->first()->nombre}}</b>, se marco como pagado: {{date_format(date_create($pedido->paid_at),'d-m-Y  H:i:s')}}

@else
    El pedido se ha marcado como <b>no pagado</b>, se ha seleccionado el metodo de pago
    <b>{{$pedido->tipoPago()->first()->nombre}}</b>
@endif
<br/>
