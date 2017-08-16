@extends('layouts.inicio')
@section('contenido')
@include('alerts.errors')
@include('alerts.success')

<div class="row">
{!! Form::open(['route' => 'ListaReserva/search', 'method' => 'post', 'novalidate', 'class' => 'form-inline']) !!}
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <font size="6">LISTA DE RESERVAS</font>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 pull-right"> 
            <div class="pull-right">
                <button  type="submit" class="btn btn-info"><i class="fa fa-search" aria-hidden="true"></i></button>
            </div>        
            <?php $fecha=DB::select("SELECT curdate()as fecha"); ?>
            <div class="pull-right"><input type="date" name="fecha_inicio" value="{{$fecha[0]->fecha}}" class="form-control"></div>
        </div>    
    </div>
{!!Form::close()!!}

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                <th><CENTER>CARNET</CENTER></th>
                <th><CENTER>CLIENTE</CENTER></th>                
                <th><CENTER>CATEGORIA</CENTER></th>
                <th><CENTER>NRO LOTE</CENTER></th>
                <th><CENTER>MANZANO</CENTER></th>
                <th><CENTER>SUPERFICIE</CENTER></th>
                <th><CENTER>PRECIO</CENTER></th>
                <th><CENTER>FECHA</CENTER></th>
                <th><CENTER>CARNET</CENTER></th>
                <th><CENTER>EMPLEADO</CENTER></th>
                <th><CENTER>OPCION</CENTER></th>
                </thead>
                @foreach ($lista as $lis)
                <TR>
                    <td align=center>{{$lis->ci_cliente}}</td>
                    <td align=center>{{$lis->cliente}}</td>                
                    <td align=center>{{$lis->categoria}}</td>
                    <td align=center>{{$lis->nroLote}}</td>
                    <td align=center>{{$lis->manzano}}</td>
                    <td align=center>{{$lis->superficie}}</td>
                    <td align=center>{{$lis->precio_superficie}}</td>
                    <td align=center>{{$lis->fecha}}</td>
                    <td align=center>{{$lis->ci_empleado}}</td>
                    <td align=center>{{$lis->empleado}}</td>
                    <td align=center>
                    <a href="DevolucionReserva" class="btn-sm btn-danger">DEVOLCION</a>
                    </td>
                </TR>
                @endforeach 
            </table>
        </div>
    </div>

</div>

    @endsection