<div class="row">
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

<div class="form-group">
			{!!Form::label('nrocuenta','Nro de Cuenta:')!!}
			{!!Form::text('nrocuenta',null,['class'=>'form-control ','placeholder'=>'Ingrese Nro de Cuenta'])!!}
		</div>

	    <div class="form-group" >
	        {!!Form::label('banco','Banco:')!!}                
	        <select name="banco" class="form-control selectpicker" id="banco" data-live-search="true">
	         <option value="">SELECCIONE UN BANCO</option>
	            @foreach($banco as $ban)
	            <option value="{{$ban->id}}">{{$ban->nombre}}</option>
	            @endforeach
	        </select>
	    </div>

</div>

</div>