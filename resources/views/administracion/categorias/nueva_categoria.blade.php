@extends('administracion/adminTemplate')
@section('titleAdmin')
    {{$title}}
@endsection
@section('adminContent')
    <div class="breadcrumb">
        <a href="{{url('admin')}}">Administraci&oacute;n</a> <span class="glyphicon glyphicon-chevron-right"></span>
        <a href="{{url('admin/categoria')}}">Categoría</a> <span class="glyphicon glyphicon-chevron-right"></span> <a href="{{url('admin/categoria/nueva')}}">Nueva Categoría</a>
        <div class="pull-right">
            @include('administracion/notificacionBreadcrumb')
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            @if(Session::has('successNewCategory'))
                <div class="alert alert-success">
                    <b>{{Session::get('successNewCategory')}}</b>
                </div>
            @endif
            <fieldset>
                <legend>Nueva categor&iacute;a</legend>

                {!! Form::open(['url' => 'admin/categoria/savenewcat', 'method' => 'post','files'=>true,'class'=>'form']) !!}
                {!! Form::label('','Nombre',['class'=>'label label-default']) !!}
                {!! Form::text('nombre',null,['class'=>'form-control','placeholder'=>'Nombre','required'=>'required']) !!}
                <br/>
                {!! Form::label('','Nombre Breve (solo visible en version sm y xs)',['class'=>'label label-default']) !!}
                {!! Form::text('nombreBreve',null,['class'=>'form-control','placeholder'=>'Nombre Breve','required'=>'required']) !!}
                <br/>
                {!! Form::label('Imagen','Imagen',['class'=>'label label-default']) !!}
                <br/>
                <label class="btn btn-primary btn-file btn-block">
                    Buscar
                    Fichero {!! Form::file('cover',['class'=>'btn btn-primary btn-block','required'=>'required','style'=>'display:none']) !!}
                </label>
                <br/>
                {{Form::submit('Enviar',['class'=>'btn btn-primary center-block'])}}
                {{Form::close()}}
            </fieldset>
        </div>
    </div>
@endsection