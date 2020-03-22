@extends('administracion/adminTemplate')
@section('titleAdmin')
    {{$title}}
@endsection
@section('adminContent')
    <div class="breadcrumb">
        <a href="{{url('admin')}}">Administraci&oacute;n</a> <span class="glyphicon glyphicon-chevron-right"></span> <a
                href="{{url('admin/producto')}}">Producto</a> <span class="glyphicon glyphicon-chevron-right"></span> <a href="{{url('admin/producto/nuevo')}}">Nuevo Producto</a>
        <div class="pull-right">
            @include('administracion/notificacionBreadcrumb')
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            @if(Session::has('successNewProduct'))
                <div class="alert alert-success">
                    <b>{{Session::get('successNewProduct')}}</b>
                </div>
            @endif
            <fieldset>
                <legend>Nuevo Producto</legend>
                {!! Form::open(['url' => 'admin/producto/savenewprod', 'method' => 'post','files'=>true,'class'=>'form']) !!}
                {!! Form::label('','Categoria',['class'=>'label label-default']) !!}
                {!! Form::select('idCategoria',$categories->toArray(),null,['class'=>'form-control','required'=>'required','placeholder'=>'Seleccione una categoria']) !!}
                <br/>
                {!! Form::label('','Nombre',['class'=>'label label-default']) !!}
                {!! Form::text('nombre',null,['class'=>'form-control','placeholder'=>'Nombre','required'=>'required']) !!}
                <br/>
                {!! Form::label('','Imagen Exterior',['class'=>'label label-default']) !!}
                <br/>
                <label class="btn btn-primary btn-file btn-block">
                    Buscar
                    Fichero {!! Form::file('cover',['class'=>'btn btn-primary btn-block','required'=>'required','style'=>'display:none']) !!}
                </label>
                <br/>
                {!! Form::label('','Imagen Interior',['class'=>'label label-default']) !!}
                <br/>
                <label class="btn btn-primary btn-file btn-block">
                    Buscar
                    Fichero {!! Form::file('inside',['class'=>'btn btn-primary btn-block','required'=>'required','style'=>'display:none']) !!}
                </label>
                <br/>
                {!! Form::label('','Pie de foto',['class'=>'label label-default']) !!}
                {!! Form::text('footer_image',null,['class'=>'form-control']) !!}
                <br/>
                {!! Form::textarea('descripcion',null,['class'=>'form-control','required'=>'required','min-length'=>'5']) !!}
                <br/>
                {{Form::submit('Enviar',['class'=>'btn btn-primary center-block'])}}
                {{Form::close()}}
            </fieldset>
        </div>
    </div>

@endsection