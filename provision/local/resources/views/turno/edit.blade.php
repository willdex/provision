@extends('layouts.inicio')
	@section('contenido')
	<h3>Actualizar Turno</h3>
<div class="row">
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">		
    @include('alerts.request')

	{!!Form::model($Turno,['route'=>['Turno.update',$Turno->id],'method'=>'PUT'])!!}

	
		@include('turno.forms.mod')
  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">		

	{!!Form::submit('Actualizar',['class'=>'btn btn-primary'])!!}
	{!!Form::close()!!}
	</div>
  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">		

	
	</div>
	
</div>
</div>

@endsection

                     