@extends('layouts.inicio')
@section('contenido')
@include('alerts.cargando')

@include('alerts.errors')
@include('alerts.success')


<div class="row">   
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <font size="6">PRE RESERVA</font>
        </div>
       
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 pull-right">    
            <div class="pull-right">
                <a type="button" class="btn btn-success" id="btn_agregar" onclick="crear()">REGISTRAR</a> 
            </div>
        </div>     
         
    </div>
         {!!Form::open(['route'=>'PreReserva.store', 'method'=>'POST' , 'enctype'=>'multipart/form-data','onKeypress'=>'if(event.keyCode == 13) event.returnValue = false;'])!!} 

        <!--div class=" col-lg-3 col-md-3 col-sm-3 col-xs-12 ">
            Codigo Vendedor:
            <select name="idVendedor" class="form-control selectpicker" data-live-search="true">
            <option value="0">seleccione</option>
            @<?php foreach ($vendedor as $key => $value): ?>
                <option value="{{$value->id}}">{{$value->codigo}}</option>                
            <?php endforeach ?>
            </select>
        </div-->   


    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <table class="table table-striped table-bordered table-condensed table-hover">
        <thead>
            <tr>
                <th><center>URBANIZACION</center></th>
                <th><center>FASE</center></th>
                <th><center>MANZANO</center></th>
                <th><center>LOTE</center></th>
                <th><center>DETALLE</center></th>
                <th><center><button type="button" id="btn_agre" class="btn btn-success" onclick="agregar()"><i class="fa fa-plus" aria-hidden="true"></i></button></center></th>
            </tr>
        </thead>
        <tbody id="body_busqueda"></tbody>
        </table>
      </div>
            <?php /*<tr>
                <td> Nro. Lote: <input type="text" id="nro_lote" class="form-control" placeholder="Nro Lote"> </td>
                <td> Nro. Manzano: <input type="text" id="nro_manzano" class="form-control" placeholder="Nro Manzano"> </td>
                <td> <button type="button" class="btn btn-info" onclick="Buscar_Lote()"><i class="fa fa-search" aria-hidden="true"></i></button></td>
            </tr>*/ ?>


      <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" id="div_crear_1">
            <div class="form-group">
                {!!Form::label('ci','Carnet:')!!}
                {!!Form::text('ci',null,['class'=>'form-control ','placeholder'=>'Carnet','onchange'=>'BuscarCliente()','onkeypress'=>'return bloqueo_de_punto(event)'])!!}
            </div>     
            <div class="form-group">
                {!!Form::label('expedido','Expedido:')!!}
                <select name="expedido" class="form-control">
                    <option value="SC">[SC] SANTA CRUZ</option>
                    <option value="LP">[LP] LA PAZ</option>
                    <option value="CB">[CB] COCHABAMBA</option>
                    <option value="BN">[BN] BENI</option>
                    <option value="CH">[CH] CHUQUISACA</option>
                    <option value="PA">[PA] PANDO</option>
                    <option value="TJ">[TJ] TARIJA</option>
                    <option value="PT">[PT] POTOSI</option>

                    <option value="OR">[OR] ORURO</option>
                      <option value="EX">[EX] EXTRANJERO</option>
                </select>
            </div>
             <div class="form-group">
                {!!Form::label('nacionalidad','Nacionalidad:')!!}
                <select name="idPais" class="form-control"  id="nacionalidad">
                    <?php foreach ($nacionalidad as $key => $value) {
                        echo "<option value=".$value->id.">".$value->paisnombre;
                    } ?>
                </select>
            </div>        
            <div class="form-group">
                {!!Form::label('nombre','Nombre:')!!}
                <input  class="form-control" name="nombre" type="text" value="" style="text-transform:uppercase;" >
                
            </div>
            <div class="form-group">
                {!!Form::label('apellidos','Apellidos:')!!}
                <input  class="form-control" name="apellidos" type="text" value="" style="text-transform:uppercase;" >
            </div>
             <div class="form-group">
                {!!Form::label('ocupacion','Ocupacion:')!!}
                <input  class="form-control" name="ocupacion" type="text" value="" style="text-transform:uppercase;" >
            </div>
            <div class="form-group">
                {!!Form::label('fechaNacimiento','Fecha Nacimiento:')!!}
                {!!Form::date('fechaNacimiento',null,['class'=>'form-control ','placeholder'=>'Fecha Nacimiento'])!!}
            </div>
          
            <div class="form-group">
                {!!Form::label('lugarProcedencia','Ciudad de Procedencia:')!!}
                <input type="text" name="lugarProcedencia" class="form-control" style="text-transform:uppercase;" >
            </div>
      </div> 

      <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" id="div_crear_2">
            <div class="form-group">
                {!!Form::label('genero','Genero:')!!} <br>
                 <label><input type="radio" name="genero" id="m" value="m" checked=""> Masculino</label>
                 <label><input type="radio" name="genero" id="f" value="f"> Femenino</label>
            </div>


            <div class="form-group">
                {!!Form::label('celular','Celular:')!!}
                {!!Form::text('celular',null,['class'=>'form-control ','placeholder'=>'Celular','onkeypress'=>'return bloqueo_de_punto(event)'])!!}
            </div>  
            <div class="form-group">
                {!!Form::label('celular_ref','Celular Referencia:')!!}
                {!!Form::text('celular_ref',null,['class'=>'form-control ','placeholder'=>'Celular Referencia','onkeypress'=>'return bloqueo_de_punto(event)'])!!}
            </div>   
            <div class="form-group">
                {!!Form::label('estadoCivil','Estado Civil:')!!}
                {!!Form::select('estadoCivil', array('s' => 'SOLTERO(A)', 'c' => 'CASADO(A)', 'v' => 'VIUDO(A)', 'd' => 'DIVORCIADO(A)'),null,array('id'=>'estado','class'=>'form-control'))!!}
            </div>  
            <div class="form-group">
                {!!Form::label('domicilio','Domicilio:')!!}
                {!!Form::text('domicilio',null,['class'=>'form-control ','placeholder'=>'Domicilio'])!!}
            </div>  
            <div class="form-group">
                {!!Form::label('nit','NIT:')!!}
                {!!Form::text('nit',0,['class'=>'form-control ','placeholder'=>'NIT','onkeypress'=>'return bloqueo_de_punto(event)'])!!}
            </div>    
            <div class="pull-right">
                {!!Form::submit('RESERVAR',['class'=>'btn btn-primary','id'=>'btn_registrar','onclick'=>'btn_esconder()'])!!}
                <a href="{!!URL::to('PreReserva')!!}" class="btn btn-danger">CANCELAR</a>
            </div>                                                                                                             
      </div> 
    </div>

{!!Form::close()!!}

</div>
{!!Html::script('js/pre_reserva.js')!!}
@endsection