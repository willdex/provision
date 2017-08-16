@extends('layouts.inicio')
	@section('contenido')
        <div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	@include('alerts.request')
	{!!Form::open(['route'=>'usuario.store', 'method'=>'POST'])!!}
		@include('usuario.forms.usr')
		{!!Form::submit('Registrar',['class'=>'btn btn-primary'])!!}
	{!!Form::close()!!}
        </div>
</div>
	@endsection