@extends('layouts.inicio')
	@section('contenido')
        <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	@include('alerts.request')
	{!!Form::open(['route'=>'Categoria.store', 'method'=>'POST'])!!}
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <h3>REGISTRAR CATEGORIA</h3>

		<div class="form-group">
			{!!Form::label('categoria','Categoria:')!!}
			{!!Form::text('categoria',null,['class'=>'form-control ','placeholder'=>'Categoria'])!!}
		</div>

		<div class="form-group">
			{!!Form::label('descripcion','Descripcion:')!!}
			{!!Form::textarea('descripcion',null,['class'=>'form-control','placeholder'=>'Descripcion','rows'=>'4'])!!}
		</div>


	    <?php 
		/*<div class="form-group">
		 $proyecto = DB::select("SELECT *FROM proyecto WHERE proyecto.id=".Session::get('idProyecto')); ?>
			<font size="6">{{ $proyecto[0]->nombre }}</font>
		</div>*/

	    /*<div class="form-group" >
	        {!!Form::label('proyecto','Proyecto:')!!}                
	        <select name="proyecto" class="form-control selectpicker" id="proyecto" data-live-search="true">
	         <option value="">SELECCIONE UN PROYECTO</option>
	            @foreach($proyecto as $hij)
	            <option value="{{$hij->id}}">{{$hij->nombre}}</option>
	            @endforeach
	        </select>
	    </div>*/ ?>

	  </div>

    </div>

	    <div class="col-lg-6 col-md-6 col-sm-6  col-xs-12">		
		<div align="right">
			{!!Form::submit('REGISTRAR',['class'=>'btn btn-primary','id'=>'btn_registrar','onclick'=>'btn_esconder()'])!!}		
			<a href="{!!URL::to('Categoria')!!}" class="btn btn-danger">CANCELAR</a>
		</div>		
		{!!Form::close()!!}
	    </div>

</div>
	@endsection