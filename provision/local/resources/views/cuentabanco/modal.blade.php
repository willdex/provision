<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 id="titulogalpon" class="modal-title" >MODIFICAR NRO DE CUENTA</h4>
      </div>

      <div class="modal-body">
      <div class="row">

      {!!Form::open(['route'=>['CuentaBanco.update','null'],'method'=>'PUT'])!!}
     
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
         <div class="form-group">

         <input type="hidden" name="idBanco"  >
         <input type="hidden" name="idCuenta"  >

          <div class="col-sm-6 ">
          <div class="form-group">
          <label >Nro de Cuenta:</label>
          </div>        
          </div>

          </div>        
          </div>

          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
         <div class="form-group">

          <div class="col-sm-6 ">
          <div class="form-group">
          <input type="text"  class="form-control" name="nroCuenta" placeholder="INGRESE NUMERO DE CUENTA">  
          </div>        
          </div>

        </div>
      </div>

      </div>

      </div>

      
      <div class="modal-footer">
      {!!Form::submit('ACTUALIZAR',['class'=>'btn btn-success','id'=>'btn_modificar','onclick'=>'btn_esconder()'])!!}
      <button data-dismiss="modal" class="btn btn-danger">CANCELAR</button>

         

      </div>
      {!!Form::close()!!}
    </div>
  </div>
</div>


<script type="text/javascript">
        function ModificarCuentaBanco(idCuenta,idBanco,nroCuenta)
        {
            $("input[name=idCuenta]").val(idCuenta);
            $("input[name=idBanco]").val(idBanco);
            $("input[name=nroCuenta]").val(nroCuenta);
        }
      </script>



<div class="modal fade" id="myModalEliminar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 id="titulogalpon" class="modal-title" >ELIMINAR</h4>
      </div>

      <div class="modal-body">
      {!!Form::open(['route'=>['CuentaBanco.destroy','null'],'method'=>'DELETE'])!!}

         <input type="hidden" name="idCuentaBanco">
         <input type="hidden" name="idBanco">
         <h2 align="center">¿ DESEA ELIMINAR ESTE NRO DE CUENTA ?</h2>
        
       
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
        function EliminarCuentaBanco(idCuenta,idBanco)
        {
            $("input[name=idCuentaBanco]").val(idCuenta);
            $("input[name=idBanco]").val(idBanco);
        }
      </script>
