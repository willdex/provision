@extends('layouts.admin')
	@section('content')
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

	{!!Form::model($empresa,['route'=>['empresa.update',$empresa->id],'method'=>'PUT'])!!}
		@include('empresa.forms.empresa')
	{!!Form::submit('Actializar',['class'=>'btn btn-primary'])!!}
	{!!Form::close()!!}

	<!--{!!Form::open(['route'=>['galpon.destroy',$galpon->id],'method'=>'DELETE'])!!}
			@include('galpon.forms.galpon')
	{!!Form::submit('Eliminar',['class'=>'btn btn-danger'])!!}
	{!!Form::close()!!}-->
	</div>
</div>
	@endsection