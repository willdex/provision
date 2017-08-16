@extends('layouts.inicio')
@section('contenido')
@include('alerts.request')
<div class="row">
{!!Form::open(['route'=>'DevolucionReserva.store', 'method'=>'POST'])!!}
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
      <div class="panel panel-success">
        <div class="panel-heading"><b>DATOS DEL CLIENTE</b></div>        
        <div class="panel-body">
            <div class="col-sm-2">
			{!!Form::label('Carnet:')!!}
			{!!Form::text('ci',$datos[0]->ci,['class'=>'form-control ','disabled'])!!}
			{!!Form::hidden('idCliente',$datos[0]->idCliente,['class'=>'form-control'])!!}
            </div>        
            <div class="col-sm-10">
			{!!Form::label('Cliente:')!!}
			{!!Form::text('cliente',$datos[0]->nombre.' '.$datos[0]->apellidos,['class'=>'form-control ','disabled'])!!}
            </div>                                                    
        </div>
      </div>   
    </div>   


<?php $porcentaje=DB::select("SELECT *FROM porcentajedevolucionreserva WHERE porcentajedevolucionreserva.deleted_at IS NULL AND porcentajedevolucionreserva.idProyecto=".Session::get('idProyecto')); 
$monto = $datos[0]->subTotal*($porcentaje[0]->porcentaje / 100);
?>  
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
      <div class="panel panel-success">
        <div class="panel-heading"><b>DEVOLUCION DEL DINERO</b></div>        
        <div class="panel-body">
            <div class="col-sm-3">          
			{!!Form::label('Monto de Reserva:')!!}
			<center><font size="5">{{$datos[0]->subTotal}}</font></center>			
            </div>   
            <div class="col-sm-4">          
			{!!Form::label('Porcentaje de Devolución:')!!}
			<center><font size="5">{{$porcentaje[0]->porcentaje}} %</font></center>
			{!!Form::hidden('idPorcentajeDevolucion',$porcentaje[0]->id,['class'=>'form-control'])!!}
            </div>   
            <div class="col-sm-4">          
			{!!Form::label('Monto de Devolución:')!!}
			<center><font size="5">{{$monto}}</font></center>			
			{!!Form::hidden('monto',$monto,['class'=>'form-control'])!!}
            </div>                                                                              
        </div>
      </div>   
    </div>  

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="panel panel-success">
        <div class="panel-heading"><b>DATOS DEL PREVIO</b></div>        
        <div class="panel-body">
            <div class="col-sm-1">
            {!!Form::hidden('idLote',$datos[0]->idLote,['class'=>'form-control '])!!}
			{!!Form::label('Nro Lote:')!!}
			{!!Form::text('nroLote',$datos[0]->nroLote,['class'=>'form-control ','disabled'])!!}
			{!!Form::hidden('idDetalleReserva',$datos[0]->idDetalleReserva,['class'=>'form-control'])!!}
            </div>            
            <div class="col-sm-1">
			{!!Form::label('Manzano:')!!}
			{!!Form::text('manznao',$datos[0]->manzano,['class'=>'form-control ','disabled'])!!}
            </div>
            <div class="col-sm-1">
			{!!Form::label('Fase:')!!}
			{!!Form::text('fase','fase '.$datos[0]->fase,['class'=>'form-control ','disabled'])!!}
            </div>     
            <div class="col-sm-2">
			{!!Form::label('Categoria:')!!}
			{!!Form::text('categoria',$datos[0]->categoria,['class'=>'form-control ','disabled'])!!}
            </div>   
            <div class="col-sm-3">
			{!!Form::label('Detalle:')!!}
			{!!Form::text('descripcion',$datos[0]->descripcion,['class'=>'form-control ','disabled'])!!}
            </div>   
            <div class="col-sm-2">
			{!!Form::label('Proyecto:')!!}
			{!!Form::text('proyecto',$datos[0]->proyecto,['class'=>'form-control ','disabled'])!!}
            </div>                                         
        </div>
      </div>   
    </div>

    <div class="col-lg-12 col-md-12 col-sm-12  col-xs-12">		
	<div align="right">
		{!!Form::submit('DEVOLUCION',['class'=>'btn btn-primary','id'=>'btn_registrar','onclick'=>'btn_esconder()'])!!}		
		<a href="{!!URL::to('DevolucionReserva')!!}" class="btn btn-danger">CANCELAR</a>
	</div>		
	{!!Form::close()!!}
    </div>

</div>
@endsection