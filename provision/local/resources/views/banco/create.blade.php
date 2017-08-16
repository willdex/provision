@extends('layouts.inicio')
@section('contenido')
        <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	@include('alerts.request')
	{!!Form::open(['route'=>'Banco.store', 'method'=>'POST', 'enctype'=>'multipart/form-data','onKeypress'=>'if(event.keyCode == 13) event.returnValue = false;'])!!}
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <h3>REGISTRAR BANCO</h3>

		<div class="form-group">
			{!!Form::label('nombre','Nombre:')!!}
			{!!Form::text('nombre',null,['class'=>'form-control ','placeholder'=>'Nombre'])!!}
		</div>

	  </div>

    </div>

	    <div class="col-lg-6 col-md-6 col-sm-6  col-xs-12">		
		<div align="right">
			{!!Form::submit('REGISTRAR',['class'=>'btn btn-primary','id'=>'btn_registrar','onclick'=>'btn_esconder()'])!!}		
			<a href="{!!URL::to('Banco')!!}" class="btn btn-danger">CANCELAR</a>
		</div>		
		{!!Form::close()!!}
	    </div>

</div>
@endsection