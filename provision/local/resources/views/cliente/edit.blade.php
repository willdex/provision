@extends('layouts.inicio')
	@section('contenido')
	@include('alerts.request')
		{!!Form::model($cliente,['route'=>['cliente.update',$cliente],'method'=>'PUT'])!!}
			@include('cliente.forms.cli')
			{!!Form::submit('Actualizar',['class'=>'btn btn-primary'])!!}
		{!!Form::close()!!}

		{!!Form::open(['route'=>['cliente.destroy', $cliente], 'method' => 'DELETE'])!!}
			{!!Form::submit('Eliminar',['class'=>'btn btn-danger'])!!}
		{!!Form::close()!!}
	@endsection