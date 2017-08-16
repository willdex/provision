@extends('layouts.inicio')
@section('contenido')
@include('alerts.errors')

<div class="row">	
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <font size="6">PAGOS</font>
        </div> 
    </div>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                <th><CENTER>CARNET</CENTER></th>
                <th><CENTER>CLIENTE</CENTER></th>
                <th><CENTER>CELULAR</CENTER></th>
                <th><CENTER>NRO LOTE</CENTER></th>
                <th><CENTER>MANZANO</CENTER></th>
                <th><CENTER>SUPERFICIE</CENTER></th>
                <th><CENTER>PROYECTO</CENTER></th>
                <th><CENTER>CATEGORIA</CENTER></th>
                <th><CENTER>FECHA</CENTER></th>
                <th><CENTER>DEBE</CENTER></th>
                <th><CENTER>CUOTA</CENTER></th>
                </thead>
                @foreach ($informacion as $inf)
                <TR>
                <td align=center>{{$inf->ci_cliente}}</td>
                <td align=center>{{$inf->cliente}}</td>
                <td align=center>{{$inf->celular}}</td>
                <td align=center>{{$inf->nroLote}}</td>
                <td align=center>{{$inf->manzano}}</td>
                <td align=center>{{$inf->superficie}} km²</td>
                <td align=center>{{$inf->nombre}}</td>
                <td align=center>{{$inf->categoria}}</td>
                <td align=center>{{$inf->fecha}}</td>
                <?php 
                  $monto=DB::select("SELECT (SUM(planpago.cuota)-(SELECT IFNULL(SUM(pago.monto),0) as monto FROM pago WHERE pago.idVenta=".$inf->id."))AS cuota FROM planpago WHERE planpago.idVenta=".$inf->id);
                  $cantidad=DB::select("SELECT COUNT(*)as contador FROM planpago WHERE planpago.estado='D' AND planpago.idVenta=".$inf->id);  
                ?>
                @endforeach 
                <td align=center>{{$monto[0]->cuota}}</td>
                <td align=center>{{$cantidad[0]->contador}} CUOTA</td>


                </TR>
            </table>

            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                <th><CENTER>ID</CENTER></th>
                <th><CENTER>MONTO</CENTER></th>
                <th><CENTER>FECHA</CENTER></th>
                <th><CENTER>ID VENTA</CENTER></th>
                </thead>
                @foreach ($pago as $pag)
                <TR>
                <td align=center>{{$pag->id}}</td>
                <td align=center>{{$pag->monto}}</td>
                <td align=center>{{$pag->fecha}}</td>
                <td align=center>{{$pag->idVenta}}</td>
                </TR>
                @endforeach 
            </table>
        </div>
    </div>
</div>
@endsection