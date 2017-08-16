
<!-- modal guardar -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 id="titulogalpon" class="modal-title" >REGISTRAR LOTE</h4>
      </div>
      <div class="modal-body">
     
      <input type="hidden" name="punto" id="punto" >
      <input type="hidden" name="tipo" id="tipo" >
<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
<div class="form-group">
    {!!Form::label('nroLote','Nro Lote:')!!}
    {!!Form::number('nroLote',null,['class'=>'form-control ','placeholder'=>'Ingresa el Nro de lote'])!!}
</div>
</div>
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

<div class="form-group">
    {!!Form::label('manzano','Manzano:')!!}
    {!!Form::number('manzano',null,['class'=>'form-control ','placeholder'=>'Ingresa el manzano'])!!}
    
       
</div>

</div>
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

<div class="form-group">
    {!!Form::label('superficie','Superficie:')!!}
    {!!Form::text('superficie',null,['class'=>'form-control ','placeholder'=>'Ingresa la superficie'])!!}
</div>
</div>
 <input type="hidden" name="opcion" value=<?php  echo $opcion ;?>>

<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

  <div class="form-group" >
      {!!Form::label('estado','Estado:')!!}
            {!!Form::select('estadoLote', array('0' => 'Disponible', '1' => 'Pre-Reservado', '2' => 'Reservado', '3' => 'Vendido'),null,array('id'=>'estado','class'=>'form-control'))!!}
  </div>  
  </div> 
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

<div class="form-group">
    {!!Form::label('matricula','Matricula:')!!}
    {!!Form::text('matricula',null,['class'=>'form-control ','placeholder'=>'Ingresa la Matricula'])!!}
    
       
  </div> 
</div>
 <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

<div class="form-group">
    {!!Form::label('uv','U-V:')!!}
    {!!Form::text('uv','0',['class'=>'form-control ','placeholder'=>'Ingresa la Matricula'])!!}
    
       
  </div> 
</div>
 <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

<div class="form-group">
    {!!Form::label('idCategoria','Categoria:')!!}
   {!!Form::select('idCategoriaLote',$categoria,null,array('class'=>'form-control'))!!}
       
  </div> 
</div>
 <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

<div class="form-group">
    {!!Form::label('fase','Fase:')!!}
    {!!Form::text('fase',$fase,['class'=>'form-control ','placeholder'=>'Ingresa la Matricula','disabled'])!!}

    {!!Form::hidden('fase',$fase,['class'=>'form-control ','placeholder'=>'Ingresa la Matricula'])!!}
       
  </div> 
</div>
  </div>  
  </div>  

<h3 style="text-align: center">COLINDANCIAS</h3>
<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

<div class="form-group">
    {!!Form::label('norte','Norte:')!!}
    {!!Form::text('norte',null,['class'=>'form-control ','placeholder'=>'Ingresa la colindacion norte'])!!}
</div>
</div>
<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">

<div class="form-group">
    {!!Form::label('medida_norte','Medida:')!!}
    {!!Form::number('medida_norte',null,['class'=>'form-control ','placeholder'=>'Ingresa la medida'])!!}
</div>
</div>
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

<div class="form-group">
    {!!Form::label('sur','Sur:')!!}
    {!!Form::text('sur',null,['class'=>'form-control ','placeholder'=>'Ingresa la colindacion sur'])!!}
</div>
</div>
<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">

<div class="form-group">
    {!!Form::label('medida_sur','Medida:')!!}
    {!!Form::number('medida_sur',null,['class'=>'form-control ','placeholder'=>'Ingresa la medida'])!!}
</div>
</div><div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

<div class="form-group">
    {!!Form::label('este','Este:')!!}
    {!!Form::text('este',null,['class'=>'form-control ','placeholder'=>'Ingresa la colindacion este'])!!}
</div>
</div>
<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">

<div class="form-group">
    {!!Form::label('medida_este','Medida:')!!}
    {!!Form::number('medida_este',null,['class'=>'form-control ','placeholder'=>'Ingresa la medida'])!!}
</div>
</div><div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

<div class="form-group">
    {!!Form::label('oeste','Oeste:')!!}
    {!!Form::text('oeste',null,['class'=>'form-control ','placeholder'=>'Ingresa la colindacion oeste'])!!}
</div>
</div>
<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">

<div class="form-group">
    {!!Form::label('medida_oeste','Medida:')!!}
    {!!Form::number('medida_oeste',null,['class'=>'form-control ','placeholder'=>'Ingresa la medida'])!!}
</div>
</div>
     </div>      
   
  </div></div>

      <div class="modal-footer">
<button class="btn btn-primary" onclick="guardarLote()">Registrar</button>       

<button class="btn btn-danger" data-dismiss="modal">Cancelar</button> 

      </div>
    </div>
  </div>
</div>



<!-- modal editar -->


<div class="modal fade" id="myModalActualizar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 id="titulogalpon" class="modal-title" >ACTUALIZAR LOTE</h4>
      </div>

      <div class="modal-body">

      <input type="hidden" name="id_lote" id="id_lote">
<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
<div class="form-group">
    {!!Form::label('nro_lote_ac','Nro Lote:')!!}
    {!!Form::number('nro_lote_ac',null,['class'=>'form-control ','placeholder'=>'Ingresa el Nro de lote'])!!}
</div>
</div>


<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

<div class="form-group">
    {!!Form::label('manzano','Manzano:')!!}
    {!!Form::number('manzano_ac',null,['class'=>'form-control ','placeholder'=>'Ingresa la superficie'])!!}
</div>
</div>
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
<div class="form-group">
    {!!Form::label('superficie_ac','Superficie:')!!}
    {!!Form::text('superficie_ac',null,['class'=>'form-control ','placeholder'=>'Ingresa la superficie'])!!}
</div>
</div>



<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">

  <div class="form-group" >
      {!!Form::label('estado_ac','Estado:')!!}
      <select name="estado_ac" class="form-control"></select>
  </div>  
</div>
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

<div class="form-group">
    {!!Form::label('matricula','Matricula:')!!}
    {!!Form::text('matricula_ac',null,['class'=>'form-control ','placeholder'=>'Ingresa la Matricula'])!!}
    
       
  </div> 
</div>
 <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

<div class="form-group">
    {!!Form::label('uv','U-V:')!!}
    {!!Form::text('uv_ac','0',['class'=>'form-control ','placeholder'=>'Ingresa la Matricula'])!!}
    
       
  </div> 
</div>
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

<div class="form-group">
    {!!Form::label('idCategoria_ac','Categoria:')!!}
    <select class="form-control" name="idCategoria_ac">    
    </select>
    
       
  </div> 
</div>
</div>
</div>
<h3 style="text-align: center">COLINDANCIAS</h3>
<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

<div class="form-group">
    {!!Form::label('norte_ac','Norte:')!!}
    {!!Form::text('norte_ac',null,['class'=>'form-control ','placeholder'=>'Ingresa la colindacion norte'])!!}
</div>
</div>
<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">

<div class="form-group">
    {!!Form::label('medida_norte_ac','Medida:')!!}
    {!!Form::number('medida_norte_ac',null,['class'=>'form-control ','placeholder'=>'Ingresa la medida'])!!}
</div>
</div>
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

<div class="form-group">
    {!!Form::label('sur_ac','Sur:')!!}
    {!!Form::text('sur_ac',null,['class'=>'form-control ','placeholder'=>'Ingresa la colindacion sur'])!!}
</div>
</div>
<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">

<div class="form-group">
    {!!Form::label('medida_sur_ac','Medida:')!!}
    {!!Form::number('medida_sur_ac',null,['class'=>'form-control ','placeholder'=>'Ingresa la medida'])!!}
</div>
</div><div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

<div class="form-group">
    {!!Form::label('este_ac','Este:')!!}
    {!!Form::text('este_ac',null,['class'=>'form-control ','placeholder'=>'Ingresa la colindacion este'])!!}
</div>
</div>
<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">

<div class="form-group">
    {!!Form::label('medida_este_ac','Medida:')!!}
    {!!Form::number('medida_este_ac',null,['class'=>'form-control ','placeholder'=>'Ingresa la medida'])!!}
</div>
</div><div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

<div class="form-group">
    {!!Form::label('oeste_ac','Oeste:')!!}
    {!!Form::text('oeste_ac',null,['class'=>'form-control ','placeholder'=>'Ingresa la colindacion oeste'])!!}
</div>
</div>
<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">

<div class="form-group">
    {!!Form::label('medida_oeste_ac','Medida:')!!}
    {!!Form::number('medida_oeste_ac',null,['class'=>'form-control ','placeholder'=>'Ingresa la medida'])!!}
</div>
</div>
     </div>      
   
  </div>
    
       
  </div>

      <div class="modal-footer">
      <button class="btn btn-primary" onclick="ActualizarLote()">Actualizar</button>
<button class="btn btn-danger" data-dismiss="modal">CANCELAR</button> 


  {!!Form::close()!!}
      </div>
    </div>
  </div>
</div>
