<div id="carousel-example-generic" class="carousel slide hidden-xs" data-ride="carousel">
    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
        @foreach(HelperProduct::getOffers() as $offer)
        <div class="item @if($loop->first) active @endif">
            <a href="{{url('producto/'.$offer->id.'/'.str_slug($offer->name,'-'))}}">
            <img src="{!! asset('storage/app/public/ofertas/'.$offer->cover) !!}" alt="..."
                 class="center-block img-responsive">
            </a>
        </div>
        @endforeach
    </div>
</div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <br/>
</div>
<div>
    @if(Session::has('messageOK'))
        <br/>
        <div class="alert alert-success">
            <b>Mensaje recibido correctamente.</b>
        </div>
    @endif
    @if(Session::has('errorMessage'))
            <br/>
        <div class="alert alert-danger">
            <b>Ops.</b> Algo fue mal.
        </div>
    @endif
</div>
<div>
    <b>Contacte con nosotros</b><br/>
    {!! Form::open(['url' => 'newmessage','method'=>'post','class'=>'form']) !!}
    <input type="text" name="nombre" class="form-control" placeholder="Nombre" required>
    <br/>
    <input type="text" name="telefono" class="form-control" placeholder="Tel&eacute;fono" required>
    <br/>
    <input type="email" name="email" class="form-control" placeholder="Email" required>
    <br/>
    <textarea name="mensaje" class="form-control" placeholder="Mensaje" required></textarea>
    <br/>
    <button type="submit" class="center-block btn btn-primary">Enviar</button>
    {!! Form::close() !!}
    <br/>
</div>
<div class="hidden-lg hidden-md hidden-sm col-xs-12 text-center">
    <br/>
    <b>Tel&eacute;fono de contacto:<br/>
        <a href="tel:657464168">657 46 41 68</a><br/>
        <a href="mailto:info@printcolorillora.com">info@printcolorillora.com</a></b><br/>
    C/Olivo 4, &Iacute;llora (Granada)<br/>
</div>
</div>