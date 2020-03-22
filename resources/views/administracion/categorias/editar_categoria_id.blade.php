@extends('administracion/adminTemplate')
@section('titleAdmin')
    {{$title}}
@endsection
@section('adminContent')
    <div class="breadcrumb">
        <a href="{{url('admin/categoria')}}">Categoría</a> <span class="glyphicon glyphicon-chevron-right"></span> <a href="{{url('admin/categoria/editar')}}">Editar Categoría</a>
        <div class="pull-right">
            @include('administracion/notificacionBreadcrumb')
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            @if(Session::has('successEditCategory'))
                <div class="alert alert-success">
                    <b>{{Session::get('successEditCategory')}}</b>
                </div>
            @endif
            @if(Session::has('successDeleteImageCategory'))
                <div class="alert alert-success">
                    <b>{{Session::get('successDeleteImageCategory')}}</b>
                </div>
            @endif
            <fieldset>
                <legend>{{$categoria->name}} </legend>

                {!! Form::open(['url' => 'admin/categoria/saveeditcat', 'method' => 'post','files'=>true,'class'=>'form']) !!}
                {!!  Form::hidden('id',$categoria->id)!!}
                {!! Form::label('','Nombre',['class'=>'label label-default']) !!}
                {!! Form::text('nombre',$categoria->name,['class'=>'form-control','placeholder'=>'Nombre','required'=>'required']) !!}
                <br/>
                {!! Form::label('','Nombre Breve (solo visible en version sm y xs)',['class'=>'label label-default']) !!}
                {!! Form::text('nombreBreve',$categoria->name_xs,['class'=>'form-control','placeholder'=>'Nombre Breve','required'=>'required']) !!}
                <br/>
                {!! Form::label('Imagen','Imagen',['class'=>'label label-default']) !!}
                <br/>
                @if(empty($categoria->image))
                    <label class="btn btn-primary btn-file btn-block">
                        Buscar
                        Fichero {!! Form::file('cover',['class'=>'btn btn-primary btn-block','required'=>'required','style'=>'display:none']) !!}
                    </label>
                @else
                    <img src="{{asset('/storage/app/public/categoria/'.$categoria->image)}}"
                         class="img-responsive img-rounded center-block">
                    <a href="{{url('admin/categoria/remove/'.$categoria->id.'/'.$categoria->image)}}" class="btn btn-danger center-block">
                        <span class="glyphicon glyphicon-trash"></span> &iquest;Eliminar imagen?
                    </a>
                @endif
                <br/>
                {{Form::submit('Enviar',['class'=>'btn btn-primary center-block'])}}
                {{Form::close()}}
            </fieldset>
        </div>
    </div>
@endsection