<h2 style="margin-top: 0;">Productos</h2>
@foreach($categorias as $categoria)
    @if(Request::segment(1)=='categoria')
        <div style="padding: 4px;" class="@if($categoria->id==Request::segment(2)) amarillo @endif">
            <a href="{!! url('categoria/'.$categoria->id.'/'.str_slug($categoria->name,'-')) !!}" style="text-decoration: none;"><b>{{$categoria->name}}</b></a>
        </div>
    @else
        <div style="padding: 4px;" class="@if($categoria->id==$id) amarillo @endif">
            <a href="{!! url('categoria/'.$categoria->id.'/'.str_slug($categoria->name,'-')) !!}" style="text-decoration: none;"><b>{{$categoria->name}}</b></a>
        </div>
    @endif
@endforeach