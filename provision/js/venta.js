cambio_moneda="";
$(document).ready(function(){

$('#loading').css('display','none');
    

});

function  precioventa(superficie){//este multiplica el precio de venta con la dimension del lote
cambio_moneda=$('#cambio_moneda').val();
precio_venta=superficie*parseInt($('#precio').val());
document.getElementById('precio_venta').value=precio_venta;
porcentaje=$('#descuento').val();
descuento=precio_venta*porcentaje/100;
pago_contado=precio_venta-descuento;
$('#pago_contado').val(pago_contado.toFixed(2));
$('#precio_venta_h').val(precio_venta);
$('#pago_contado_h').val(pago_contado.toFixed(2));
total_boliviano=pago_contado*cambio_moneda;
$('#pago_contado_bol').val(total_boliviano.toFixed(2));
$('#pago_contado_bol_h').val(total_boliviano.toFixed(2));

}
function verificarDescuento(){

$('#loading').css('display','block');
var descuento_guardado=$('#descuento_guardado').val();
	var descuento=$('#descuento').val();
	var id_descuento=$('#id_descuento').val();
$.get('../verificarDescuento/'+descuento+'/'+id_descuento,function(response){
	if ($('#precio_venta').val()!="") {
	if (response.mensaje==1) {//si es permitido
		porcentaje=$('#descuento').val();
descuento_venta=precio_venta*porcentaje/100;
pago_contado=precio_venta-descuento_venta;
$('#pago_contado').val(pago_contado.toFixed(2));
$('#pago_contado_h').val(pago_contado.toFixed(2));
total_boliviano=pago_contado*cambio_moneda;
$('#pago_contado_bol').val(total_boliviano.toFixed(2));
$('#pago_contado_bol_h').val(total_boliviano.toFixed(2));

	}else{//no es permitido
$('#descuento').val(descuento_guardado);
porcentaje=$('#descuento').val();
descuento_venta=precio_venta*porcentaje/100;
pago_contado=precio_venta-descuento_venta;
$('#pago_contado').val(pago_contado.toFixed(2));
$('#pago_contado_h').val(pago_contado.toFixed(2));
total_boliviano=pago_contado*cambio_moneda;
$('#pago_contado_bol').val(total_boliviano.toFixed(2));
$('#pago_contado_bol_h').val(total_boliviano.toFixed(2));

toastr.error('PORCENTAJE NO PERMITIDO');

	}
}else{
	if (response.mensaje==1) {
		
	}else{
$('#descuento').val(descuento_guardado);
porcentaje=$('#descuento').val();
descuento_venta=precio_venta*porcentaje/100;
pago_contado=precio_venta-descuento_venta;
$('#pago_contado').val(pago_contado.toFixed(2));
$('#pago_contado_h').val(pago_contado.toFixed(2));
total_boliviano=pago_contado*cambio_moneda;
$('#pago_contado_bol').val(total_boliviano.toFixed(2));
$('#pago_contado_bol_h').val(total_boliviano.toFixed(2));

toastr.error('PORCENTAJE NO PERMITIDO');
	}
}

$('#loading').css('display','none');

});
}

function verificarCarnet(){
$('#loading').css('display','block');

	var ci= $('input[name=ci]').val();
	$.get('../verificarCarnet/'+ci,function(response){
		if (response.mensaje==1) {
$('input[name=id_cliente]').val(0);

$('input[name=nombre]').val("");
	$('input[name=apellido]').val("");
	$('input[name=direccion]').val("");
	$('input[name=celular]').val("");
	$('input[name=nit]').val("");
	$('input[name=telefono]').val("");
	toastr.success('El Cliente es nuevo');

		}
		else{
	$('input[name=id_cliente]').val(response[0].id);

	$('input[name=nombre]').val(response[0].nombre);
	$('input[name=apellido]').val(response[0].apellido);
	$('input[name=direccion]').val(response[0].direccion);
	$('input[name=celular]').val(response[0].celular);
	$('input[name=nit]').val(response[0].nit);
	$('input[name=telefono]').val(response[0].telefono_adicional);
	toastr.info('El Cliente Existe');
		}
	$('input[name=nombre]').attr('disabled',false);
	$('input[name=apellido]').attr('disabled',false);
	$('input[name=direccion]').attr('disabled',false);
	$('input[name=celular]').attr('disabled',false);
	$('input[name=telefono]').attr('disabled',false);

	$('input[name=nit]').attr('disabled',false);

$('#loading').css('display','none');

	});
}
function probar(){
  window.parent.location.href = 'somePage.html'; 
}

function calcularCambio(){
  cambio_moneda=$('#cambio_moneda').val();
  total_boliviano=pago_contado*cambio_moneda;
$('#pago_contado_bol').val(total_boliviano.toFixed(2));
$('#pago_contado_bol_h').val(total_boliviano.toFixed(2));
}
function Validar_Reporte_Venta(){    
  var fecha_inicio = $("#fecha_inicio").val();
  var fecha_fin = $("#fecha_fin").val();
  if (fecha_inicio == "" || fecha_fin == "") {
        toastr.error('INTRODUSCA LAS 2 FECHAS'); 
      return false; 
  } else{
      var primera = Date.parse(fecha_inicio); 
      var segunda = Date.parse(fecha_fin); 
      if (primera > segunda) {
        toastr.error('LA FECHA INICIO TIENE QUE SER MAYOR QUE LA FECHA FIN'); 
      return false; 
      }else{
        toastr.success('CARGANDO REPORTE');         
        return true; 
      }      
  }
}

function ReporteVentas(){    
  var fecha_inicio = $("#fecha_inicio").val();
  var fecha_fin = $("#fecha_fin").val();
  if (fecha_inicio == "" || fecha_fin == "") {
        toastr.error('INTRODUSCA LAS 2 FECHAS'); 
  } else{
      var primera = Date.parse(fecha_inicio); 
      var segunda = Date.parse(fecha_fin); 
      if (primera > segunda) {
        toastr.error('LA FECHA INICIO TIENE QUE SER MAYOR QUE LA FECHA FIN'); 
      }else{
        window.open('ReporteVentaPDF/'+fecha_inicio+'/'+fecha_fin);         
        toastr.success('CARGANDO REPORTE');         
      }      
  }
}


