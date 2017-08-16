@extends ('layouts.inicio')
@section ('contenido')
@if(Session::has('message'))
<div class="alert alert-success alert-dismissible" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	{{Session::get('message')}}
</div>
@endif
@include('alerts.request')
               
                <button class="btn btn-success" data-toggle='modal' data-target='#myModal'>
                    <i class="fa fa-plus-square" aria-hidden="true"></i>     
                </button>
               
		<div class="row">	
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">	
			<H1>EMPRESA</H1>
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th><center>ID</center></th>
						<th><center>NUMERO ASIENTO</center></th>
						<th><center>GLOSA</center></th>
						<th><center>FECHA</center></th>
						<th><center>TIPO DE CAMBIO</center></th>
					
						<th><center>CATEGORIA</center></th>
						<th><center>GESTION</center></th>
						<th><center>OPERACION</center></th>
					</thead>
					@foreach($lista_asiento as $l_a)
					<tr>
						<td><center>{{ $l_a->id}}</center></td>
						<td><center>{{ $l_a->nro_asiento}}</center></td>
						<td><center>{{ $l_a->glosa}}</center></td>
						<td><center>{{ $l_a->fecha}}</center></td>
						<td><center>{{ $l_a->cambio_tipo}}</center></td>
						<td><center>{{ $l_a->categoria}}</center></td>
						<td><center>{{ $l_a->nombre_gestion}}</center></td>
						<td><CENTER>
                                                    <button class="btn btn-primary">ACTUALIZAR</button>  
						</CENTER></td>
					</tr>
					@endforeach
				</table>
	
			</div>

		</div>
	</div>

@endsection
