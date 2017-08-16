@extends('layouts.inicio')
	@section('contenido')
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    @include('alerts.request')

	{!!Form::model($empresa,['route'=>['Empresa.update',$empresa->id],'method'=>'PUT'])!!}

	
		@include('empresa.forms.empresa')
	{!!Form::submit('Actualizar',['class'=>'btn btn-primary'])!!}
	{!!Form::close()!!}

	
	</div>
</div>
@endsection