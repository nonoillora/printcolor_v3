@extends('administracion/adminTemplate')
@section('titleAdmin')
    {{$title}}
@endsection
@section('adminContent')
    <div class="breadcrumb">
        <a href="{{url('admin')}}">Administraci&oacute;n</a> <span class="glyphicon glyphicon-chevron-right"></span>
        <a href="{{url('admin/categoria')}}">Categoría</a> <span class="glyphicon glyphicon-chevron-right"></span> <a href="{{url('admin/categoria/editar')}}">Editar Categoría</a>
        <div class="pull-right">
            @include('administracion/notificacionBreadcrumb')
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="list-group">
                @foreach($categories as $categoria)
                    <div class="list-group-item">
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                <img src="{{asset('storage/app/public/categoria/'.$categoria->image)}}"
                                     class="img-responsive" width="25%" height="25%"/>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                {{$categoria->name}}
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <a href="{{url('admin/categoria/editar/'.$categoria->id)}}"class="btn btn-primary center-block">
                                    <span class="glyphicon glyphicon-pencil"></span>&nbsp; Editar
                                </a>
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
@endsection