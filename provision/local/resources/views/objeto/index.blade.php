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
            <font size="6">GESTIONAR OBJETO</font>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 pull-right">
            <div class="pull-right">
                <a class="btn btn-success" href="{!!URL::to('Objeto/create')!!}">REGISTRAR</a> 
            </div>
        </div>    
    </div>  
  <div class="row">	
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

	<div class="table-responsive">
		
		<table class="table table-striped table-bordered table-condensed table-hover">
		<thead>
		<th><CENTER>Nombre</CENTER></th>
		<th><CENTER>Tipo Objeto</CENTER></th>

		<th><CENTER>HABILITADO</CENTER></th>
		
		<th><CENTER>Visible en Menu</CENTER></th>
		<th><CENTER>URL</CENTER></th>

	
                <th><CENTER>Operacion</CENTER></th>
		
		</thead>
		 @foreach ($objeto as $tra)
			<TR>
			<td><CENTER>{{$tra->nombre}}</CENTER></td>
			<td><CENTER>{{$tra->tipoObjeto}}</CENTER></td>
			<td><CENTER>{{$tra->estado}}</CENTER></td>

			<td><CENTER>{{$tra->visibleEnMenu}}</CENTER></td>
			<td><CENTER>{{$tra->urlObjeto}}</CENTER></td>
			
			<td><CENTER>

       <a href="Objeto/{{$tra->id}}/edit" class="btn btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i></a>
         <button title="ELIMINAR" class="btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
 
			</CENTER></td>
		</TR>
		@endforeach 
		</table>
	{!!$objeto->render()!!}
	</div>
</div>
</div>
	@endsection