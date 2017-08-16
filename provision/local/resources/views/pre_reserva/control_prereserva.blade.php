@extends('layouts.inicio')
@section('contenido')
@include('alerts.errors')

<div class="row">   
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <font size="6">LISTA DE PRE-RESERVAS ACTIVAS</font>

        
    </div>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                <th><CENTER>URBANIZACION</CENTER></th>
                <th><CENTER>FASE</CENTER></th>
                <th><CENTER>CATEGORIA</CENTER></th>
                <th><CENTER>MANZANO</CENTER></th>
                <th><CENTER>LOTE</CENTER></th>
                <th><CENTER>CLIENTE</CENTER></th>
                <th><CENTER>CARNET</CENTER></th>

                <th><CENTER>REGISTRO</CENTER></th>
                <th><CENTER>VENCIMIENTO</CENTER></th>

                </thead>
                @foreach ($lista as $lis)
                <TR>
                <td align="CENTER">{{$lis->nombre}}</td>
                <td align="CENTER">{{$lis->fase}}</td>
                <td align="CENTER">{{$lis->categoria}}</td>
                <td align="CENTER">{{$lis->manzano}}</td>
                <td align="CENTER">{{$lis->nroLote}}</td>
                <td align="CENTER">{{$lis->cliente}}</td>

                <td align="CENTER">{{$lis->ci_cliente}}</td>
                <td align="CENTER">{{$lis->fecha}}</td>
                <td align="CENTER">{{$lis->vencimiento}}</td>
              
                </TR>
                @endforeach 
            </table>
           
        </div>
    </div>
</div>

    @endsection