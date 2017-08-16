@extends('layouts.inicio')
@section('contenido')
@include('alerts.errors')
    
<div class="row">	
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <font size="6">DESCUENTO DE VENTAS</font>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 pull-right">
            <div class="pull-right">
                <a class="btn btn-success" href="{!!URL::to('DescuentoVenta/create')!!}"><i class="fa fa-plus-circle" aria-hidden="true"></i></a> 
            </div>
        </div>    
    </div>

	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
		<table class="table table-striped table-bordered table-condensed table-hover">
			<thead>
				<th><CENTER>PORCENTAJE</CENTER></th>
				<th><CENTER>PROYECTO</CENTER></th>
			</thead>

			 @foreach ($descuentoVenta as $des)
			<TR>
				<td align="center">{{$des->porcentaje}} %</td>
                <td align="center">{{$des->nombre}}</td>
			</TR>
			@endforeach 
		</table>
		</div>
	</div>
</div>
@endsection