<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center ">
        <div class="todosBordes" style="background-color: #feffcf"><h4>ENV&Iacute;O GRATIS (de 24 a 48 horas)</h4></div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center ">
        <div class="todosBordes" style="background-color: #feffcf">
            <h4>Impresión 1 Cara</h4>
        </div>
    </div>
    <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
        <table class="table-bordered table-hover table-condensed">
            <thead>
            <tr>
                @foreach($keys1 as $key)
                    <td class="text-center" style="background-color: rgba(255, 80, 131, 0.41)"><b>{{$key}}</b></td>
                @endforeach
            </tr>
            </thead>
            @foreach($uds1 as $ud)
                <tr>
                    @foreach($ud as $price)
                        @if($price['type']=='info')
                            <td class="text-center">{{$price['price']}}</td>
                        @else
                            <td class="precioProducto text-center"
                                data-content="{{' - '.$price['name'].' - '.$price['count']}}"
                                data-idPriceProduct="{{$price['idPriceProduct']}}"
                                data-nametypeend="{{$price['name']}}">{{$price['price']}}</td>
                        @endif
                    @endforeach
                </tr>
            @endforeach
        </table>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center ">
        <div class="todosBordes" style="background-color: #feffcf">
            <h4>Impresión 2 Caras</h4>
        </div>
    </div>
    <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
        <table class="table-bordered table-hover table-condensed">
            <thead>
            <tr>
                @foreach($keys2 as $key)
                    <td class="text-center" style="background-color: rgba(255, 80, 131, 0.41)"><b>{{$key}}</b></td>
                @endforeach
            </tr>
            </thead>
            @foreach($uds2 as $ud)
                <tr>
                    @foreach($ud as $price)
                        @if($price['type']=='info')
                            <td class="text-center">{{$price['price']}}</td>
                        @else
                            <td class="precioProducto text-center"
                                data-content="{{' - '.$price['name'].' - '.$price['count']}}"
                                data-idPriceProduct="{{$price['idPriceProduct']}}"
                                data-nametypeend="{{$price['name']}}">{{$price['price']}}</td>
                        @endif
                    @endforeach
                </tr>
            @endforeach
        </table>
    </div>
</div>