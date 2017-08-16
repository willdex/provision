@extends ('layouts.inicio')
@section ('contenido')
@if(Session::has('message'))
<div class="alert alert-success alert-dismissible" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	{{Session::get('message')}}
</div>
@endif
@include('alerts.request')
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <font size="6">Gestionar Empresa</font>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 pull-right">
            <div class="pull-right">
                <a class="btn btn-success" href="{!!URL::to('Empresa/create')!!}"><i class="fa fa-plus-square" aria-hidden="true"></i></a> 
            </div>
        </div>    
    </div>  
               
               
		<div class="row">	
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">	
			
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th><center>Nombre</center></th>
						<th><center>Direccion</center></th>
						<th><center>Telefono</center></th>
						<th><center>Correo</center></th>
						<th><center>Operacion</center></th>
					</thead>
					@foreach($empresa as $ed)
					<tr>
						<td><center>{{ $ed->nombre}}</center></td>
						<td><center>{{ $ed->direccion}}</center></td>
						<td><center>{{ $ed->telefono}}</center></td>
						<td><center>{{ $ed->correo}}</center></td>
						<td><CENTER>
						{!!link_to_route('Empresa.edit', $title = 'Editar', $parameters = $ed->id, $attributes = ['class'=>'btn btn-primary'])!!}
						</CENTER></td>
					</tr>
					@endforeach
				</table>
	{!!$empresa->render()!!}
			</div>

		</div>
	</div>

@endsection
