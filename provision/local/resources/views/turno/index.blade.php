@extends('layouts.inicio')
	
	@section('contenido')
        @if(Session::has('message'))
<div class="alert alert-success alert-dismissible" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	{{Session::get('message')}}
</div>
@endif
 @include('alerts.errors')
  
             <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <font size="6">Gestionar Turno</font>
        </div>


        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 pull-right">
            <div class="pull-right">
                <a class="btn btn-success" href="{!!URL::to('Turno/create')!!}"><i class="fa fa-plus-square" aria-hidden="true"></i></a> 
            </div>
        </div>    
    </div>  
  <div class="row">	
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

	<div class="table-responsive">
		
		<table class="table table-striped table-bordered table-condensed table-hover">
		<thead>
		<th><CENTER>ID</CENTER></th>
		<th><CENTER>Nombre</CENTER></th>
		<th><CENTER>Minutos Tolerancia</CENTER></th>

	
                <th><CENTER>Operacion</CENTER></th>
		
		</thead>
		<tbody id="listar">
		 @foreach ($Turno as $tra)
			<TR>
			<td><CENTER>{{$tra->id}}</CENTER></td>
			<td><CENTER>{{$tra->nombre}}</CENTER></td>
			<td><CENTER>{{$tra->minutosTolerancia}}</CENTER></td>
			<td><CENTER>

       <a href="Turno/{{$tra->id}}/edit" class="btn btn-primary" title="Modificar"><i class="fa fa-pencil" aria-hidden="true" ></i></a>
         <button title="ELIMINAR" class="btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></button>


			</CENTER></td>
		</TR>
		@endforeach 
		</tbody>
		</table>
	{!!$Turno->render()!!}
	</div>
</div>
</div>
	@endsection