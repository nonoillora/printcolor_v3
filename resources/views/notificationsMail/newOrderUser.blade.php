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
                    <b>Confirmación del pedido:</b>
                </td>
                <td>
                    {{$pedido->numIdentificacionPedido}}
                </td>
            </table>
        </td>

    </tr>
    <tr>
        <td>
            Gracias por tu pedido. Te mandaremos otro e-mail cuando enviemos tu(s) producto(s).
            @if(!$pedido->isPaid)
                A continuación te enviamos los pasos a seguir para realizar el pago del pedido.
            @endif
        </td>
    </tr>
    <tr>
        <td>
            <ol>
                @switch($pedido->idTipoPago)
                @case('1')
                <li>Acuda a su entidad bancaria.</li>
                <li>Realice una transferencia a la siguiente cuenta
                    bancaria {{HelperConfig::getConfig('_ACCOUNT_BANK_TRANSFER_PAY')}}</li>
                <li>En el concepto de la transferencia indique el siguiente código:
                    <b>{{$pedido->numIdentificacionPedido}}</b> (verificaremos su pedido con este código)
                </li>
                <li>Una vez realizada la transferencia, sería necesario enviad un correo a <a
                            href="mailto:{{HelperConfig::getConfig('_MAIL_TO_SEND_PHOTOS_FROM_ORDER')}}">{{HelperConfig::getConfig('_MAIL_TO_SEND_PHOTOS_FROM_ORDER')}}</a>
                    adjuntando una copia de la transferencia realizada
                    (puede ser el PDF o una foto realizada con el móvil)
                </li>
                @break
                @case('2')
                @if($pedido->isPaid)
                    <li>Su pedido se ha registrado pagado correctamente</li>
                    <li>El pago se completo el {{date_format(date_create($pedido->paid_at),'d-m-Y H:i:s')}} a traves de
                        <b>{{$pedido->tipoPago()->first()->nombre}}</b></li>
                @else
                    <li>Ha ocurrido un error en su pago</li>
                    <li>Por favor, contacte con el dtpo de Atención al cliente en el siguiente
                        mail: <a
                                href="mailto:{{HelperConfig::getConfig('_EMAIL_SEND_NOTIFICATION_OWN')}}">{{HelperConfig::getConfig('_EMAIL_SEND_NOTIFICATION_OWN')}}</a>
                    </li>
                    {{--  <li>En el concepto de la transferencia indique el siguiente código:
                         <b>{{$pedido->numIdentificacionPedido}}</b> (verificaremos su pedido con este código)
                     </li>
                     <li>Una vez realizada la transferencia, sería necesario enviad un correo a <a
                                 href="mailto:{{HelperConfig::getConfig('_MAIL_TO_SEND_PHOTOS_FROM_ORDER')}}">{{HelperConfig::getConfig('_MAIL_TO_SEND_PHOTOS_FROM_ORDER')}}</a>
                         adjuntando una copia de la transferencia realizada
                         (puede ser el PDF o una foto realizada con el móvil)--}}
                    </li>
                @endif
                @break
                @case('3')
                @break
                @default
                @endswitch
            </ol>
        </td>
    </tr>
    <tr>
        <td>
            <table width="100%" bgcolor="#e5ffd6">
                <tr>
                    <th bgcolor="header_table text-center" style="color:white">El pedido se enviara a esta dirección
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
                    <td bgcolor="#d3ffba">{{$cliente->poblation ,', '.$cliente->postal_code}}</td>
                </tr>
                <tr>
                    <td bgcolor="#e5ffd6">{{$cliente->provence}}</td>
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
            <table width="100%" border="1" style="border-collapse: collapse">
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
                        <table width="100%">
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
                        <table width="100%" class="recuadro">
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