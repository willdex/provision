@extends('layouts.inicio')
	@section('contenido')
	<h3>ACTUALIZAR PERFIL</h3>
<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">		
    @include('alerts.request')

	{!!Form::model($perfil,['route'=>['Perfil.update',$perfil->id],'method'=>'PUT'])!!}

	
		@include('modulo.forms.mod')
	

	{!!Form::submit('Actualizar',['class'=>'btn btn-primary'])!!}
	<a href="../../Perfil" class="btn btn-danger">Cancelar</a>
	{!!Form::close()!!}

 
	
</div>
</div>

@endsection

                     