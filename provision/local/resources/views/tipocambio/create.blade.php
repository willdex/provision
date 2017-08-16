@extends('layouts.inicio')
	@section('contenido')
        <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	@include('alerts.request')
	{!!Form::open(['route'=>'TipoCambio.store', 'method'=>'POST'])!!}
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <h3>REGISTRAR TIPO CAMBIO</h3>

		<div class="form-group">
			{!!Form::label('monedaVenta','Moneda Venta:')!!}
			{!!Form::text('monedaVenta',null,['class'=>'form-control ','placeholder'=>'Moneda Venta','onkeypress'=>'return numerosmasdecimal(event)'])!!}
		</div>

		<div class="form-group">
			{!!Form::label('monedaCompra','Moneda Compra:')!!}
			{!!Form::text('monedaCompra',null,['class'=>'form-control ','placeholder'=>'Moneda Compra','onkeypress'=>'return numerosmasdecimal(event)'])!!}
		</div>

	  </div>

    </div>

	    <div class="col-lg-6 col-md-6 col-sm-6  col-xs-12">		
		<div align="right">
			{!!Form::submit('REGISTRAR',['class'=>'btn btn-primary','id'=>'btn_registrar','onclick'=>'btn_esconder()'])!!}		
			<a href="{!!URL::to('TipoCambio')!!}" class="btn btn-danger">CANCELAR</a>
		</div>		
		{!!Form::close()!!}
	    </div>

</div>
	@endsection