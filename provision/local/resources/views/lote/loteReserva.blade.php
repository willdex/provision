@extends('layouts.inicio')

@section('contenido')
@include('alerts.success')
@include('alerts.request')
@include('alerts.errors')


{!!Html::script('js/mapas.js')!!}

<div class="panel panel-success">
     <div class="panel-heading">
          <ul class="nav nav-pills">
            
        
       <li onclick="cambiomapa(3)" class=" pull-right"><a href="#">FASE 3</a></li>
            <li onclick="cambiomapa(2)" class=" pull-right"><a href="#">FASE 2</a></li>
               
            <li  onclick="cambiomapa(1)"class=" pull-right"><a href="#">FASE 1</a></li>
  <input type="hidden" value="{!!URL::to('seccion2/1')!!}" id="mapa2">
  <input type="hidden" value="{!!URL::to('seccion3/1')!!}" id="mapa3">

  <input type="hidden" value="{!!URL::to('seccion1/1')!!}" id="mapa1">
        </ul>
        
    </div>  
  <div class="panel-body">
                     

                     
      <iframe id="seccion" style="border: none; height: 800px ; overflow: none;width: 100%" src="{!!URL::to('seccion1/1')!!}">
                         
                     </iframe>
                     
</div>
  <div class="panel-footer">Pie del panel</div>
</div>

                  

    @endsection
