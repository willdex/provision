@extends('layouts.inicio')
@section('contenido')
@include('alerts.success')
@include('alerts.request')
@include('alerts.errors')


                @include('manzano.modal')
                <div class="panel panel-success">
     <div class="panel-heading">
          <ul class="nav nav-pills">
               <li class=""><a href="{!!URL::to('lote')!!}">LOTES</a></li> 
            <li class="active"><a href="#">MANZANO</a></li>                        
        </ul>
    </div>  
                    <div class="panel-body">

               
  <div class="row"> 
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="table-responsive">
        <FONT size="6">MANZANO</FONT>
        <button class="btn btn-success pull-right" data-toggle='modal' data-target='#myModal'> <i class="fa fa-plus-square" aria-hidden="true"></i> </button>        
        <table class="table table-striped table-bordered table-condensed table-hover">
        <thead>
        <th><CENTER>NOMBRE</CENTER></th>
                
        <th><CENTER>PROYECTO</CENTER></th>
        <th><CENTER>OPCION</CENTER></th>
     
        
        
        </thead>
         @foreach ($manzano as $mz)
            <TR>
            <td><CENTER>MZ-{{$mz->numero}}</CENTER></td>
            <td><CENTER>{{$mz->nombre_pro}}</CENTER></td>
            <td><CENTER>
             <button class="btn btn-primary" data-toggle="modal" data-target="#myModalManzano" onclick="CargarManzano({{$mz->id}});">ACTUALIZAR</button>
            </CENTER></td>
        </TR>
        @endforeach 
        </table>
    {!!$manzano->render()!!}
    </div>
</div>
</div>
</div>
   {!!Html::script('js/manzano.js')!!}

    @endsection