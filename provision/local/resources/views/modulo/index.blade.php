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
            <font size="6">MODULO</font>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 pull-right">
            <div class="pull-right">
                <a class="btn btn-success" href="{!!URL::to('Modulo/create')!!}">REGISTRAR</a> 
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
	
                <th><CENTER>Operacion</CENTER></th>
		
		</thead>
		 @foreach ($modulo as $tra)
			<TR>
			<td><CENTER>{{$tra->id}}</CENTER></td>
			<td><CENTER>{{$tra->nombre}}</CENTER></td>


			
			
                
			
			<td><CENTER>

         {!!link_to_route('Modulo.edit', $title = 'Editar', $parameters = $tra->id, $attributes = ['class'=>'btn btn-primary'])!!}

			</CENTER></td>
		</TR>
		@endforeach 
		</table>
	{!!$modulo->render()!!}
	</div>
</div>
</div>
	@endsection