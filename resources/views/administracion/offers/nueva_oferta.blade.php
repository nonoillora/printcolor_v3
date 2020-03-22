@extends('administracion/adminTemplate')
@section('titleAdmin')
    {{$title}}
@endsection
@section('adminContent')
    <div class="breadcrumb">
        <a href="{{url('admin')}}">Administraci&oacute;n</a> <span class="glyphicon glyphicon-chevron-right"></span> <a
                href="{{url('admin/ofertas/')}}">Ofertas</a> <span class="glyphicon glyphicon-chevron-right"></span> <a href="{{url('admin/ofertas/nueva')}}">Nueva Oferta</a>
        <div class="pull-right">
            @include('administracion/notificacionBreadcrumb')
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            @if(Session::has('successNewOferta'))
                <div class="alert alert-success">
                    <b>{{Session::get('successNewOferta')}}</b>
                </div>
            @endif
            <fieldset>
                <legend>Nueva Oferta</legend>
                {!! Form::open(['url' => 'admin/ofertas/savenewoffer', 'method' => 'post','files'=>true,'class'=>'form']) !!}
                {!! Form::hidden('idCategoria',$oferta) !!}
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
                {!! Form::textarea('descripcion',null,['class'=>'form-control','required'=>'required','min-length'=>'5']) !!}
                <br/>
                {{Form::submit('Enviar',['class'=>'btn btn-primary center-block'])}}
                {{Form::close()}}
            </fieldset>
        </div>
    </div>
@endsection