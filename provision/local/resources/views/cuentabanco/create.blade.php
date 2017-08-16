@extends('layouts.inicio')
@section('contenido')
    <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	@include('alerts.request')
	{!!Form::open(['route'=>'CuentaBanco.store', 'method'=>'POST'])!!}
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <h3>REGISTRAR CUENTA BANCO</h3>

		<div class="form-group">
			{!!Form::label('nrocuenta','Nro de Cuenta:')!!}
			{!!Form::text('nrocuenta',null,['class'=>'form-control ','placeholder'=>'Ingrese Nro de Cuenta'])!!}
		</div>

	    <div class="form-group" >
	        {!!Form::label('banco','Banco:')!!}                
	        <select name="banco" class="form-control selectpicker" id="banco" data-live-search="true">
	         <option value="">SELECCIONE UN BANCO</option>
	            @foreach($banco as $ban)
	            <option value="{{$ban->id}}">{{$ban->nombre}}</option>
	            @endforeach
	        </select>
	    </div>
	  </div>

    </div>

	    <div class="col-lg-6 col-md-6 col-sm-6  col-xs-12">		
		<div align="right">
			{!!Form::submit('REGISTRAR',['class'=>'btn btn-primary','id'=>'btn_registrar','onclick'=>'btn_esconder()'])!!}		
			<a href="{!!URL::to('CuentaBanco')!!}" class="btn btn-danger">CANCELAR</a>
		</div>		
		{!!Form::close()!!}
	    </div>

</div>
	@endsection