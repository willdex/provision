@extends('layouts.inicio')
@section('contenido')
@include('alerts.errors')
@include('alerts.success')
@include('banco.modal')
    
<div class="row">	
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <font size="6">BANCO</font>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 pull-right">
            <div class="pull-right">
                <a class="btn btn-success" href="{!!URL::to('Banco/create')!!}"><i class="fa fa-plus-circle" aria-hidden="true"></i></a> 
            </div>
        </div>    
    </div>

	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
		<table class="table table-striped table-bordered table-condensed table-hover">
			<thead>
			<th><CENTER>NOMBRE</CENTER></th>
			<th><CENTER>OPERACIÓN</CENTER></th>
			</thead>
			 @foreach ($banco as $des)
			<TR>
			<td><CENTER>{{$des->nombre}}</CENTER></td>
			
			<td><CENTER>

             <a href="Banco/{{$des->id}}/edit" class="btn btn-primary"><i class="fa fa-pencil" aria-hidden="true" title="MODIFICAR"></i></a>
           <button data-toggle='modal' data-target='#myModalEliminar' onclick="EliminarBanco({{$des->id}})" class="btn btn-danger" title="ELIMINAR"><i class="fa fa-trash-o" aria-hidden="true"> </i></button>
	
             <a href="CuentaBanco/{{$des->id}}" class="btn btn-warning"><i class="fa fa-cogs" aria-hidden="true" title="ADMINISTRAR NRO. DE CUENTAS"></i></a>
 
			</CENTER></td>
		    </TR>
			@endforeach 
		</table>
		{!!$banco->render()!!}
		</div>
	</div>
</div>
@endsection