@extends('template')
@section('title')
    {{$title}}
@endsection
@section('content')
    <div class="row">
    @foreach($offers as $product)
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 productoItem">
                <a target="_self"
                   href="{!! url('producto/'.$product->id.'/'.str_slug($product->name,'-')) !!}">
                    <div class="thumbnail noUnderline" style="border:none">
                        @if(empty($product->cover))
                            <img src="{!! asset('img/camera_icon.jpg')  !!}" alt="..." class="img-responsive">
                        @else
                            <img src="{!! asset('storage/app/public/ofertas/'.$product->cover)  !!}"
                                 alt="..." class="img-responsive">
                        @endif
                        <div class="caption amarillo text-center tituloCat">
                            <h4>{{$product->name}}</h4>
                        </div>
                    </div>
                </a>
            </div>
            @if($loop->iteration%3==0)
                <div class="clearfix"></div>
            @endif
        @endforeach
        </div>
        <div class="text-center">
            {!! $offers->links() !!}
        </div>
@endsection