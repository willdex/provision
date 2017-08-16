<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 id="titulogalpon" class="modal-title" >CREAR CLIENTE</h4>
      </div>

      <div class="modal-body">
      {!!Form::open(['route'=>'cliente.store', 'method'=>'POST'])!!}
		@include('cliente.forms.cli')
		{!!Form::submit('Registrar',['class'=>'btn btn-primary'])!!}
	{!!Form::close()!!}
       
  </div>

      <div class="modal-footer">

<!--footer del modal-->
      </div>
    </div>
  </div>
</div>

<!-- MODAL ACTUALIZAR-->

<div class="modal fade" id="myModalActualizar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 id="titulogalpon" class="modal-title" >ACTUALIZAR CLIENTE</h4>
      </div>

      <div class="modal-body">
     {!!Form::open(['route'=>['cliente.update','null'],'method'=>'PUT'])!!} 
    
    
    <input type="hidden" name="id_cliente" id="id_cliente">
<div class="form-group">
    {!!Form::label('nombre_cliente','Nombre:')!!}
    {!!Form::text('nombre_cliente',null,['class'=>'form-control ','placeholder'=>'Ingresa el Nombre del cliente'])!!}
</div>

<div class="form-group">
    {!!Form::label('apellido_cliente','Apellido:')!!}
    {!!Form::text('apellido_cliente',null,['class'=>'form-control ','placeholder'=>'Ingresa el Apellido del cliente'])!!}
</div>

<div class="form-group">
    {!!Form::label('ci_cliente','CI:')!!}
    {!!Form::text('ci_cliente',null,['class'=>'form-control ','placeholder'=>'Ingresa el CI del cliente'])!!}
</div>

<div class="form-group">
    {!!Form::label('direccion_cliente','Dirección:')!!}
    {!!Form::text('direccion_cliente',null,['class'=>'form-control ','placeholder'=>'Ingresa el Dirección del cliente'])!!}
</div>

<div class="form-group">
    {!!Form::label('celular_cliente','Celular:')!!}
    {!!Form::text('celular_cliente',null,['class'=>'form-control ','placeholder'=>'Ingresa el Nro de Celular del cliente'])!!}
</div>

<div class="form-group">
    {!!Form::label('telefono_cliente','Telefono Adicional:')!!}
    {!!Form::text('telefono_cliente',null,['class'=>'form-control ','placeholder'=>'Ingresa el Nro de Telefono Adicional del cliente'])!!}
</div>

<div class="form-group">
    {!!Form::label('nit_cliente','NIT:')!!}
    {!!Form::text('nit_cliente',null,['class'=>'form-control ','placeholder'=>'Ingresa el Nro de NIT del cliente'])!!}
</div>

    {!!Form::submit('Actualizar',['class'=>'btn btn-primary'])!!}
  {!!Form::close()!!}
       
  </div>

      <div class="modal-footer">

<!--footer del modal-->
      </div>
    </div>
  </div>
</div>

