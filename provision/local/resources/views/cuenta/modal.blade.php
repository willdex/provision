<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 id="titulogalpon" class="modal-title" ></h4>
            </div>

            <div class="modal-body">
                {!!Form::open(['route'=>'cuenta.store', 'method'=>'POST'])!!}
                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                <div class="form-group">
                    {!!Form::label('Nombre','Nombre:')!!}
                    {!!Form::text('nombre',null,['id'=>'nombre','class'=>'form-control','placeholder'=>'Ingrese el Nombre de la cuenta'])!!}
                </div>
                <div class="form-group" >
                    <label>padre</label>
                    <select name="id_padre" class="form-control selectpicker" id="idcuenta" data-live-search="true" onchange="generarcodigo(this)">


                        <?php
                        echo '<option value="0">NO TIENE PADRE</option>';
                        foreach ($id_padre as $key => $value) {
                            echo ' <option value="' . $value->id . '">' . $value->codigo . ' ' . $value->nombre . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    {!!Form::label('tipo','Codigo:')!!}
                    {!!Form::text('codigo',null,['id'=>'tipo','class'=>'form-control','placeholder'=>'Codigo'])!!}
                </div>

                <div class="form-group">
                    {!!Form::label('utilizable','Utilizable:')!!}
                    {!!Form::select('utilizable', array('1' => 'SI', '0' => 'NO'),null,array('id'=>'tipo_gallina','class'=>'form-control'))!!}
                </div>

                <div class="form-group">
                    {!!Form::label('hijo','Hijo:')!!}
                    {!!Form::select('hijo', array('1' => 'SI', '0' => 'NO'),null,array('id'=>'tipo_gallina','class'=>'form-control'))!!}
                </div>
                <div class="form-group">
                    {!!Form::label('estado','Estado:')!!}
                    {!!Form::select('estado', array('1' => 'ACTIVO', '0' => 'INACTIVO'),null,array('id'=>'tipo_gallina','class'=>'form-control'))!!}
                </div>



            </div>

            <div class="modal-footer">
                {!!Form::submit('Registrar',['class'=>'btn btn-primary'])!!}
                {!!link_to('#', $title='CANCELAR', $attributes = ['id'=>'cancelar', 'class'=>'btn btn-danger'], $secure = null)!!}
                {!!Form::close()!!}
            </div>
        </div>
    </div>
</div>
