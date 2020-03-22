<li class="list-group-item" id="empresa{{$empresa->idCompany}}">
    <span id="name{{$empresa->idCompany}}">{{$empresa->name_company}}</span>&nbsp;
    <span class="glyphicon glyphicon-chevron-down" data-toggle="collapse"
          data-target="#collapseExample{{$empresa->idCompany}}"
          aria-expanded="false" aria-controls="collapseExample">
        </span>
    <span class="pull-right">
        <span class="borrarEmpresa" idEmpresa="{{$empresa->idCompany}}">
        <span class="glyphicon glyphicon-trash"></span> Borrar empresa
            </span>
    </span>

    <div class="collapse" id="collapseExample{{$empresa->idCompany}}">
        <div class="hidden alert alert-success" id="infoEmpresa{{$empresa->idCompany}}">
            <b>Empresa actualizada</b>
        </div>
        <div class="well">
            {!! Form::open(['method'=>'POST','url'=>'updateCompanyShipping']) !!}
            {!! Form::label('','Nombre de la empresa') !!}
            {!! Form::text('name_company',$empresa->name_company,['class'=>'form-control','id'=>'name_company'.$empresa->idCompany]) !!}
            <div class="hidden alert alert-danger info" id="name_company_info">Campo requerido</div>
            {!! Form::label('','Dirección') !!}
            {!! Form::text('address',$empresa->address,['class'=>'form-control','id'=>'address'.$empresa->idCompany]) !!}
            <div class="hidden alert alert-danger info" id="address_info">Campo requerido</div>
            {!! Form::label('','Teléfono') !!}
            {!! Form::text('phone',$empresa->phone,['class'=>'form-control','id'=>'phone'.$empresa->idCompany]) !!}
            <div class="hidden alert alert-danger info" id="phone_info">Campo requerido</div>
            {!! Form::label('','Direccion Web') !!}
            {!! Form::text('url_company',$empresa->url_company,['class'=>'form-control','id'=>'url_company'.$empresa->idCompany]) !!}
            <div class="hidden alert alert-danger info" id="url_company_info">Campo requerido</div>
            {!! Form::label('','Direccion Web para seguimiento') !!}
            {!! Form::text('url_follow_package',$empresa->url_follow_package,['class'=>'form-control','id'=>'url_follow_package'.$empresa->idCompany]) !!}
            {!! Form::hidden('idCompany',$empresa->idCompany) !!}
            <br/>
            {!! Form::button('Actualizar '.$empresa->name_company,['class'=>'btn btn-success btn-block actualizarEmpresa','idcompany'=>$empresa->idCompany]) !!}
            {!! Form::close() !!}
        </div>
    </div>
</li>