<div class="row">
    @if(Session::has('itemRemove'))
        <div class="alert alert-success">
        {{Session::get('itemRemove')}}
        </div>
    @endif
    <h3><span class="glyphicon glyphicon-shopping-cart btn btn-circle btn-primary"></span> Carrito</h3>

    <div class="row">
        @foreach($cart as $item)
            @if($loop->iteration<3)
                <div class="col-lg-4 col-xs-12 center-block text-center">
                    <img src="{{asset('storage/app/public/logo.png')}}" class="img-responsive">
                </div>
                <div class="col-lg-8 col-xs-12">
                    {{$item->name}}
                </div>
                <div class="clearfix"></div>
                <div class="col-lg-4 col-xs-12">{{$item->price}}&euro;</div>
                <div class="col-lg-4 col-xs-12">{{$item->qty}}</div>
                <div class="col-lg-4 col-xs-12">{{$item->subtotal}}&euro;</div>
                <div class="col-lg-12 col-xs-12">
                    <a href="{{url('quitarProducto/'.$item->rowId)}}">
                        <i class="glyphicon glyphicon-trash"></i>
                    </a>
                </div>
            @endif
        @endforeach
        <div class="col-lg-12 col-xs-12">
            <br/>
        </div>
            @if(Cart::count()>2)
        <div class="col-lg-12 col-xs-12 label label-info">
            <b>{{Cart::count()-2}} Producto(s) m&aacute;s</b>
        </div>
            @endif
        <div class="col-lg-12 col-xs-12">
            <br/>
        </div>
        <div class="col-lg-12 col-xs-12">
            <a href="{{url('mi-compra')}}" class="btn btn-primary btn-block">Ver Cesta</a>
        </div>
        <div class="col-lg-12 col-xs-12">
            <br/>
        </div>
    </div>
    <ul class="list-group">
        <li class="list-group-item">
            Total Productos:
            <span class="pull-right">{{Cart::count()}}</span>
        </li>
        <li class="list-group-item">IVA:
            <span class="pull-right">{{number_format(21/100*Cart::subtotal(),2)}}&euro;</span>
        </li>
        <li class="list-group-item">
            Total: <span class="pull-right">{{number_format(((21/100*Cart::subtotal())+Cart::subtotal()),2)}}&euro;</span>
        </li>
    </ul>
</div>