<div class="form-group">
		{!!Form::label('nombre','nombre:')!!}
		{!!Form::text('nombre',null,['class'=>'form-control','placeholder'=>'ingrese nombre'])!!}
	</div>
<div class="form-group">
		{!!Form::label('nombre','Minutos Tolerancia:')!!}
		<input type="range" name="MminutosTolerancia" min="0" max="15">
	</div>

