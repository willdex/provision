@extends('layouts.inicio')
@section('contenido')
@include('alerts.errors')

<div class="row">	
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <font size="6">PROYECTOS</font>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 pull-right">
            <div class="pull-right">
                <a class="btn btn-success" href="{!!URL::to('Proyecto/create')!!}">REGISTRAR</a> 
            </div>
        </div>    
    </div>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                <th><CENTER>NOMBRE</CENTER></th>
                <th><CENTER>UBICACION</CENTER></th>
                <th><CENTER>OPCION</CENTER></th>
                </thead>
                @foreach ($proyecto as $cli)
                <TR>
                <td><CENTER>{{$cli->nombre}}</CENTER></td>
                <td><CENTER>{{$cli->ubicacion}}</CENTER></td>
                <td><CENTER>
                {!!link_to_route('Proyecto.edit', $title = 'ACTUALIZAR', $parameters = $cli->id, $attributes = ['class'=>'btn btn-primary'])!!} 
                </CENTER></td>
                </TR>
                @endforeach 
            </table>
            {!!$proyecto->render()!!}
        </div>
    </div>
</div>

    @endsection