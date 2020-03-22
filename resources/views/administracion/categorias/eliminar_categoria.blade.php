@extends('administracion/adminTemplate')
@section('titleAdmin')
    {{$title}}
@endsection
@section('adminContent')
    <div class="breadcrumb">
        <a href="{{url('admin')}}">Administraci&oacute;n</a> <span class="glyphicon glyphicon-chevron-right"></span>
        <a href="{{url('admin/categoria')}}">Categoría</a> <span class="glyphicon glyphicon-chevron-right"></span> <a href="{{url('admin/categoria/borrar')}}">Borrar Categoría</a>
        <div class="pull-right">
            @include('administracion/notificacionBreadcrumb')
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            @if(Session::has('failCategory'))
            <div class="alert alert-danger">
                <b>{{Session::get('failCategory')}}</b>
            </div>
            @endif
            @if(Session::has('successCategory'))
            <div class="alert alert-success">
                <b>{{Session::get('successCategory')}}</b>
            </div>
            @endif
            <div class="list-group">
                @foreach($categories as $category)
                    <div class="list-group-item">
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                @if(empty($category->image))
                                    <img src="{{asset('storage/app/public/image_not_found.jpg')}}"
                                         class="img-responsive img-rounded">
                                @else
                                    <img src="{{asset('storage/app/public/categoria/'.$category->image)}}"
                                         class="img-responsive" width="25%" height="25%"/>
                                @endif

                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                {{$category->name}}
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <span data-id="{{$category->id}}" class="btn btn-danger center-block deleteCategory"
                                      data-toggle="modal" data-target="#deleteCategory" data-name="{{$category->name}}">
                                    <span class="glyphicon glyphicon-trash"></span>&nbsp; Borrar
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="text-center">
                    {!! $categories->links() !!}
                </div>
            </div>
        </div>
    </div>

    <!-- delete type Price product -->
    <div class="modal fade" id="deleteCategory" tabindex="-1" role="dialog" aria-labelledby="deleteCategory">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Eliminar Categoría</h4>
                </div>
                <div class="modal-body text-center">
                    <span class="glyphicon glyphicon-trash"></span>
                    ¿Eliminar <span id="nameCategory"></span>?
                    <br/>
                    <br/>
                    <span class="btn btn-danger" data-toggle="tooltip" data-placement="bottom"
                          title="No eliminar y cerrar esta ventana" id="closeDeleteCategory">
                        <span class="glyphicon glyphicon-remove"></span>
                    </span>
                    &nbsp;
                    <span class="btn btn-success" data-toggle="tooltip" data-placement="bottom" title="Si"
                          id="confirmDeleteCategory">
                        <span class="glyphicon glyphicon-ok"></span>
                    </span>
                    {!! Form::hidden('idCategoria',null,['id'=>'idCategory']) !!}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{asset('js/borrarCategoria.js')}}"></script>
@endsection
