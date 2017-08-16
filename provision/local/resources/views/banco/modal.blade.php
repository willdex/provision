<div class="modal fade" id="myModalEliminar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 id="titulogalpon" class="modal-title" >ELIMINAR</h4>
      </div>

      <div class="modal-body">
      {!!Form::open(['route'=>['Banco.destroy','null'],'method'=>'DELETE'])!!}

         <input type="hidden" name="idBanco">
         <h2 align="center">¿ DESEA ELIMINAR ESTE BANCO ?</h2>
        
       
      </div>
      <div class="modal-footer">
        
        {!!Form::submit('ACEPTAR',['class'=>'btn btn-success','id'=>'btn_eliminar','onclick'=>'btn_esconder()'])!!}
      <button data-dismiss="modal" class="btn btn-danger">CANCELAR</button>

      </div>
      {!!Form::close()!!}
    </div>
  </div>
</div>

      <script type="text/javascript">
        function EliminarBanco(id)
        {
            $("input[name=idBanco]").val(id);
        }
      </script>

