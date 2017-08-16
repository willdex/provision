@extends('layouts.inicio')
@section('contenido')
@include('alerts.success')
@include('alerts.errors')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		@include('alerts.request')
		{!!Form::open(['route'=>'Proyecto.store', 'method'=>'POST','onKeypress'=>'if(event.keyCode == 13) event.returnValue = false;'])!!}
	    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		  <div class="panel panel-success">
		    <div class="panel-heading"><b>REGISTRO DE PROYECTO</b></div>  		
		    <div class="panel-body">	    
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
    	</div>

	    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
		  <div class="panel panel-success">
		    <div class="panel-heading"><b>REGISTRO DE CATEGORIA & PRECIO </b>
		    <div class="pull-right"><button type="button" id="btn_cat" class="btn-sm btn-success" onclick="agregar_categoria()"><i class="fa fa-plus-circle" aria-hidden="true"></i></button></div></div>  		
		    <div class="panel-body">	    
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead><tr>
					<th><center>CATEGORIA</center></th>
					<th><center>PRECIO</center></th>
					<th><center>*</center></th>
				</tr></thead>
					<tbody id="body_categoria"></tbody>
				</table>
		    </div>
			</div>    		
    	</div>    	
    </div>


	<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">		
		<div align="right">
			{!!Form::submit('REGISTRAR',['class'=>'btn btn-primary','id'=>'btn_registrar','onclick'=>'btn_esconder()'])!!}		
			<a href="{!!URL::to('Proyecto')!!}" class="btn btn-danger">CANCELAR</a>
		</div>		
		{!!Form::close()!!}
	</div>
</div>
{!!Html::script('js/crear_proyecto.js')!!}
@endsection