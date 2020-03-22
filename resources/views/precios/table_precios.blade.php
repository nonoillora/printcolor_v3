@if(count($typePrice)>0)
    <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center ">
        <div class="todosBordes" style="background-color: #feffcf"><h4>ENV&Iacute;O GRATIS (de 24 a 48 horas)</h4></div>
    </div>
    <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
        <table class="table table-bordered table-hover table-condensed table-responsive">
            <thead>
            <tr>
                @foreach($keys as $key)
                    <td class="text-center" style="background-color: rgba(255, 80, 131, 0.41)"><b>{{$key}}</b></td>
                @endforeach
            </tr>
            </thead>
            @foreach($uds as $ud)
                <tr>
                    @foreach($ud as $price)
                        @if($price['type']=='info')
                            <td class="text-center">{{$price['price']}}</td>
                        @else
                            <td class="precioProducto text-center" data-content="{{' - '.$price['name'].' - '.$price['count']}}" data-idPriceProduct="{{$price['idPriceProduct']}}" data-nametypeend="{{$price['name']}}">{{$price['price']}}</td>
                        @endif
                    @endforeach
                </tr>
            @endforeach
        </table>
    </div>
    </div>
@else
    <div>
        <br/>
        <h4><span class="label label-default label-lg">No se han añadido precios aún.</span></h4>
    </div>
@endif