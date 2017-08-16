@extends ('layouts.inicio')
@section ('contenido')
@if(Session::has('message'))
<div class="alert alert-success alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    {{Session::get('message')}}
</div>
@endif
@include('alerts.request')
 <H1>{{$id_empresa[0]->nombre}}</H1>
<div class="row">	
    <div class="col-lg-3 col-md-3 col-sm-5 col-xs-12">
        <div class="form-group" >
            <button class="btn btn-primary" onclick="reporte_libro_diario()"> Buscar</button>
        <input type="date" id="fecha" class="form-control">
         <input type="date" id="fecha2" class="form-control">
        </div>
      
    </div>
   
    </div>
    <div class="row">	
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">	
               

                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead style='background-color: #8CDF33'>
                    <th ><CENTER>Nro</CENTER></th>
                    <th><CENTER>Fecha</CENTER></th>
                    <th><CENTER>Tipo</CENTER></th>
                    <th><CENTER>Glosa</CENTER></th>
                    <th><CENTER>Codigo</CENTER></th>	
                    <th><CENTER>Nombre</CENTER></th>	
                    <th><CENTER>Debe Bs</CENTER></th>	
                    <th><CENTER>Haber Bs</CENTER></th>	
                    </thead>

                    <tbody id="tabla">
                        
                    </tbody>
                        
                </table>

            </div>

        </div>
    </div>
<script src="{{asset('js/reportes.js')}}">  
</script>
    @endsection

