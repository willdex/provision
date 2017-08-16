@extends('layouts.inicio')

@section('contenido')
@if(Session::has('message'))
<div class="alert alert-success alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    {{Session::get('message')}}
</div>
@endif
@include('alerts.errors')
@include('cliente.modal')              
<button class="btn btn-success" data-toggle='modal' data-target='#myModal'>
    <i class="fa fa-plus-square" aria-hidden="true"></i>     
</button>

<div class="row">	
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="table-responsive">
            <H1>CLIENTE</H1>
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                <th><CENTER>Nombre</CENTER></th>
                <th><CENTER>Apellido</CENTER></th>
                <th><CENTER>Nro. CARNET</CENTER></th>
                <th><CENTER>NIT</CENTER></th>
                <th><CENTER>Dirección</CENTER></th>
                <th><CENTER>Celular</CENTER></th>
                <th><CENTER>Teléfono Adicional</CENTER></th>
                <th><CENTER>Operación</CENTER></th>
                </thead>
                @foreach ($cliente as $cli)
                <TR>
                    <td><CENTER>{{$cli->nombre}}</CENTER></td>
                <td><CENTER>{{$cli->apellido}}</CENTER></td>
                <td><CENTER>{{$cli->ci}}</CENTER></td>
                <td><CENTER>{{$cli->nit}}</CENTER></td>
                <td><CENTER>{{$cli->direccion}}</CENTER></td>
                <td><CENTER>{{$cli->celular}}</CENTER></td>
                <td><CENTER>{{$cli->telefono_adicional}}</CENTER></td>
                <td><CENTER>
                    <button class="btn btn-primary" data-toggle='modal' data-target='#myModalActualizar' onclick= "cargarModal({{$cli->id}})">ACTUALIZAR</button>
                </CENTER></td>
                </TR>
                @endforeach 
            </table>
            {!!$cliente->render()!!}
        </div>
    </div>
</div>

{!!Html::script('js/cliente.js')!!}
    @endsection