@extends('template')
@section('title')
    {{$title}}
    @endsection
@section('content')
    <div class="breadcrumbs">
        <ol class="breadcrumb">
            <li>
                <a href="{{url('/')}}">Inicio</a>
                <span class="glyphicon glyphicon-chevron-right"></span>
                Pedido Finalizado
            </li>
        </ol>
    </div>

    <div class="col-lg-8 col-lg-offset-2 alert alert-success">
        <h2 class="text-center">Pedido registrado</h2>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <br/>
    </div>
    <div class="col-lg-8 col-lg-offset-2">
        <p>Compruebe su correo.</p>

        <br/><br/>
    </div>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <br/>
    </div>
@endsection