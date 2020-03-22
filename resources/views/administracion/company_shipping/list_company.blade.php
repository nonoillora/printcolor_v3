@extends('administracion.adminTemplate')
@section('titleAdmin')
    {{$title}}
@endsection
@section('adminContent')
    <div class="breadcrumb">
        <a href="{{url('admin')}}">Administraci&oacute;n</a> <span class="glyphicon glyphicon-chevron-right"></span> <a
                href="{{url('admin/shipping')}}">Compañias de transporte</a>

        <div class="pull-right">
            @include('administracion/notificacionBreadcrumb')
        </div>
    </div>
    <div class="col-lg-9">
    </div>
    <div class="col-lg-3">
                <span class="btn btn-primary pull-right" data-toggle="modal" data-target=".bs-example-modal-lg"><span
                            class="glyphicon glyphicon-plus"></span> Añadir empresa</span>

    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <br/>
    </div>
    <div class="col-lg-12">
        <ul class="list-group">
            @each('administracion/company_shipping/components/companyShippingComponent',$empresas, 'empresa')
        </ul>
    </div>
    </div>
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="gridSystemModalLabel">Nueva empresa</h4>
                </div>
                <div class="modal-body">
                    {!! Form::open(['method'=>'POST','url'=>'']) !!}
                    {!! Form::label('','Nombre de la empresa') !!}
                    {!! Form::text('name_company',null,['class'=>'form-control','id'=>'name_company']) !!}
                    <div class="hidden alert alert-danger info" id="name_company_info">Campo requerido</div>
                    {!! Form::label('','Dirección') !!}
                    {!! Form::text('address',null,['class'=>'form-control','id'=>'address']) !!}
                    <div class="hidden alert alert-danger info" id="address_info">Campo requerido</div>
                    {!! Form::label('','Teléfono') !!}
                    {!! Form::text('phone',null,['class'=>'form-control','id'=>'phone']) !!}
                    <div class="hidden alert alert-danger info" id="phone_info">Campo requerido</div>
                    {!! Form::label('','Direccion Web') !!}
                    {!! Form::text('url_company',null,['class'=>'form-control','id'=>'url_company']) !!}
                    <div class="hidden alert alert-danger info" id="url_company_info">Campo requerido</div>
                    {!! Form::label('','Direccion Web para seguimiento') !!}
                    {!! Form::text('url_follow_package',null,['class'=>'form-control','id'=>'url_follow_package']) !!}
                    {!! Form::close() !!}
                    <div class="hidden alert alert-danger info" id="url_follow_package_info">Campo requerido</div>
                    <br/>
                    <span class="btn btn-warning" id="clearForm"><span class="glyphicon glyphicon-refresh"></span> Limpiar formulario</span>
                    &nbsp;
                    <span class="btn btn-success pull-right" id="saveEnterpriseShipping"><span
                                class="glyphicon glyphicon-floppy-save"></span> Guardar empresa </span>
                    <br/>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('js/enterpriseShipping.js')}}" type="text/javascript"></script>
    <style type="text/css">
        .info {
            font-weight: bold;
            margin-top: 10px;
        }
    </style>
@endsection