<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 id="titulogalpon" class="modal-title" >Modificar Perfil Objeto</h4>
      </div>

      <div class="modal-body">
     
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
        Objeto
        <select name="idObjetoA" class="form-control"></select>
        </div>
         <div class="form-group">
<input type="hidden" name="idPerfilObjetoA" >
<input type="hidden" name="idPerfilA"  >


 <input value="1" type="checkbox" name="puedeGuardarA" id="puedeGuardarA"><label for="puedeGuardarA">Guardar</label>
       
 </div> 
         <div class="form-group">

 <input type="checkbox" name="puedeModificarA" id="puedeModificarA" value="1"><label for="puedeModificarA" >Modificar</label>
 </div> 
    
         <div class="form-group">
       
 <input type="checkbox" name="puedeEliminarA" id="puedeEliminarA" value="1"><label for="puedeEliminarA" >Eliminar</label>
 </div> 
         <div class="form-group">

 <input value="1" type="checkbox" name="puedeListarA" id="puedeListarA"><label for="puedeListarA">Listar</label>
 </div> 
         <div class="form-group">

 <input value="1" type="checkbox" name="puedeVerReporteA" id="puedeVerReporteA"><label for="puedeVerReporteA">VerReporte</label>

 </div> 
         <div class="form-group">

 <input value="1" type="checkbox" name="puedeImprimirA" id="puedeImprimirA"><label for="puedeImprimirA">Imprimir</label>
 </div> 

        </div>

      </div>

      
      <div class="modal-footer">
<button class="btn btn-primary" onclick="ModificarPerfilObjeto(<?php echo $perfil[0]->id  ?>)">ACTUALIZAR</button>

          

      </div>
    </div>
  </div>
</div>
