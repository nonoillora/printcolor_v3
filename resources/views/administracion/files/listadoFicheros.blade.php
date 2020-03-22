@extends('administracion.adminTemplate')
@section('titleAdmin')
    {{$title}}
@endsection
@section('adminContent')
    <div class="breadcrumb">
        <a href="{{url('admin')}}">Administraci&oacute;n</a> <span class="glyphicon glyphicon-chevron-right"></span> <a
                href="{{url('admin/ficheros')}}">Ficheros</a>

        <div class="pull-right">
            @include('administracion/notificacionBreadcrumb')
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation"><a href="#categorias" aria-controls="categorias" role="tab"
                                           data-toggle="tab">Categorias</a></li>
                <li role="presentation"><a href="#productos" aria-controls="productos" role="tab" data-toggle="tab">Productos</a>
                </li>
                <li role="presentation" class="active"><a href="#ofertas" aria-controls="ofertas" role="tab"
                                                          data-toggle="tab">Ofertas</a>
                </li>
                <li role="presentation"><a href="#facturas" aria-controls="facturas" role="tab"
                                                          data-toggle="tab">Facturas</a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane" id="categorias">
                    @foreach($categories as $file)
                        <div class="col-sm-6 col-md-3 col-lg-4">
                            <div class="thumbnail">
                                <img src="{{url('getFile/categoria',explode('/',$file)[2])}}"
                                     class="img-responsive img-rounded">
                                <div class="caption">
                                    <h3 style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{explode('/',$file)[2]}}</h3>
                                    <p class="text-center hidden">
                                        <a href="#" class="btn btn-danger" role="button"><span
                                                    class="glyphicon glyphicon-trash"></span> </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        @if($loop->iteration%3==0)
                            <div class="clearfix"></div>
                        @endif
                    @endforeach
                </div>
                <div role="tabpanel" class="tab-pane" id="productos">
                    @foreach($products as $file)
                        <div class="col-sm-6 col-md-3 col-lg-4">
                            <div class="thumbnail">
                                <img src="{{url('getFile/productos',explode('/',$file)[2])}}"
                                     class="img-responsive img-rounded">
                                <div class="caption">
                                    <h3 style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{explode('/',$file)[2]}}</h3>
                                    <p class="text-center hidden">
                                        <a href="#" class="btn btn-danger" role="button"><span
                                                    class="glyphicon glyphicon-trash"></span> </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        @if($loop->iteration%3==0)
                            <div class="clearfix"></div>
                        @endif
                    @endforeach
                </div>
                <div role="tabpanel" class="tab-pane active" id="ofertas">
                    <br/>
                    @foreach($offers as $file)
                        <div class="col-sm-6 col-md-3 col-lg-4">
                            <div class="thumbnail text-center">
                                <img src="{{url('getFile/oferta',explode('/',$file)[2])}}"
                                class="img-responsive img-rounded">
                                <div class="caption">
                                    <h3 style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{explode('/',$file)[2]}}</h3>
                                    <p class="text-center hidden">
                                        <a href="#" class="btn btn-danger" role="button"><span
                                                    class="glyphicon glyphicon-trash"></span> </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        @if($loop->iteration%3==0)
                            <div class="clearfix"></div>
                        @endif
                    @endforeach
                </div>
                <div role="tabpanel" class="tab-pane" id="facturas">
                    <br/>
                    @foreach($bills as $file)
                        <div class="col-sm-6 col-md-3 col-lg-4">
                            <div class="thumbnail text-center">
                                <a href="{{url('getFile/factura',$file->url)}}
                                        "><span class="btn btn-info">
                                <span class="fa fa-file-pdf-o fa-5x"></span>
                                    </span>
                                </a>
                                <div class="caption">
                                    <h3 style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{explode('/',$file->file)[count(explode('/',$file->file))-1]}}</h3>
                                    <p class="text-center hidden">
                                        <a href="#" class="btn btn-danger" role="button"><span
                                                    class="glyphicon glyphicon-trash"></span> </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        @if($loop->iteration%3==0)
                            <div class="clearfix"></div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $('#myTabs a').click(function (e) {
            e.preventDefault()
            $(this).tab('show')
        })
    </script>
@endsection