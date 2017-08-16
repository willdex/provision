@extends('layouts.inicio')
	
	@section('contenido')
        @if(Session::has('message'))
<div class="alert alert-success alert-dismissible" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	{{Session::get('message')}}
</div>
@endif
@include('alerts.request')
@include('alerts.cargando')
                @include('categoria.modal')
                 <button class="btn btn-success" data-toggle='modal' data-target='#myModal'>
                    <i class="fa fa-plus-square" aria-hidden="true"></i>     
                </button>
               
  <div class="row">	
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<div class="table-responsive">
		<H1>Categoria</H1>
		<table class="table table-striped table-bordered table-condensed table-hover">
		<thead>
                    <th><CENTER>HIJO</CENTER></th>
		<th><CENTER>EMPRESA</CENTER></th>
                
		<th><CENTER>CODIGO</CENTER></th>
		<th><CENTER>HIJO</CENTER></th>
		<th><CENTER>ESTADO</CENTER></th>
		<th><CENTER>UTILIZABLE</CENTER></th>
		
		
		
		</thead>
		 @foreach ($categoria as $cat)
			<TR>
			<td><CENTER>{{$cat->id}}</CENTER></td>
			<td><CENTER>{{$cat->nombre}}</CENTER></td>
		
			
			<td><CENTER>
			{!!link_to_route('categoria.edit', $title = 'Editar', $parameters = $cat, $attributes = ['class'=>'btn btn-primary'])!!}
			</CENTER></td>
		</TR>
		@endforeach 
		</table>
	{!!$categoria->render()!!}
	</div>
</div>
</div>
	@endsection