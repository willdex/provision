@extends('layouts.inicio')
@section('contenido')
@include('alerts.errors')

<div class="row">   
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <font size="6">PORCENTAJE DEVOLUCION</font>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 pull-right">
            <div class="pull-right">
                <a class="btn btn-success" href="{!!URL::to('PorcentajeDevolucionReserva/create')!!}">REGISTRAR</a> 
            </div>
        </div>    
    </div>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                <th><CENTER>PORCENTAJE</CENTER></th>
                <th><CENTER>PROYECTO</CENTER></th>
                </thead>
                @foreach ($porcentaje as $cli)
                <TR>
                <td><CENTER>{{$cli->porcentaje}}</CENTER></td>
                <td><CENTER>{{$cli->nombre}}</CENTER></td>
                </TR>
                @endforeach 
            </table>
        </div>
    </div>
</div>

@endsection