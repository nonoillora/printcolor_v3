@extends('template')
@section('title')
    {{$title}}
@endsection
@section('content')
    <div class="breadcrumbs">
        <ol class="breadcrumb">
            <li>
                <a href="{{url('/')}}">Inicio</a>
                <span class="glyphicon glyphicon-chevron-right"></span>
                <a href="{{url('cesta')}}">Mi Compra</a>
            </li>
        </ol>
    </div>
    @if(Session::has('cartDestroy'))
        <div class="alert alert-success">
            {{Session::get('cartDestroy')}}
        </div>
    @endif
    @if(!$cart->isEmpty())
    <div class="table-responsive">
            <table class="table table-condensed">
                <thead>
                <tr class="cart_menu">
                    <td class="image">Item</td>
                    <td class="description">Descripci&oacute;n</td>
                    <td class="price">Precio</td>
                    <td class="quantity">Cantidad</td>
                    <td class="total">Total</td>
                    <td class="options">Opciones</td>
                </tr>
                </thead>
                <tbody class="table-responsive">
                @foreach($cart as $item)
                    <tr>
                        <td class="cart_product" width="20%">
                            <a href="">
                                <img src="{{asset('/storage/app/public/productos/'.HelperProduct::getImageProductForCartView($item->id))}}" alt="" class="text-center img-responsive">
                            </a>
                        </td>
                        <td class="cart_description">
                            <h4><a href="">{{$item->name['producto']}}</a></h4>

                            @if(count($item->name)>0)
                                @foreach($item->name as $tipo=>$option)
                                    @if($tipo!='producto')
                                    {{$tipo.':'.$option}}<br/>
                                    @endif
                                @endforeach
                            @else
                                {{$item->options->color}}
                            @endif
                        </td>
                        <td class="cart_price">
                            <p>{{$item->price}}&euro;</p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button text-center">
                                <span>{{$item->qty}}</span>
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price ">{{$item->subtotal}}&euro;</p>
                        </td>
                        <td class="cart_delete">
                            @foreach($item->options as $tipo=>$data)
                                <p><b>{{$tipo}}</b>:&nbsp;{{$data}}</p>
                            @endforeach
                            <a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
                        </td>
                        <td>
                            <a href="{{url('quitarProducto/'.$item->rowId)}}" class="btn btn-danger"><span
                                        class="glyphicon glyphicon-trash"></span> </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
    </div>

    <section>
        <div class="row">
            <div class="col-sm-6">
                <div class="total_area">
                    <ul>
                        <li>Gastos de gesti&oacute;n <span>5 &euro;</span></li>
                        <li>Total <span>{{Cart::subtotal()}}&euro;</span></li>
                    </ul>
                    <a class="btn btn-warning" href="{{url('clearCart')}}"><span
                                class="glyphicon glyphicon-shopping-cart"></span> Vaciar Cesta</a>
                    <a class="btn btn-success pull-r" href="{{url('confirmacion-pedido')}}">Continuar</a>
                </div>
            </div>
        </div>
    </section><!--/#do_action-->
    @else
        <div class="text-center">
            <h3>Su cesta se encuentra vac&iacute;a</h3>
        </div>
    @endif
@endsection