<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 id="titulogalpon" class="modal-title" >CREAR MANZANO</h4>
      </div>

      <div class="modal-body">
      {!!Form::open(['route'=>'manzano.store', 'method'=>'POST'])!!}
        @include('manzano.forms.manz')
        {!!Form::submit('REGISTRAR',['class'=>'btn btn-primary pull-right'])!!}
      {!!Form::close()!!}
       
      </div>
      <div class="modal-footer">
<!--footer del modal-->
      </div>
    </div>
  </div>
</div>


<!--MODAL ACTUALIZAR-->

<div class="modal fade" id="myModalManzano" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 id="titulogalpon" class="modal-title" >ACTUALIZAR MANZANO</h4>
      </div>

      <div class="modal-body">
 {!!Form::open(['route'=>['manzano.update','null'],'method'=>'PUT'])!!} 
      <input type="hidden" name="id_manzano" id="id_manzano">
        <div class="form-group">
            {!!Form::label('numero_ac','Numero Manzano:')!!}
            {!!Form::text('numero_ac',null,['class'=>'form-control ','placeholder'=>'Ingresa el numero del manzano'])!!}
        </div>

        <div class="form-group">
            {!!Form::label('id_proyecto_ac','Tipo de Proyecto:')!!}
            {!!Form::select('id_proyecto_ac',$proyectos,null,array('class'=>'form-control'))!!}
        </div>

        {!!Form::submit('ACTUALIZAR',['class'=>'btn btn-primary pull-right'])!!}
      {!!Form::close()!!}
       
      </div>
      <div class="modal-footer">
<!--footer del modal-->
      </div>
    </div>
  </div>
</div>