@extends('layouts.inicio')
@section('contenido')
@include('alerts.errors')
@include('alerts.success')

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <font size="6">LISTA DE RESERVAS</font>
        </div>

{!! Form::open(['route' => 'ListaReservasearch', 'method' => 'post', 'novalidate', 'class' => 'form-inline']) !!}

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 pull-right"> 
            <div class="pull-right">
                <button  type="submit" class="btn btn-info"><i class="fa fa-search" aria-hidden="true"></i></button>
            </div>        
            <?php $fecha=DB::select("SELECT curdate()as fecha"); ?>
            <div class="pull-right"><input type="date" name="fecha_inicio" value="{{$fecha[0]->fecha}}" class="form-control"></div>
        </div>    
{!!Form::close()!!}

{!! Form::open(['route' => 'ListaReservasearchci', 'method' => 'post', 'novalidate', 'class' => 'form-inline']) !!}

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 pull-right"> 
            <div class="pull-right">
                <button  type="submit" class="btn btn-info"><i class="fa fa-search" aria-hidden="true"></i></button>
            </div>        
            <?php $fecha=DB::select("SELECT curdate()as fecha"); ?>
            <div class="pull-right">
            <label>C.I</label>
            <input type="number" name="ci" value="" class="form-control"></div>
        </div>    
{!!Form::close()!!}
    </div>


    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                <th><CENTER>CARNET</CENTER></th>
                <th><CENTER>CLIENTE</CENTER></th>                
                <th><CENTER>CATEGORIA</CENTER></th>
                <th><CENTER>NRO LOTE</CENTER></th>
                <th><CENTER>MANZANO</CENTER></th>
                <th><CENTER>FECHA</CENTER></th>
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
                  
                    <td align=center>{{$lis->fecha}}</td>
                    <td align=center>{{$lis->empleado}}</td>
                    <td align=center>
                    {!!link_to_route('DevolucionReserva.show', $title = 'DEVOLUCION', $parameters = $lis->idDetalleReserva, $attributes = ['class'=>'btn-sm btn-danger'])!!} 
                    <a class="btn-sm btn-primary" href=<?php echo "VentaReserva/".$lis->idDetalleReserva; ?> >vender</a>
                    </td>
                </TR>
                @endforeach 
            </table>
        </div>
    </div>

</div>

    @endsection