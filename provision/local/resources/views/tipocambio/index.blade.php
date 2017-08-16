@extends('layouts.inicio')
@section('contenido')
@include('alerts.errors')
@include('alerts.success')

<div class="row">   
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <font size="6">TIPO DE CAMBIO</font>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 pull-right">
            <div class="pull-right">
                <a class="btn btn-success" href="{!!URL::to('TipoCambio/create')!!}">REGISTRAR</a> 
            </div>
        </div>    
    </div>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                <th><CENTER>MONEDA VENTA</CENTER></th>
                <th><CENTER>MONEDA COMPRA</CENTER></th>
                </thead>
                @foreach ($tipo_cambio as $tc)
                <TR>
                <td><CENTER>{{$tc->monedaVenta}}</CENTER></td>
                <td><CENTER>{{$tc->monedaCompra }}</CENTER></td>
                </TR>
                @endforeach 
            </table>
        </div>
    </div>
</div>

    @endsection