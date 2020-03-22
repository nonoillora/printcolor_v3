@extends('administracion/adminTemplate')
@section('titleAdmin')
    {{$title}}
    @endsection
@section('adminContent')
    <div class="breadcrumb">
        <a href="{{url('admin')}}">Administraci&oacute;n</a> <span class="glyphicon glyphicon-chevron-right"></span> <a
                href="{{url('admin/ofertas/')}}">Ofertas</a> <span class="glyphicon glyphicon-chevron-right"></span> Editar oferta
        <div class="pull-right">
            @include('administracion/notificacionBreadcrumb')
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            @if(Session::has('successEditOfer'))
                <div class="alert alert-success">
                    <b>{{Session::get('successEditOfer')}}</b>
                </div>
            @endif
            @if(Session::has('successDeleteImageProduct'))
                <div class="alert alert-success">
                    <b>{{Session::get('successDeleteImageOffer')}}</b>
                </div>
            @endif
            <fieldset>
                <legend>{{$producto->name}} </legend>

                {!! Form::open(['url' => 'admin/ofertas/saveeditofer', 'method' => 'post','files'=>true,'class'=>'form']) !!}
                {!!  Form::hidden('id',$producto->id)!!}
                {!! Form::label('','Nombre',['class'=>'label label-default']) !!}
                {!! Form::text('nombre',$producto->name,['class'=>'form-control','placeholder'=>'Nombre','required'=>'required']) !!}
                <br/>
                {!! Form::label('Imagen','Imagen Exterior',['class'=>'label label-default']) !!}
                @if(empty($producto->cover))
                    <label class="btn btn-primary btn-file btn-block">
                        Buscar
                        Fichero {!! Form::file('cover',['class'=>'btn btn-primary btn-block','style'=>'display:none']) !!}
                    </label>
                @else
                    <img src="{{asset('/storage/app/public/ofertas/'.$producto->cover)}}"
                         class="img-responsive img-rounded center-block">
                <br/>
                    <a href="{{url('admin/ofertas/remove/'.$producto->id.'/'.$producto->cover)}}"
                       class="btn btn-danger center-block">
                        <span class="glyphicon glyphicon-trash"></span> &iquest;Eliminar imagen?
                    </a>
                @endif
                <br/>
                {!! Form::label('','Pie de foto',['class'=>'label label-default']) !!}
                {!! Form::text('footer_image',$producto->footer_image,['class'=>'form-control']) !!}
                <br/>
                {!! Form::textarea('description',$producto->description,['class'=>'form-control','placeholder'=>'Descripción']) !!}
                <br/>
                    <span class="btn btn-primary" data-toggle="modal" data-target="#addTypePRiceProduct">
                    <span class="glyphicon glyphicon-plus"></span> Añadir Tipo Acabado</span>
                <span class="btn btn-info"
                      title="Aqui añadiremos los tipos de acabado de cada producto (1 cara, 2 caras, simple, compuesto...) que despues asociaremos con su precio"
                      data-toggle="tooltip" data-placement="right">
                    <span class="glyphicon glyphicon-question-sign"></span>
                </span>
                <br/>
                @if(count($typePrice)>0)
                    {!! Form::label('','Precios',['class'=>'label label-default']) !!}
                    @foreach($typePrice as $type)
                        <table class="table table-responsive todosBordes">
                            <tr>
                                <th class="bordeDerecha">Uds</th>
                                <th>{{$type->nameTypePrice}}
                                    &nbsp;
                                    <span title="Editar Nombre del Acabado" data-toggle="tooltip" data-placement="left">
                                    <span class="btn btn-success btn-sm editNameTypePriceProduct" data-toggle="modal" data-target="#editNameTypePRiceProduct"
                                          data-name="{{$type->nameTypePrice}}" data-id="{{$type->id}}">
                                        <span class="glyphicon glyphicon-pencil"></span>
                                    </span>
                                        </span>
                                    &nbsp;
                                    <span title="Borrar Acabado" data-toggle="tooltip" data-placement="right">
                                    <span class="btn btn-danger btn-sm deleteTypePriceProduct" data-toggle="modal" data-target="#deleteTypePriceProduct" data-id="{{$type->id}}"><span
                                                class="glyphicon glyphicon-trash"></span>
                                    </span>
                                    </span>
                                </th>
                                <th>Opciones</th>
                            </tr>
                            @foreach($type->prices as $price)
                                <tr>
                                    <td>
                                        {{$price->count}}
                                    </td>
                                    <td>
                                        {{$price->price}}
                                    </td>
                                    <td class="text-right">
                                        <span title="Editar Precio" data-toggle="tooltip" data-placement="left">
                                            <span class="btn btn-default editPriceProduct" data-toggle="modal"
                                                  data-target="#editPRiceProduct"
                                                  data-id="{{$price->id}}" data-price="{{$price->price}}"
                                                  data-count="{{$price->count}}"
                                                  data-type="{{$price->idTypePriceProduct}}">
                                            <span class="glyphicon glyphicon-pencil"></span>
                                            </span>
                                        </span>
                                        &nbsp;
                                        <span title="Borrar Precio" data-toggle="tooltip" data-placement="right">
                                        <span class="btn btn-danger deletePriceProduct" data-toggle="modal"
                                              data-target="#deletePrice" data-id="{{$price->id}}">
                                            <span class="glyphicon glyphicon-trash"></span>
                                        </span>
                                            </span>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    @endforeach
                    @else
                    <div>
                        <br/>
                    <h4><span class="label label-default label-lg">No se han añadido precios aún.</span></h4>
                    </div>
                @endif
<br/>
                @if(count($typePrice)>0)
                <span class="btn btn-primary" data-toggle="modal" data-target="#addPRiceProduct">
                    <span class="glyphicon glyphicon-plus"></span> Añadir Precios</span>
                @endif
                {{Form::submit('Enviar',['class'=>'btn btn-primary center-block'])}}
                {{Form::close()}}
            </fieldset>
            <br/>
        </div>
    </div>

    <!-- add price product -->
    <div class="modal fade" id="addPRiceProduct" tabindex="-1" role="dialog" aria-labelledby="addPRiceProduct">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Añadir Precio</h4>
                </div>
                <div class="modal-body">
                    {!! Form::label('','Tipo') !!}
                    {!! Form::select('type',$tipoSelect,null,['class'=>'form-control','placeholder'=>'Tipo','required'=>'required','id'=>'newType']) !!}
                    {!! Form::label('','Unidades') !!}
                    {!! Form::text('uds',null,['class'=>'form-control','placeholder'=>'Unidades','required'=>'required','id'=>'newCount']) !!}
                    {!! Form::label('','Precio') !!}
                    {!! Form::number('price',null,['class'=>'form-control','placeholder'=>'Precio','required'=>'required','id'=>'newPrice']) !!}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="savePrice">Añadir</button>
                </div>
            </div>
        </div>
    </div>

    <!-- add type price product-->
    <div class="modal fade" id="addTypePRiceProduct" tabindex="-1" role="dialog" aria-labelledby="addTypePRiceProduct">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Añadir Acabado</h4>
                </div>
                <div class="modal-body">
                    {!! Form::label('','Nombre') !!}
                    {!! Form::text('nameTypePriceProduct',null,['class'=>'form-control','placeholder'=>'Nombre acabado','required'=>'required','id'=>'nameTypePriceProduct']) !!}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="saveType">Añadir</button>
                </div>
            </div>
        </div>
    </div>

    <!-- edit price -->
    <div class="modal fade" id="editPRiceProduct" tabindex="-1" role="dialog" aria-labelledby="editPRiceProduct">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Editar Precio</h4>
                </div>
                <div class="modal-body">
                    {!! Form::label('','Tipo') !!}
                    {!! Form::select('type',$tipoSelect,null,['class'=>'form-control','placeholder'=>'Tipo','required'=>'required','id'=>'editType']) !!}
                    {!! Form::label('','Unidades') !!}
                    {!! Form::text('uds',null,['class'=>'form-control','placeholder'=>'Unidades','required'=>'required','id'=>'editCount']) !!}
                    {!! Form::label('','Precio') !!}
                    {!! Form::number('price',null,['class'=>'form-control','placeholder'=>'Precio','required'=>'required','id'=>'editPrice']) !!}
                    {!! Form::hidden('idProductPriceEdit',null,['id'=>'idProductPriceEdit']) !!}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="updatePrice">Actualizar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- delete price -->
    <div class="modal fade" id="deletePrice" tabindex="-1" role="dialog" aria-labelledby="deletePrice">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">¿Eliminar precio?</h4>
                </div>
                <div class="modal-body text-center">
                    <span class="glyphicon glyphicon-trash"></span>
                    ¿Eliminar <span id="dataPrice"></span>?
                    <br/>
                    <br/>
                    <span class="btn btn-danger" data-toggle="tooltip" data-placement="bottom"
                          title="No eliminar y cerrar esta ventana" id="closedeletePrice">
                        <span class="glyphicon glyphicon-remove"></span>
                    </span>
                    &nbsp;
                    <span class="btn btn-success" data-toggle="tooltip" data-placement="bottom" title="Si"
                          id="confirmDeletePrice">
                        <span class="glyphicon glyphicon-ok"></span>
                    </span>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    {!! Form::hidden('idPriceDelete',null,['id'=>'idPriceDelete']) !!}

            <!-- edit name type price product-->
    <div class="modal fade" id="editNameTypePRiceProduct" tabindex="-1" role="dialog" aria-labelledby="editNameTypePRiceProduct">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Editar nombre del acabado</h4>
                </div>
                <div class="modal-body">
                    {!! Form::label('','Nombre') !!}
                    {!! Form::text('editNameTypePriceProduct',null,['class'=>'form-control','placeholder'=>'Nombre acabado','required'=>'required','id'=>'editNameTypePriceProduct']) !!}
                    {!! Form::hidden('idTypePRiceProduct',null,['id'=>'idTypePRiceProduct']) !!}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="saveNameTypePriceProduct">Actualizar</button>
                </div>
            </div>
        </div>
    </div>


    <!-- delete type Price product -->
    <div class="modal fade" id="deleteTypePriceProduct" tabindex="-1" role="dialog" aria-labelledby="deleteTypePriceProduct">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">¿Eliminar acabado?</h4>
                </div>
                <div class="modal-body text-center">
                    <span class="glyphicon glyphicon-trash"></span>
                    ¿Eliminar <span id="nameTypePriceProduct"></span>?
                    <br/>
                    <h4 class="">Este proceso borrara todos los precios asociados a este acabado</h4>
                    <br/>
                    <span class="btn btn-danger" data-toggle="tooltip" data-placement="bottom"
                          title="No eliminar y cerrar esta ventana" id="closeEditNameTypePriceProduct">
                        <span class="glyphicon glyphicon-remove"></span>
                    </span>
                    &nbsp;
                    <span class="btn btn-success" data-toggle="tooltip" data-placement="bottom" title="Si"
                          id="confirmDeletetypePriceProduct">
                        <span class="glyphicon glyphicon-ok"></span>
                    </span>
                    {!! Form::hidden('idTypePriceProductDelete',null,['id'=>'idTypePriceProductDelete']) !!}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <script src="{!! asset('js/editarProductoId.js') !!}" type="text/javascript"></script>
@endsection

