@extends('layouts.inicio')
@section('contenido')
@include('alerts.errors')
@include('alerts.success')
@include('cuentabanco.modal')
    
<div class="row">	
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <font size="6">CUENTA BANCO</font>
        </div>
     </div>
        <br>

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <section>
        
           <div class="col-sm-6 ">
          <div class="form-group">
          <h3><label >Agregar cuenta al Banco <?php echo " ".$banco[0]->nombre  ?></label></h3> 
          </div>        
          </div>

          {!!Form::open(['route'=>'CuentaBanco.store', 'method'=>'POST'])!!}

        </section>
      </div>

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <section>

        <input type="hidden" name="idBanco" value=<?php echo $banco[0]->id  ?> >
        
           <div class="col-sm-9 ">
          <div class="form-group">
          <input type="text"  class="form-control" name="nrocuenta" placeholder="NUMERO DE CUENTA">  
          </div>        
          </div>
          <div class="col-sm-3 ">
          <div class="form-group">
          <button type="submit" class="btn btn-success"><i class="fa fa-plus-circle" aria-hidden="true"></i></button> 
          </div>        
          </div>
           
        </section>
      </div>
      {!!Form::close()!!}   
</div>

    <br>

	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
		<table class="table table-striped table-bordered table-condensed table-hover">
			<thead>
			<thead>
			<th><CENTER>NRO CUENTA</CENTER></th>
			<th><CENTER>OPERACIÓN</CENTER></th>
			</thead>
			 @foreach ($cuentabanco as $des)
			<TR>
			<td><CENTER>{{$des->nroCuenta}}</CENTER></td>
			
			<td><CENTER>

             <button data-toggle='modal' data-target='#myModal' onclick="ModificarCuentaBanco({{$des->idCuenta}},{{$des->idBanco}},{{$des->nroCuenta}})" class="btn btn-primary" title="MODIFICAR"><i class="fa fa-pencil" aria-hidden="true"> </i></button>

             <button data-toggle='modal' data-target='#myModalEliminar' onclick="EliminarCuentaBanco({{$des->idCuenta}},{{$des->idBanco}})" class="btn btn-danger" title="ELIMINAR"><i class="fa fa-trash-o" aria-hidden="true"> </i></button>
 
			</CENTER></td>
		    </TR>
			@endforeach 
		</table>
		</div>
	</div>
</div>
@endsection