@extends ('layouts.inicio')
@section ('contenido')
@if(Session::has('message'))

<div class="alert alert-success alert-dismissible" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	{{Session::get('message')}}
</div>
@endif
@include('alerts.errors')

{!!Form::open(['route'=>'detalle.store', 'method'=>'POST'])!!}	
{{Form::token()}}      
<div class="row">
    <div class="col-lg-12 col-sm-12 col-xs-12" >
        <div class="form-group">
            <span><h1>{{$tipo_asiento[0]->nombre}}</h1></span>
              <input type="hidden" value="{{$tipo_asiento[0]->id}}" name="id_categoria" style="font-size: 20px" id="idcategoria"  class="form-control"  >
            <label for="gestion" style="font-size: 20pt">GESTION: {{$gestion[0]->nombre_gestion}}</label>  
            <br>
            <input type="hidden" value="{{$gestion[0]->id}}" name="id_gestion" style="font-size: 20px" id="id_gestion"  class="form-control"  >

            <label for="usuario"  style="font-size: 20pt">EMPLEADO: </label>
            <input type="hidden" id="id_empleado" name="id_usuario" value="{{$usuario[0]->id}}" class="form-control" >
                        <label for="usuario" style="font-size: 15pt ; color: #2672ec" >{{$usuario[0]->name}}</label>
        </div>
    </div>

    <div class="col-lg-2 col-sm-2 col-xs-12" >
        <div class="form-group">
            <label for="proveedor">FECHA: </label>
            <input type="date"  class="form-control" id="fecha1" name="fecha">


        </div>
    </div>
    <div class="col-lg-2 col-sm-2 col-xs-12" >
        <div class="form-group">
            <label for="moneda">Tipo De Cambio</label>
            <input name="cambio_tipo" type="text" value="{{$moneda[0]->cambio}}" class="form-control" id="tipocambio" onclick="extraerid(this)">    
                <input type="hidden" value="{{$moneda[0]->id}}" name="id_moneda" style="font-size: 20px" id="idtipocambio"  class="form-control"  >

        </div>
    </div>

    <div class="col-lg-3 col-sm-3 col-xs-12" >
        <div class="form-group" >
            <label>cuenta</label>
            <select name="cuenta" class="form-control selectpicker" id="idcuenta" data-live-search="true">
                @foreach($cuenta as $cuenta)
                <option value="{{$cuenta->id}}">{{$cuenta->nombre}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row" >

        <div class="col-lg-1 col-sm-1 col-xs-12" >
            <div class="form-group" >
                <label>Debe</label>
                <input type="number" class="form-control" id="iddebe" onclick="desabilitar('idhaber',this)" >
            </div>
            <div class="form-group" >
                <label>Haber</label>
                <input type="number" class="form-control" id="idhaber" onclick="desabilitar('iddebe',this)">
            </div>
        </div>


        <div class="col-lg-3 col-sm-3 col-xs-12" >
            <div class="form-group" >
                <input id="bt_add" type="button" class="btn btn-primary" onclick="agregar()" value="Agregar">

            </div>
            <div class="form-group" >
                <button id="bt_add" class="btn btn-danger">Eliminar</button>
            </div>
        </div>
    </div>
    <div class="col-lg-12 col-sm-12 col-xs-12" >



        <div class="panel panel-primary" >

            <div class="panel-body" >

                <div class="table-responsive">
                    <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                        <thead style="background-color: #A9D0F5">
                        <th>Operacion</th>
                        <th>Codigo</th>


                        <th>Detalle</th>
                        <th>Debe Bs</th>
                        <th>Haber Bs</th>
                        <th>Debe $us</th>
                        <th>Haber $us</th>


                        </thead>

                        <tbody id="detalles">
                            
                        </tbody>
                        <tfoot>
                        <th>TOTAL HABER <br>TOTAL DEBE </th>
                        <th></th>
                        <th></th>
                        <th><h4 name='total_debe' id="totaldebe">S/. 0.00</h4></th>
                        <th><h4 name='total_haber' id="totalhaber">S/. 0.00</h4></th>
                        <th><h4 id="totaldebed">$/. 0.00</h4></th>
                        <th><h4 id="totalhaberd">$/. 0.00</h4></th>
                        </tfoot>
                    </table>
                </div>
            </div>

        </div>
    </div>
    <div  class="col-lg-6 col-sm-6 col-md-6 col-xs-12" id="guardar" >
        <div class="form-group" >
            <label>GLOSA :</label>
            <textarea class="form-control" rows="5" id="glosa" name='glosa'></textarea>
        </div>
        <div class="form-group" >
            {!!Form::submit('Registrar',['class'=>'btn btn-primary','onclick'=>'guardar()'])!!}
            <button class="btn btn-danger">Cancerlar</button>
           {!!Form::close()!!}
        </div>
        <!--    <div id="" class="col-lg-6 col-sm-6 col-md-6 col-xs-12" id="guardar" >
                <div class="form-group" >
                    <input type="hidden" class="" value="{{csrf_token()}}" >
                    <button class="btn btn-primary">Guardar</button>
                    <button class="btn btn-danger">Cancerlar</button>
                </div>
        
            </div>-->
    </div>
</div>






@endsection
<script src="{{asset('js/addasiento.js')}}" ></script>