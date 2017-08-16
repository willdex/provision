@extends('layouts.inicio')
@section('contenido')
@include('alerts.errors')
@include('alerts.success')
<div class="row">   
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <font size="6">PRECIOS</font>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 pull-right">
            <div class="pull-right">
                <a class="btn btn-success" href="{!!URL::to('Precio/create')!!}">REGISTRAR</a> 
            </div>
        </div>    
    </div>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                <th><CENTER>PRECIO</CENTER></th>
                <th><CENTER>CATEGORIA</CENTER></th>
                <th><CENTER>PROYECTO</CENTER></th>
                </thead>
                @foreach ($precio as $cli)
                <TR>
                <td><CENTER>{{$cli->precio}}</CENTER></td>
                <td><CENTER>{{$cli->categoria}}</CENTER></td>
                <td><CENTER>{{$cli->nombre}}</CENTER></td>                
                
                </TR>
                @endforeach 
            </table>
        </div>
    </div>
</div>

    @endsection