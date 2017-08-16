    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

<div class="form-group">
		{!!Form::label('nombre','Nombre:')!!}
		{!!Form::text('nombre',null,['class'=>'form-control','placeholder'=>'ingrese nombre'])!!}
	</div>

	</div>
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

<div class="form-group">
		{!!Form::label('nombre','Tipo Objeto:')!!}
		<select class="form-control" name="tipoObjeto">
			<option value="0">Seleccione un Tipo de Objeto</option>

			<option value="Formulario">Formulario</option>
			<option value="Reporte">Reporte</option>

		</select>
	</div>

	</div>
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">


<div class="form-group">
		{!!Form::label('url','Url:')!!}
		{!!Form::text('urlObjeto',null,['class'=>'form-control','placeholder'=>'ingrese la URL'])!!}
	</div>

	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">


<div class="form-group">
		{!!Form::label('estado','Habilitado')!!}
	
		<label>
	 {!!Form::radio('estado',0,['class'=>'form-control','checked'=>'false'])!!}No</label>
	 <label>
	  {!!Form::radio('estado',1,['class'=>'form-control'])!!}Si</label>
	</div>

	</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">


<div class="form-group">
		{!!Form::label('url','Visible en menu')!!}
				<label>
	 {!!Form::radio('visibleEnMenu',0,['class'=>'form-control','checked'=>'false'])!!}No</label>
				<label>
	 
	  {!!Form::radio('visibleEnMenu',1,['class'=>'form-control'])!!}Si</label>
	</div>

	</div>
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">


<div class="form-group">
		{!!Form::label('modulo','Modulo')!!}
{!!Form::select('idModulo',$idModulo,null,array('class'=>'form-control'))!!}

	
		
	</div>

	</div>