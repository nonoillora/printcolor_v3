Acabas de recibir un nuevo pedido,<br/>
<b>{{$cliente->full_name}}</b> realizo un nuevo pedido <br/>

Ha pedido los siguientes productos: <br/>
<table>
    @foreach($lineas as $linea)
        <tr>
            <td>{{unserialize($linea->description)['producto']}}</td>
            <td>{{round($linea->price+($linea->price/100*21),2)}}&euro;</td>
        </tr>
    @endforeach
</table>
<br/>
el {{date_format($pedido->created_at,'d-m-y')}} a las {{date_format($pedido->created_at,'H:i:s')}}
<br/>
