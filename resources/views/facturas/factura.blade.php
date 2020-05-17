<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>PDF</title>
    <link rel="stylesheet" href="{{asset('css/facturas/factura-pedido.css')}}" type="text/css"/>

    <style type="text/css">
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

        .profile {
            background: rgba(231, 225, 208, 0.41);
            color: black;
            border: 1px solid black;
        }

        .profile h1 {
            text-align: center;
            font-weight: bold;
            padding: 2px;
            margin: 2px;
        }

        .main {
            margin: 0px 20px 0px 20px;
        }

        .recuadro {
            border: 1px solid #000000;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        table > tr {
            page-break-before: always;
        }

        table > tr > td {
            page-break-before: always;
        }


    </style>
</head>
<body>
<table width="100%" class="main" style="margin: 0px 20px 0px 20px;table-layout:fixed;">
    <tr>
        <td colspan="2" style="width:35%;">
            <table class="profile" style="width:100%;">
                <tr>
                    <td colspan="2">
                        <h1>Angel Perez Esteban</h1>
                    </td>
                </tr>
                <tr>
                    <td>C/ Olivo, 4 Íllora</td>
                    <td class="text-right" style="text-align: right">18260 - Granada</td>
                </tr>
                <tr>
                    <td colspan="2">TLF/FAX:657464168</td>
                </tr>
                <tr>
                    <td colspan="2">CIF: 77448337T</td>
                </tr>
            </table>
        </td>
        <td style="width:50%;text-align: center">
            <img src="{{asset('storage/app/public/logo.png')}}" class="img-responsive" width="180" height="113">
        </td>
    </tr>
    <tr>
        <td style="width:40%">
            <table style="width:100%;table-layout:fixed;">
                <tr>
                    <td class="recuadro" width="50%"
                        style="background-color: rgba(231, 225, 208, 0.41);text-align: left;">Fecha
                    </td>
                    <td class="text-center recuadro" width="50%">{{date('d-m-Y',strtotime($cliente->created_at))}}</td>
                </tr>
                <tr>
                    <td style="border-right: 1px solid white;border-left: 1px solid white;">
                        &nbsp;
                    </td>
                    <td style="border-right: 1px solid white;border-left: 1px solid white;">
                        &nbsp;
                    </td>
                </tr>
                <tr>
                    <td class="recuadro" width="50%"
                        style="background-color: rgba(231, 225, 208, 0.41);text-align: left;">
                        Página
                    </td>
                    <td class="text-center recuadro" width="50%">
                        1 de 1
                    </td>
                </tr>
                <tr>
                    <td style="border-right: 1px solid white;border-left: 1px solid white;">
                        &nbsp;
                    </td>
                    <td style="border-right: 1px solid white;border-left: 1px solid white;">
                        &nbsp;
                    </td>
                </tr>
                <tr>
                    <td class="recuadro" width="50%"
                        style="background-color: rgba(231, 225, 208, 0.41);text-align: left;height: 21px;">
                        Nº Factura
                    </td>
                    <td class="text-center recuadro" width="50%">
                        {{$factura->numeracionFactura}}
                    </td>
                </tr>
            </table>
        </td>

        <td style="width:70%;" colspan="2">
            <table style="width:100%;table-layout:fixed;">
                <tr>
                    <td style="width:20%;height:70px">
                    </td>
                    <td style="width:80%;height:70px">
                        <table style="width:100%;table-layout:fixed;">
                            <tr>
                                <td class="info recuadro" style="width:20%">
                                    Nombre
                                </td>
                                <td colspan="3" class="recuadro" style="width:80%">
                                    {{$cliente->full_name}}
                                </td>
                                </td>
                            </tr>
                            <tr>
                                <td class="info recuadro" style="width:20%">
                                    Dirección
                                </td>
                                <td colspan="3" class="recuadro" style="width:80%">
                                    {{$cliente->address}}
                                </td>
                                </td>
                            </tr>
                            <tr>
                                <td class="info recuadro" style="width:25%">
                                    Población
                                </td>
                                </td>
                                <td class="text-center recuadro" style="width:25%">
                                    {{$cliente->poblation}}
                                </td>
                                </td>
                                <td class="info recuadro" style="width:25%">
                                    Provincia
                                </td>

                                </td>
                                <td class="text-center recuadro" style="width:25%">
                                    {{$cliente->provence}}
                                </td>
                            </tr>
                            <tr>
                                <td class="info recuadro" style="width:25%">
                                    CIF/NIF
                                </td>
                                <td class="text-center recuadro" style="width:25%">
                                    {{$cliente->nif_cif}}
                                </td>

                                <td class="info recuadro" style="width:25%">
                                    C. Postal
                                </td>
                                <td class="text-center recuadro" style="width:25%">
                                    {{$cliente->postal_code}}
                                </td>
                            </tr>
                            <tr>
                                <td class="info recuadro" style="width:25%">
                                    Teléfono
                                </td>
                                <td class="text-center recuadro" style="width:25%">
                                    {{$cliente->phone}}
                                </td>

                                <td class="info recuadro" style="width:25%">
                                    Nº Cliente
                                </td>
                                <td class="text-center recuadro" style="width:25%">
                                    {{$cliente->id}}
                                </td>
                            </tr>
                        </table>
                    <td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<table>
    <tr>
        <td>&nbsp;</td>
    </tr>
</table>
<table style="table-layout:fixed;width:100%;border:1px solid black" class="main">
    <tr>
        <td class="header_table text-center recuadro">Unidades</td>
        <td class="header_table recuadro">Artículo</td>
        <td class="header_table text-center recuadro">PVD</td>
    </tr>
    @foreach($lineas as $linea)
        <tr>
            <td class="unidad recuadro" style="width:10%">1</td>
            <td style="width:60%" class="recuadro">
                {{unserialize($linea->description)['producto']}}
                -
                {{unserialize($linea->description)['Cantidad seleccionada']}}
                -
                {{unserialize($linea->description)['Tipo Acabado']}}
                @if(count(unserialize($linea->options))>0)
                    <hr/>
                    @foreach (unserialize($linea->options) as $tipo=>$option)
                        {{$tipo}}: {{$option}}<br/>
                    @endforeach
                @endif
            </td>
            <td class="recuadro" style="width:10%;text-align: center">{{$linea->price}} &euro;</td>
        </tr>
{{--
    Con este control hacemos el salto de pagina, cerramos tabla, ponemos div para saltar y volvemos a poner las cabeceras de las tablas
--}}
        @if($loop->iteration%7==0)
        </table>
        <div style="page-break-before: always;"></div>
        <br/>
        <table style="table-layout:fixed;width:100%;border:1px solid black;" class="main">
            <tr>
                <td class="header_table text-center recuadro">Unidades</td>
                <td class="header_table recuadro">Artículo</td>
                <td class="header_table text-center recuadro">PVD</td>
            </tr>
    @endif
{{--
    Fin control salto de pagina
--}}
    @endforeach
    <tr>
        <td colspan="2">
            <table width="100%">
                <tr>
                    <td width="70%">
                        <table class="recuadro" width="100%" style="border-collapse: collapse">
                            <tr>
                                <td colspan="2">
                                    &nbsp;Observaciones:
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    &nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td class="recuadro"
                                    style="margin: 0 auto; padding: 0">
                                    &nbsp;{{HelperConfig::getConfig('_NAME_BANK_TRANSFER_PAY')}}
                                    :
                                </td>
                                <td class="recuadro"
                                    style="margin: 0 auto; padding: 2px">
                                    &nbsp;{{HelperConfig::getConfig('_ACCOUNT_BANK_TRANSFER_PAY')}}</td>
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
                    <td class="precio">{{$pedido}} &euro;</td>
                </tr>
                <tr>
                    <td class="precio">{{HelperProduct::getIVA($pedido,'onlyIVA')}} &euro;</td>
                </tr>
                <tr>
                    <td class="precio">{{HelperProduct::getIVA($pedido,'priceWithIVA')}} &euro;</td>
                </tr>
            </table>
        </td>
        </td>
    </tr>
</table>
</body>
</html>