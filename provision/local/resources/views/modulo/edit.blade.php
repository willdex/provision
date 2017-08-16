@extends('layouts.inicio')
	@section('contenido')
<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">		
    @include('alerts.request')

	{!!Form::model($modulo,['route'=>['Modulo.update',$modulo->id],'method'=>'PUT'])!!}

	
		@include('modulo.forms.mod')
  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">		

	{!!Form::submit('Actualizar',['class'=>'btn btn-primary'])!!}
	{!!Form::close()!!}
	</div>
  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">		

	{!!Form::open(['route'=>['Modulo.destroy',$modulo->id],'method'=>'DELETE'])!!}
	{!!Form::submit('Eliminar',['class'=>'btn btn-danger'])!!}
	{!!Form::close()!!}
	</div>
	
</div>
@endsection

                     