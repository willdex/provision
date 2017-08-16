@extends('layouts.inicio')
	@section('contenido')
        <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	@include('alerts.request')
	{!!Form::open(['route'=>'Precio.store', 'method'=>'POST'])!!}
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <h3>REGISTRAR PRECIO</h3>

		<div class="form-group">
			{!!Form::label('precio','Precio:')!!}
			{!!Form::text('precio',null,['class'=>'form-control ','placeholder'=>'Precio'])!!}
		</div>

	    <div class="form-group" >
	        {!!Form::label('categoria','Categoria:')!!}                
	        <select name="categoria" class="form-control selectpicker" id="categoria" data-live-search="true">
	         <option value="">SELECCIONE UNA CATEGORIA</option>
	            @foreach($categoria as $hij)
	            <option value="{{$hij->id}}">{{$hij->categoria}}</option>
	            @endforeach
	        </select>
	    </div>
	  </div>

    </div>

	    <div class="col-lg-6 col-md-6 col-sm-6  col-xs-12">		
		<div align="right">
			{!!Form::submit('REGISTRAR',['class'=>'btn btn-primary','id'=>'btn_registrar','onclick'=>'btn_esconder()'])!!}		
			<a href="{!!URL::to('Precio')!!}" class="btn btn-danger">CANCELAR</a>
		</div>		
		{!!Form::close()!!}
	    </div>

</div>
	@endsection