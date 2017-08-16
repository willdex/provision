@extends('layouts.inicio')
	@section('contenido')
        <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	@include('alerts.request')
	{!!Form::model($proyecto,['route'=>['Proyecto.update',$proyecto],'method'=>'PUT'])!!}	 
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <h3>ACTUALIZAR PROYECTO</h3>

		<div class="form-group">
			{!!Form::label('nombre','Nombre Proyecto:')!!}
			{!!Form::text('nombre',null,['class'=>'form-control ','placeholder'=>'Nombre Proyecto'])!!}
		</div>

		<div class="form-group">
			{!!Form::label('ubicacion','Ubicacion:')!!}
			{!!Form::text('ubicacion',null,['class'=>'form-control ','placeholder'=>'Ubicacion'])!!}
		</div>

	  </div>

    </div>

	    <div class="col-lg-6 col-md-6 col-sm-6  col-xs-12">		
		<div align="right">
			{!!Form::submit('ACTUALIZAR',['class'=>'btn btn-primary','id'=>'btn_registrar','onclick'=>'btn_esconder()'])!!}		
			<a href="{!!URL::to('Proyecto')!!}" class="btn btn-danger">CANCELAR</a>
		</div>		
		{!!Form::close()!!} 
	    </div>
</div>
@endsection

