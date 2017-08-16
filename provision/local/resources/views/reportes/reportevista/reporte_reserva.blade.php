@extends ('layouts.inicio')
@section ('contenido')
@include('alerts.request')
   
<div class="row">	
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
		{!! Form::open(['route' => 'ReporteReservaSearch', 'method' => 'post','onKeypress'=>'if(event.keyCode == 13) event.returnValue = false;','onsubmit'=>'javascript: return Validar_Reporte_Reserva()']) !!}
			<div class="pull-left"><font size=6>REPORTE DE RESERVAS</font></div>
			<div class="pull-right">
				<b>FECHA INICIO:</b> <input type="date" name="fecha_inicio" id="fecha_inicio" value="{{$fecha_inicio[0]->fecha}}">
				<b>FECHA FIN:</b> <input type="date" name="fecha_fin" id="fecha_fin" value="{{$fecha_fin[0]->fecha}}">
				<button type="submit" class="btn btn-primary" title="BUSCAR"><i class="fa fa-search" aria-hidden="true"></i></button>
				<button type="button" class="btn btn-success" title="PDF" onclick="ReporteReserva()"><i class="fa fa-file-text-o" aria-hidden="true"></i></button>
			</div>
		{!!Form::close()!!}
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th colspan="2"><center>VENDEDOR</center></th>
					<th><center>PROYECTO</center></th>
					<th><center>FASE</center></th>
					<th><center>CATEGORIA</center></th>
					<th><center>MANZANO</center></th>
					<th><center>LOTE</center></th>
					<th colspan="2"><center>CLIENTE</center></th>
					<th><center>REGISTRO</center></th>
					<th><center>VENCMIENTO</center></th>					
					<th><center>ESTADO</center></th>					
				</thead>
				<tbody align="center">
					@foreach($lista as $list)
					<tr>
						<td align="left">{{$list->empleado}}</td> <td align="left"><b>CI:</b> {{$list->ci_empleado}}</td>
						<td>{{$list->nombre}}</td>
						<td>Fase {{$list->fase}}</td>
						<td>{{$list->categoria}}</td>
						<td>{{$list->manzano}}</td>
						<td>{{$list->nroLote}}</td>
						<td align="left">{{$list->cliente}}</td> <td align="left"><b>CI:</b> {{$list->ci_cliente}}</td>
						<td>{{$list->fecha}}</td>
					<?php 
					switch ($list->estado) {
					    case 'v':
					        echo "<td> --- </td>";								
					        echo "<td style='background:#A9F5A9'> VENDIDO </td>";								
					        break;
					    case 'r':
					        echo "<td>".$list->vencimiento."</td>";													        
					        echo "<td style='background:#F2F5A9'> RESERVADO </td>";								
					        break;
					    case 'd':
					        echo "<td>".$list->vencimiento."</td>";													        
					        echo "<td style='background:#F6CED8'> VENCIDO </td>";								
					        break;
					}					
					?>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
{!!Html::script('js/reserva.js')!!}
@endsection
