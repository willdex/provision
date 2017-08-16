@extends('layouts.inicio')
	@section('contenido')
        <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	@include('alerts.request')
	{!!Form::model($meses,['route'=>['Meses.update',$meses],'method'=>'PUT','onKeypress'=>'if(event.keyCode == 13) event.returnValue = false;'])!!}	 
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <h3>ACTUALIZAR MES</h3>

		<div class="form-group">
			{!!Form::label('mes','Mes:')!!}
			{!!Form::text('mes',null,['class'=>'form-control ','placeholder'=>'Mes'])!!}
		</div>

	    

	  </div>

    </div>

	    <div class="col-lg-6 col-md-6 col-sm-6  col-xs-12">		
		<div align="right">
			{!!Form::submit('ACTUALIZAR',['class'=>'btn btn-primary','id'=>'btn_registrar','onclick'=>'btn_esconder()'])!!}		
			<a href="{!!URL::to('Meses')!!}" class="btn btn-danger">CANCELAR</a>
		</div>		
		{!!Form::close()!!} 
	    </div>
</div>
@endsection

