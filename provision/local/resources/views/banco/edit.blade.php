@extends('layouts.inicio')
	@section('contenido')
	<h3>ACTUALIZAR BANCO</h3>
<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">		
    @include('alerts.request')

	{!!Form::model($banco,['route'=>['Banco.update',$banco->id],'method'=>'PUT'])!!}

	
	@include('banco.forms.mod')
	<div class="row">
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">		

	{!!Form::submit('Actualizar',['class'=>'btn btn-primary'])!!}
	{!!Form::close()!!}
	</div>
  
	</div>
</div>
</div>

@endsection