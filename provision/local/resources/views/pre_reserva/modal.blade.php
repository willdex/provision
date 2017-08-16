<div class="modal fade" id="ModalReserva" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 id="titulos" class="modal-title" >RESERVAR</h3>
      </div>

      <div class="modal-body">
        
      {!!Form::open(['route'=>'Reserva.store', 'method'=>'POST' , 'enctype'=>'multipart/form-data','onKeypress'=>'if(event.keyCode == 13) event.returnValue = false;','onsubmit'=>'javascript: return validar()'])!!}   
       <!-- este tipo reserva es para especificar en estoy en el formulario de reserva -->
       <input type="hidden" name="idCliente">
       <input type="hidden" name="idPreReserva">
       <input type="hidden" name="idLote">
            <input type="hidden" name="tipoReserva" value="1">

       <div class="form-group">
         <label>Tipo De Pago:</label><br>
          <select name="tipoPago" id="tipoPago" class="form-control">
            <option value="e">EFECTIVO</option>
            <option value="b">BANCO</option>
            <option value="be">BANCO - EFECTIVO</option>
          </select>        
       </div>

       <div class="form-group" style="display: block;" id="divEfectivo">
        <div class="form-group">
            {!!Form::label('monto','Monto Efectivo:')!!}
            <input type="number" class="form-control" placeholder="Monto en Efectivo" name="monto" step="0.001">
        </div>         
       </div>

       <div class="form-group" style="display: none" id="divBanco">       
          {!!Form::label('banco','Banco:')!!}
          <select name="banco" class="form-control" onchange="cargarCuenta(this)"></select><br>
          {!!Form::label('cuenta','Nro De Cuenta:')!!}
          <select name="cuenta" class="form-control" id="cuenta"></select><br>
          {!!Form::label('nroDocumento','Nro De Documento:')!!}
          <input type="number" name="nroDocumento"  class="form-control" placeholder="Nro de Documento"><br>          
          {!!Form::label('montoBanco','Monto Banco:')!!}
          <input type="number" name="montoBanco"  class="form-control" placeholder="Monto en Banco"><br>
          {!!Form::label('fecha','Fecha:')!!}
          <input type="date" name="fecha"  class="form-control">                

       </div>
      </div>
      <div class="modal-footer">
            {!!Form::submit('RESERVAR',['class'=>'btn btn-primary pull-right','id'=>'btn_reservar'])!!}
          <?php //<button type="submit" class="btn btn-primary" onclick="CambioMoneda()" id="btn_reservar">RESERVAR</button>       ?>
          <?php //{!!Form::submit('ACTUALIZAR',['class'=>'btn btn-primary pull-right'])!!} ?>
          {!!Form::close()!!}
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="ModalReserva" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 id="titulos" class="modal-title" >RESERVAR</h3>
      </div>

      <div class="modal-body">
        
      {!!Form::open(['route'=>'Reserva.store', 'method'=>'POST' , 'enctype'=>'multipart/form-data','onKeypress'=>'if(event.keyCode == 13) event.returnValue = false;','onsubmit'=>'javascript: return validar()'])!!}   
       <!-- este tipo reserva es para especificar en estoy en el formulario de reserva -->
       <input type="hidden" name="idCliente">
       <input type="hidden" name="idPreReserva">
       <input type="hidden" name="idLote">
            <input type="hidden" name="tipoReserva" value="1">
        <div class="form-group">
            {!!Form::label('monto','Monto:')!!}
            <input type="number" class="form-control" onchange="verificarMonto()" placeholder="monto" name="monto" step="0.001" required autofocus>
        </div>
       <div class="form-group">
         <label>tipo de pago:</label><br>
        
       </div>
       <div class="form-group">
          <label><input type="radio" name="tipoPago" value="e" checked="" onclick="cargarBanco(this)">Efectivo</label>
         <label><input type="radio" name="tipoPago" value="b" onclick="cargarBanco(this)">Banco</label>
       </div>
       <div class="form-group" style="display: none" id="divTipoPago">
         
         <select name="banco" class="form-control" onchange="cargarCuenta(this)"></select>
         <select name="cuenta" class="form-control" id="cuenta"></select>
          <input type="number" name="nroDocumento"  class="form-control" placeholder="Nro de Documento">
       </div>
      </div>
      <div class="modal-footer">
            {!!Form::submit('RESERVAR',['class'=>'btn btn-primary pull-right','id'=>'btn_reservar'])!!}
          <?php //<button type="submit" class="btn btn-primary" onclick="CambioMoneda()" id="btn_reservar">RESERVAR</button>       ?>
          <?php //{!!Form::submit('ACTUALIZAR',['class'=>'btn btn-primary pull-right'])!!} ?>
          {!!Form::close()!!}
      </div>
    </div>
  </div>
</div>
