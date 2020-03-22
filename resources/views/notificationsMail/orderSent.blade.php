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
<table width="800">
    <tr>
        <td>
            <img src="http://printcolor.antonioextremera.com/storage/app/public/logo.png">
        </td>
    </tr>
    <tr>
        <td>
            <table width="800">
                <td>
                    <h3>Hola {{$cliente->full_name}}</h3>
                </td>
                <td>&nbsp;</td>
                <td style="text-align: right">
                    <b>Información del pedido:</b>
                </td>
                <td>
                    {{$pedido->numIdentificacionPedido}}
                </td>
            </table>
        </td>

    </tr>
    <tr>
        <td>
            Gracias por tu pedido. Te mandamos este e-mail porque hemos enviado tu(s) producto(s). A continuación te
            indicamos los datos para seguir el envio de tu pedido.
        </td>
    </tr>
    <tr>
        <td>
            <table width="800" border="0">
                <tr>
                    <td>Compañia de transporte asignada: <b>{{$companyShipping->name_company}}.</b></td>
                </tr>
                <tr>
                    <td>Número de seguimiento: <b>{{$pedido->num_seguimiento}}.</b></td>
                </tr>
                <tr>
                    <td>Es posible que la información de seguimiento no se muestre de forma inmediata.</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <table width="800" bgcolor="#e5ffd6">
                <tr>
                    <th bgcolor="header_table text-center" style="color:white">La dirección de envio es la sigueinte:
                    </th>
                </tr>
                <tr>
                    <td>
                        <hr width="100%">
                    </td>
                </tr>
                <tr>
                    <td bgcolor="#d3ffba"> {{$cliente->full_name}}</td>
                </tr>
                <tr>
                    <td bgcolor="#e5ffd6">{{$cliente->address}}</td>
                </tr>
                <tr>
                    <td bgcolor="#d3ffba">{{$cliente->poblation}}, {{$cliente->postal_code}}</td>
                </tr>
                <tr>
                    <td bgcolor="#e5ffd6">{{$cliente->provence}}, España</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <br/><br/>
        </td>
    </tr>
    <tr>
        <td>
            <table>
                <tr>
                    <td>A continuación, le detallamos los productos de su pedido:</td>
                </tr>
                <tr>
                    <td>Nº Pedido: <b>{{$pedido->numIdentificacionPedido}}</b></td>
                </tr>
                <tr>
                    <td>Realizado el {{HelperMail::transformDateOrder($pedido->created_at)}}</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <table width="800" border="1" style="border-collapse: collapse">
                <tr>
                    <td class="header_table text-center recuadro">Unidades</td>
                    <td class="header_table recuadro">Artículo</td>
                    <td class="header_table text-center recuadro">PVD</td>
                </tr>
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
                        <td width="10%" class="text-center">{{$linea->price}} &euro;</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="2">
                        <table width="800">
                            <tr>
                                <td width="70%">
                                    <table class="recuadro" width="100%" style="border-collapse: collapse">
                                        <tr>
                                            <td colspan="2">
                                                Observaciones:
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                &nbsp;
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                &nbsp;
                                            </td>
                                            <td>&nbsp;</td>
                                        </tr>
                                    </table>
                                </td>
                                <td width="30%" align="right">
                                    <table width="100%" class="recuadro" style="border-collapse: collapse" border="1">
                                        <tr>
                                            <td class="info_precio recuadro">Base imponible</td>
                                        </tr>
                                        <tr>
                                            <td class="info_precio recuadro">IVA 21%</td>
                                        </tr>
                                        <tr>
                                            <td class="info_precio recuadro">Total</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td>
                        <table width="800" class="recuadro">
                            <tr>
                                <td class="precio">{{$pedido->withoutIVA}} &euro;</td>
                            </tr>
                            <tr>
                                <td class="precio">{{$pedido->totalIVA}} &euro;</td>
                            </tr>
                            <tr>
                                <td class="precio">{{$pedido->totalPedido}} &euro;</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>