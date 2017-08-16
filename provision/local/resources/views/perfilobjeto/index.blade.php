@extends('layouts.inicio')
	
	@section('contenido')
        @if(Session::has('message'))
<div class="alert alert-success alert-dismissible" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	{{Session::get('message')}}
</div>
@endif
 @include('alerts.errors')
 @include('alerts.cargando')

 @include('perfilobjeto.modal')

    <font size="6">Agregar Objeto <?php echo $perfil[0]->nombre  ?> Al  Perfil</font>
             {!!Form::open(['route'=>'PerfilObjeto.store', 'method'=>'POST'])!!}
          
             <div class="col-12 lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
        	
        Objeto
{!!Form::select('idObjeto',$objeto,null,array('class'=>'form-control'))!!}
        </div>

       <input type="hidden" name="idPerfil" value=<?php echo $perfil[0]->id  ?>>
    </div>  
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
           <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
 <input value="1" type="checkbox" name="puedeGuardar" id="puedeGuardar"><label for="puedeGuardar">Guardar</label>
        </div>
 <div class="col-lg-2 col-md-2 col-sm2 col-xs-12">
 <input type="checkbox" name="puedeModificar" id="puedeModificar" value="1"><label for="puedeModificar" >Modificar</label>
        </div>
         <div class="col-lg-2 col-md-2 col-sm2 col-xs-12">
 <input type="checkbox" name="puedeEliminar" id="puedeEliminar" value="1"><label for="puedeEliminar" >Eliminar</label>
        </div>
         <div class="col-lg-2 col-md-2 col-sm2 col-xs-12">
 <input value="1" type="checkbox" name="puedeListar" id="puedeListar"><label for="puedeListar">Listar</label>
        </div>
         <div class="col-lg-2 col-md-2 col-sm2 col-xs-12">
 <input value="1" type="checkbox" name="puedeVerReporte" id="puedeVerReporte"><label for="puedeVerReporte">VerReporte</label>
        </div>
         <div class="col-lg-2 col-md-2 col-sm2 col-xs-12">
 <input value="1" type="checkbox" name="puedeImprimir" id="puedeImprimir"><label for="puedeImprimir">Imprimir</label>
        </div>
         <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 pull-right">
            <div class="pull-right">
               <button  class="btn btn-primary"><i class="fa fa-plus-square-o" aria-hidden="true"></i></button>
            </div>

        </div> 

        </div>

	{!!Form::close()!!}
        
  <div class="row">	
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

	<div class="table-responsive">
		
		<table class="table table-striped table-bordered table-condensed table-hover">
		<thead>
		<th><CENTER>Objeto</CENTER></th>
		<th><CENTER>Guardar</CENTER></th>
		<th><CENTER>Modificar</CENTER></th>
		<th><CENTER>Eliminar</CENTER></th>

		<th><CENTER>Listar</CENTER></th>
		<th><CENTER>VerReporte</CENTER></th>
		<th><CENTER>Imprimir</CENTER></th>
          <th><CENTER>Operacion</CENTER></th>
		
		</thead>
		@foreach($perfilObjeto as $po)
		<tr style="text-align: center">
		<td>{{$po->nombre}} 
		<td><?php if ($po->puedeGuardar==1) {
			echo '<i class="fa fa-check" aria-hidden="true"></i>';
		}else echo '<i class="fa fa-times" aria-hidden="true"></i>'; ?>
		<td><?php if ($po->puedeModificar==1) {
			echo '<i class="fa fa-check" aria-hidden="true"></i>';
		}else echo '<i class="fa fa-times" aria-hidden="true"></i>'; ?>
		<td><?php if ($po->puedeEliminar==1) {
			echo '<i class="fa fa-check" aria-hidden="true"></i>';
		}else echo '<i class="fa fa-times" aria-hidden="true"></i>'; ?>
		<td><?php if ($po->puedeListar==1) {
			echo '<i class="fa fa-check" aria-hidden="true"></i>';
		}else echo '<i class="fa fa-times" aria-hidden="true"></i>'; ?>
		<td><?php if ($po->puedeVerReporte==1) {
			echo '<i class="fa fa-check" aria-hidden="true"></i>';
		}else echo '<i class="fa fa-times" aria-hidden="true"></i>'; ?>
		<td><?php if ($po->puedeImprimir==1) {
			echo '<i class="fa fa-check" aria-hidden="true"></i>';
		}else echo '<i class="fa fa-times" aria-hidden="true"></i>'; ?>

		<td><button data-toggle='modal' data-target='#myModal' onclick="CargarModal({{$po->id}})" class="btn btn-primary" title="Modificar"><i class="fa fa-pencil" aria-hidden="true" ></i></button>
		<button class="btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
		</tr>
		@endforeach
		</table>
	</div>
</div>
</div>
        <script src="{{asset('js/PerfilObjeto.js')}}"></script> 

	@endsection