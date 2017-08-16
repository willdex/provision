@extends('layouts.inicio')
	@section('contenido')
        <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	@include('alerts.request')
	{!!Form::open(['route'=>'Meses.store', 'method'=>'POST','onKeypress'=>'if(event.keyCode == 13) event.returnValue = false;'])!!}
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <h3>REGISTRAR MES</h3>

		<div class="form-group">
			{!!Form::label('mesMin','Mes:')!!}
			{!!Form::text('mesMin',null,['class'=>'form-control ','placeholder'=>'Mes Minimo'])!!}
		</div>
	<div class="form-group">
			{!!Form::label('mesMax','Mes:')!!}
			{!!Form::text('mesMax',null,['class'=>'form-control ','placeholder'=>'Mes Maximo'])!!}
		</div>
	  </div>

    </div>

	    <div class="col-lg-6 col-md-6 col-sm-6  col-xs-12">		
		<div align="right">
			{!!Form::submit('REGISTRAR',['class'=>'btn btn-primary','id'=>'btn_registrar','onclick'=>'btn_esconder()'])!!}		
			<a href="{!!URL::to('Meses')!!}" class="btn btn-danger">CANCELAR</a>
		</div>		
		{!!Form::close()!!}
	    </div>

</div>
	@endsection