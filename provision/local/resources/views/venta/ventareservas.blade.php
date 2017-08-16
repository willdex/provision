


    @extends('layouts.inicio')
@section('contenido')
@include('alerts.success')
@include('alerts.request')
@include('alerts.errors')
@include('alerts.cargando')

<div class="panel panel-success">
<div class="panel-heading">
<h4>DATOS DEL CLIENTE</h4>       
  
  </div>  
  <div class="panel-body">
      {!!Form::open(['route'=>'venta_reserva.store', 'method'=>'POST'])!!}
<input type="hidden" name="id_reserva" value=<?php echo $id_reserva ?>>
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <section>
        <div class="col-sm-1 ">
          <div class="form-group">
          <label for="id_cliente">CODIGO</label>
          <input  value=<?php echo $lista_reserva[0]->id_cliente ?> type="text"  class="form-control" name="id_cliente"  disabled="" >  
           <input  value=<?php echo $lista_reserva[0]->id_cliente ?> type="hidden"  class="form-control" name="id_cliente"   >  
          </div>        
          </div>
           <div class="col-sm-2 ">
          <div class="form-group">
          <label for="ci">NRO. CARNET *</label>
          <input value=<?php echo $lista_reserva[0]->ci ?> type="text"  class="form-control" name="ci" placeholder="NUMERO DE CARNET">  
          </div>        
          </div>
          <div class="col-sm-3 ">
          <div class="form-group">
          <label for="nombre">Nombre *</label>
          <input  value=<?php echo $lista_reserva[0]->nombre_cliente ?>  type="text"  class="form-control" name="nombre" placeholder="" >  
          </div>        
          </div>
          <div class="col-sm-4 ">
          <div class="form-group">
          <label for="apellido">Apellidos *</label>
          <input value=<?php echo $lista_reserva[0]->apellido_cli ?>  type="text"  class="form-control" name="apellido" >  
          </div>        
          </div>
           
        </section>
      </div>
       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <section>
        <div class="col-sm-3 ">
          <div class="form-group">
          <label for="direccion">Domicilio *</label>
          <input  <?php 
            if ($lista_reserva[0]->direccion=="") {
            
            }else{
            echo "value=".$lista_reserva[0]->direccion ." " ;}?>   type="text"  class="form-control" name="direccion" >  
          </div>        
          </div>
          <div class="col-sm-3 ">
          <div class="form-group">
          <label for="celular">Celular *</label>
          <input <?php 
            if ($lista_reserva[0]->celular=="") {
            
            }else{
            echo "value=".$lista_reserva[0]->celular ." " ;}?> type="text"  class="form-control" name="celular" >  
          </div>        
          </div>

          <div class="col-sm-3 ">
          <div class="form-group">
          <label for="telefono">Celular Ref:</label>
          <input <?php 
            if ($lista_reserva[0]->telefono_adicional=="") {
            
            }else{
            echo "value=".$lista_reserva[0]->telefono_adicional ." " ;}?> type='text'  class="form-control" name="telefono" >  
          </div>        
          </div>
          
             <div class="col-sm-2 ">
          <div class="form-group">
          <label for="nit">NIT</label>
          <input  <?php 
            if ($lista_reserva[0]->nit=="") {
            
            }else{
            echo "value=".$lista_reserva[0]->nit ." " ;}?> type="text"  class="form-control" name="nit">  
          </div>        
          </div>
        </section>
      </div>
    </div>                  
                     
</div>
  <div class="panel-footer">VENTA</div>
</div>
<div class="panel panel-success">
<div class="panel-heading">
<h4>DATOS DEL PREVIO</h4>       
  
  </div>  
  <div class="panel-body">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <section>
        <div class="col-sm-1 ">
          <div class="form-group">
          <label for="id_lote">CODIGO</label>
          <input <?php echo "value=".$lista_reserva[0]->id_lote ?>  type="hidden"  class="form-control" name="id_lote" >  
           <input <?php echo "value=".$lista_reserva[0]->id_lote ?>  type="text"  class="form-control" name="id_lote" disabled=""> 
          </div>        
          </div>
          <div class="col-sm-2 ">
          <div class="form-group">
          <label for="nro_lote">Nro. Lote</label>
          <input value=<?php echo $lista_reserva[0]->nro_lote ?>  type="text"  class="form-control" name="nro_lote" disabled="">  
            <input value=<?php echo $lista_reserva[0]->nro_lote ?>  type="hidden"  class="form-control" name="nro_lote"  > 
          </div>        
          </div>
          <div class="col-sm-2 ">
          <div class="form-group">
          <label for="nro_manzano">Nro. Manzano</label>
          <input value=<?php echo $lista_reserva[0]->nro_manzano ?> type="text"  class="form-control" name="nro_manzano"   disabled="">  
          </div>        
          </div>
            <div class="col-sm-2 ">
          <div class="form-group">
          <label for="superfice">Supercie(mt2)</label>
          <input value=<?php echo $lista_reserva[0]->superficie ?> type="text"  class="form-control" name="superfice"    id="supercie" disabled="">  
          </div>        
          </div>
            <div class="col-sm-2 ">
          <div class="form-group">
          <label for="precio">Precio(mt2) $</label>
           <input onchange="precioventa(<?php echo $lista_reserva[0]->superficie ?>)" type="number"  class="form-control" name="precio" placeholder="$" id="precio">  
          </div>        
          </div>
        </section>
      </div>
     
    </div>                  
                     
</div>
  <div class="panel-footer">VENTA</div>
</div>
<div class="panel panel-success">
<div class="panel-heading">
<h4>DATOS DE LA TRANSANCION COMERCIAL</h4>       
  
  </div>  
  <div class="panel-body">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <section>
        <div class="col-sm-2 ">
          <div class="form-group">
          <label for="precio_venta">Precio venta del Previo</label>
          <input      id="precio_venta" type="text"  class="form-control" name="precio_venta"  disabled="">  
          <input      id="precio_venta_h" type="hidden"  class="form-control" name="precio_venta"  >  

          </div>        
          </div>
          <div class="col-sm-2 ">
          <div class="form-group">
          <label for="descuento">Descuento(%) *</label>
          <input  value=<?php echo $descuento[0]->descuento ?> type="number" class="form-control" name="descuento" id="descuento" onchange="verificarDescuento()">  
          <input  value=<?php echo $descuento[0]->descuento ?> type="hidden" class="form-control"  id="descuento_guardado" >
           <input  value=<?php echo $descuento[0]->id ?> type="hidden"    class="form-control" name="id_descuento" id="id_descuento"> 
          </div>        
          </div>
         <div class="col-sm-2 ">
          <div class="form-group">
          <label for="descuento">Tipo de Cambio </label>
          <input  value=<?php echo $moneda[0]->moneda ?> type="number" class="form-control" name="cambio_moneda" id="cambio_moneda" onchange="calcularCambio()">  
          
          </div>        
          </div>
            <div class="col-sm-2 ">
          <div class="form-group">
          <label for="pago_contado">Pago al contado</label>
          <input  id="pago_contado" type="text"  class="form-control" name="pago_contado" disabled=""  >  
          <input  id="pago_contado_h" type="hidden"  class="form-control" name="pago_contado"   >  

          </div>   
          <div class="form-group">
          <label for="pago_contado_bol">Pago al contado en Bs.</label>
          <input  id="pago_contado_bol" type="text"  class="form-control" name="pago_contado_bol" disabled=""  >  
          <input  id="pago_contado_bol_h" type="hidden"  class="form-control" name="pago_contado_bol"   >  

          </div>         
          </div>
            
        </section>
      </div>
     
    </div>                  
                     
</div>
  <div class="panel-footer">
 
    {!!Form::submit('REGISTRAR',['class'=>'btn btn-primary','id'=>'btn_registrar'])!!}

<a  class="btn btn-danger " href="{!!URL::to('reservas/lotes')!!}">CANCELAR</a>
{!!Form::close()!!}
  </div>
</div>

   {!!Html::script('js/venta.js')!!}

    @endsection