@extends('layouts.inicio')
@section('contenido')
<H3>Registrar Objeto</H3>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    @include('alerts.request')
	{!!Form::open(['route'=>'Objeto.store', 'method'=>'POST'])!!}	
		@include('objeto.forms.mod')		
	{!!Form::submit('Registrar',['class'=>'btn btn-primary'])!!}
	{!!Form::reset('Cancelar',['class'=>'btn btn-danger'])!!}
	{!!Form::close()!!}
	</div>
</div>
	@endsection