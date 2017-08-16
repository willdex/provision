$(document).ready(function(){
    // $('#btn_agregar').hide();      
    // $('#div_crear_1').hide();      
    // $('#div_crear_2').hide();     
    $('#loading').css('display','none');     
BuscarCliente();


});

function crear(){
  $("#div_crear_1").show();
  $("#div_crear_2").show();
}

var id_lote = [];
var nro_lote = [];
var nro_manzano = [];
var cont = 0;

//AGREGAR
function agregar(){
    $("#btn_agre").hide();  
    tabladatos = $('#body_busqueda');
    var fila = '<tr id="fila'+cont+'" align=center>\n\
        <td><input name="nro_lote[]" id="nro_lote'+cont+'" type="text" placeholder="Nro Lote" size="10" style="text-align: center;" onkeypress="return bloqueo_de_punto(event)"></td>\n\
        <td><input name="nro_manzano[]" id="nro_manzano'+cont+'" type="text" placeholder="Nro Manzano" size="10" style="text-align: center;" onkeypress="return bloqueo_de_punto(event)"></td>\n\
        <td><button type="button" class="btn-sm btn-info" title=Buscar onclick="Buscar_Lote(' + cont + ')"><i class="fa fa-search" aria-hidden="true"></i></button></td>\n\
        <td align=left><input name="id_lote[]" id="id_lote'+cont+'" type="hidden"> Nro. Lote: <font id="lote'+cont+'" size="4"> </font><br>\n\
        Nro. Manzano: <font id="manzano'+cont+'" size="4"> </font><br>  Precio: <font id="precio'+cont+'" size="4"> </font><br>  Superficie: <font id="superficie'+cont+'" size="4"> </font><br>\n\
        Proyecto: <font id="proyecto'+cont+'" size="4"> </font><br>  Estado: <font id="estado'+cont+'" size="4"> </font><br>   </td>\n\
       <td> <button type="button" id="btn_eli'+cont+'" class="btn-sm btn-danger" title=Eliminar onclick="Eliminar_lista(' + cont + ')"><i class="fa fa-trash-o" aria-hidden="true"></i></button></td></tr>';            
    $('#body_busqueda').append(fila);
}
function Eliminar_lista(index){
  $('#fila' + index).remove();
  $("#btn_agre").show();   
  cont++;
}


function BuscarCliente(){
 EstadoCivil= $('#estadoCivil');
 ci=$("input[name=ci]").val();
if (ci !="" || ci!="0") {
  $.get('../verificarCarnet/'+ci, function(res){
      if (res[0].contador == 0) {
      toastr.info("EL CLIENTE ES NUEVO");
      $("input[name=nombre]").val("");
      $("input[name=apellidos]").val("");
      $("input[name=fechaNacimiento]").val("");
      $("input[name=celular]").val("");
      $("input[name=celular_ref]").val("");
      $("input[name=lugarProcedencia]").val("");
      $("input[name=ocupacion]").val("");
 
      $("input[name=domicilio]").val("");
      $("input[name=nit]").val("");
      $("input[name=idCliente]").val('0');
       document.getElementById("m").checked = false;                      
       document.getElementById("f").checked = false;                    
    } else {
      $("input[name=idCliente]").val(res[0].id);
      $("input[name=ocupacion]").val(res[0].ocupacion);

      $("select[name=expedido]").val(res[0].expedido);
      $("input[name=nombre]").val(res[0].nombre);
      $("input[name=apellidos]").val(res[0].apellidos);
      $("input[name=fechaNacimiento]").val(res[0].fechaNacimiento);
      $("select[name=idPais]").val(res[0].idPais);
      $("input[name=celular]").val(res[0].celular);
      $("input[name=celular_ref]").val(res[0].celular_ref);
      $("input[name=lugarProcedencia]").val(res[0].lugarProcedencia);
      $("select[name=estadoCivil]").val(res[0].estadoCivil);
      $("input[name=domicilio]").val(res[0].domicilio);
      $("input[name=nit]").val(res[0].nit);
      if (res[0].genero == 'm') {
       document.getElementById("m").checked = true;                      
      } else {
       document.getElementById("f").checked = true;                
      }
      toastr.success("EXISTE ESE CLIENTE");      
    }
  });
  }else{
     $("input[name=nombre]").val("");
      $("input[name=apellidos]").val("");
      $("input[name=fechaNacimiento]").val("");
      $("input[name=celular]").val("");
      $("input[name=celular_ref]").val("");
      $("input[name=lugarProcedencia]").val("");
      $("input[name=ocupacion]").val("");
 
      $("input[name=domicilio]").val("");
      $("input[name=nit]").val("");
      $("input[name=idCliente]").val('0');
       document.getElementById("m").checked = false;                      
       document.getElementById("f").checked = false;       
  }
}



function Buscar_Lote(id){
  nro_lote = $("#nro_lote"+id).val();
  nro_manzano = $("#nro_manzano"+id).val();
    $('#loading').css('display','block');     

  if ($("#nro_lote"+id).val() == "" || $("#nro_manzano"+id).val() == "") {
     toastr.error('INTRODUSCA LOS DATOS CORRESPONDIENTES');    
  } else {
      $.get('Buscar_Lote/'+nro_lote+"/"+nro_manzano , function (response) { 
        if (response[0].contador == 0) {
          alert('NO EXISTE ESE TERRENO');                 
          $("#btn_agregar").hide();
          $("#lote"+id).text("");            
          $("#manzano"+id).text("");            
          $("#precio"+id).text("");            
          $("#superficie"+id).text("");            
          $("#proyecto"+id).text("");                                           
          $("#estado"+id).text("");  
          $("#btn_agre").hide();                                                     
        } else {
          if (response[0].estado == 0) {
              $("#id_lote"+id).val(response[0].id_lote);            
              $("#lote"+id).text(response[0].nroLote);            
              $("#manzano"+id).text(response[0].manzano);            
              $("#precio"+id).text(response[0].precio);            
              $("#superficie"+id).text(response[0].superficie +" Km²");            
              $("#proyecto"+id).text(response[0].nombre);  
              switch(response[0].estado) {
                  case 0:
                      $("#estado"+id).text("DISPONIBLE");  
                      $("#btn_agregar").show(); 
                      $("#btn_eli"+id).show();
                      $("#btn_agre").show();                                                                           
                      cont++;                                          
                      break;
                  case 1:
                      $("#estado"+id).text("PRE-RESERVA");                                          
                      $("#btn_agregar").hide();
                      $("#btn_eli"+id).hide(); 
                      $("#btn_agre").hide();                                                     
                      break;
                  case 2:
                      $("#estado"+id).text("RESERVA");                                          
                      $("#btn_agregar").hide();
                      $("#btn_eli"+id).hide(); 
                      $("#btn_agre").hide();                                                     
                      break;       
                  case 3:
                      $("#estado"+id).text("COMPRADO");                                          
                      $("#btn_agregar").hide();
                      $("#btn_eli"+id).hide(); 
                      $("#btn_agre").hide();                                                     
                      break;                        
              }            
          } else {
             toastr.error("ESE LOTE NO ESTA DISPONIBLE");
            $("#btn_agregar").hide();
            $("#btn_agre").hide();                                                     
          }

        } 
    $('#loading').css('display','none');     

      });
  }
}
function cargarBanco(radio){

    $('#loading').css('display','block');      
  banco=$('select[name=bancoC]');
   cuenta=$('select[name=cuentaC]');
   documento=$('input[name=nroDocumentoC]');
   montoEfectivo=$('input[name=montoEfectivo]');
   montobanco=$('input[name=montoBanco]');
divBanco=$('#divBanco');
divMontoMixto=$('#divMontoMixto');

  if ($(radio).val()=="b") {

divBanco.css('display','block');
divMontoMixto.css('display','none');
     montoEfectivo.empty();
   montobanco.empty();
     $('select[name=bancoC]').empty();
    $.get('../cargarBanco',function(res){
        banco.append('<option value=0> Seleccione un Banco') ;
        for (var i = 0; i < res.length; i++) {
          banco.append('<option value='+res[i].id+'>'+res[i].nombre) ;
        }
    $('#loading').css('display','none');      

    });
  }
  else{
    if ($(radio).val()=="be") {
  
divBanco.css('display','block');
divMontoMixto.css('display','block');

     $('select[name=bancoC]').empty();
    $.get('../cargarBanco',function(res){
        $('select[name=bancoC]').append('<option value=0> Seleccione un Banco') ;
        for (var i = 0; i < res.length; i++) {
           banco.append('<option value='+res[i].id+'>'+res[i].nombre) ;
        }
    $('#loading').css('display','none');      

    });
  }else{
    banco.empty();

   cuenta.empty();
   divBanco.css('display','none');
   divMontoMixto.css('display','none');
      montoEfectivo.empty();
   montobanco.empty();
   $('input[name=nroDocumentoC]').val("");
   $('input[name=montoBancoC]').val("");
  
  
    $('#loading').css('display','none');      

  }
}
}

function cargarCuenta(select){
    $('#loading').css('display','block');      

  idBanco=$(select).val();
    $('select[name=cuentaC]').css('display','block');     

    $('select[name=cuentaC]').empty();
    $.get('../cargarCuenta/'+idBanco,function(res){
        for (var i = 0; i < res.length; i++) {
           $('select[name=cuentaC]').append('<option value='+res[i].id+'>'+res[i]. nroCuenta) ;
        }
    $('#loading').css('display','none');      

    });
  
}
function CargarTabla(radio){
  montoBanco=$('input[name=montoBanco]');
  montoEfectivo=$('input[name=montoEfectivo]');
montoBanco.val("");
montoEfectivo.val("");

  if ($(radio).val()=='c') {
   $('#TablaContado').css('display','block');
  $('#TablaPlazo').css('display','none');


  }
  else{
  $('#TablaPlazo').css('display','block');
  $('#TablaContado').css('display','none');}


}

function CalcularPagos(select){
  pago=$('input[name=Pago]').val();
    PrecioLote=$('input[name=precio]').val();
  Superficie=$('input[name=superficie]').val();
  plazo=$(select).val();
  tipoCambio=$('input[name=TipoDeCambio]').val();


  if (pago=="") {

  PrecioTotal=PrecioLote*Superficie;
  cuota=PrecioTotal/plazo;
// cuotaBs=tipoCambio*cuota;
  $('input[name=cuotaMensual]').val((cuota).toFixed(2));
      }
      else{
        PrecioTotal=PrecioLote*Superficie;
        PrecioTotalBs=PrecioTotal;
        PrecioTotalMenosCuota=PrecioTotalBs-pago;
        cuota=PrecioTotalMenosCuota/plazo;

        if (cuota % 1 == 0) {
         $('input[name=cuotaMensual]').val(cuota)  ;
         
    }
    else{
         cuotaTotal=Math.trunc(cuota)+1;
          $('input[name=cuotaMensual]').val(cuotaTotal)  ;
    }
       
      
      }

}
function Verificar(){


}
function PagoInicial(select){//este viene del select calculando el pago inicial
  $('input[name=sumarDecimal]').val("");
  
    // pagominimo=parseInt($('input[name=pago]').val());
CuotaMinima=$('input[name=CuotaMinima]').val();//porcentaje cuota minima
    // pago=$('input[name=pago]').val();
    PrecioLote=$('input[name=precio]').val();
  Superficie=$('input[name=superficie]').val();
  plazo=$('input[name=meses]').val();
  tipoCambio=$('input[name=TipoDeCambio]').val();
PrecioPlazo=$('input[name=PrecioPlazo]').val();
pagoInicial=$('input[name=pagoInicial]');
totalPagado=$('input[name=totalPagado]');
cuotaMensual=$('input[name=cuotaMensual]');
reserva=$('input[name=reserva]').val();
 CuatoInicial=(PrecioPlazo*CuotaMinima/100).toFixed(0)-reserva;
PagoInicialReserva=CuatoInicial+parseInt(reserva);
   
seleccion=$(select).val();
if (seleccion=='0') {
  pagoInicial.css('display','block');
  pagoInicial.attr('readonly',true);
pagoInicial.val(CuatoInicial);

totalPagado.val(PagoInicialReserva);
      
        PrecioTotalMenosCuota=PrecioPlazo-PagoInicialReserva;
        cuota=PrecioTotalMenosCuota/plazo;

        if (cuota % 1 == 0) {
        cuotaMensual.val(cuota)  ;
       
    }
    else{

         cuotaTotal=Math.trunc(cuota)+1;
 sumarDecimal(cuota,cuotaTotal);

          cuotaMensual.val(cuotaTotal)  ;

    }

    $('input[name=totalPagado]').val(PagoInicialReserva);

}
else{
  $('input[name=pagoInicial]').attr('readonly',false);
totalPagado.val("");
  $('input[name=pagoInicial]').css('display','block');
  $('input[name=cuotaMensual]').val("");
}
}

function verificarPlazo(input){
  plazo=$(input).val();
  DescuentoPlazo=$('input[name=DescuentoPlazo]');
  PrecioPlazo=$('input[name=PrecioPlazo]');
   Precio=$('input[name=precio]').val();
  Superficie=$('input[name=superficie]').val();
PrecioLote=Precio*Superficie;
  if (plazo=="" || plazo==0) {totalPagadoBs
  $('input[name=pagoInicial]').css('display','none');
  $('input[name=totalPagadoBs]').val("");

    $('select[name=SelectPagoInicial]').css('display','none');
     DescuentoPlazo.val("");
  }else{
  $('input[name=totalPagadoBs]').val("");

  $('select[name=SelectPagoInicial]').css('display','block');
  $('input[name=pagoInicial]').val("");
  $('input[name=cuotaMensual]').val("")  ;
  if (plazo<=12) {
      DescuentoPlazo.val('10');

      total=PrecioLote-(PrecioLote*10/100);
PrecioPlazo.val(parseInt(total));
return;
  }else{
      if (plazo>12 && plazo<=24) {
           DescuentoPlazo.val('5');
           total=PrecioLote-(PrecioLote*5/100);
           PrecioPlazo.val(parseInt(total));
          return;
         }   


  }
      
         DescuentoPlazo.val('0');
     PrecioPlazo.val(parseInt(PrecioLote));
  }
  }


function VerificarPagoInicial(input){//este se encarga e verificar que el pago sea mayor al minimo
     // pagominimo=parseInt($('input[name=pago]').val());
CuotaMinima=$('input[name=CuotaMinima]').val();//porcentaje cuota minima
    // pago=$('input[name=pago]').val();
  plazo=$('input[name=meses]').val();
PrecioPlazo=$('input[name=PrecioPlazo]').val();
pagoInicial=$('input[name=pagoInicial]').val();
cuotaMensual=$('input[name=cuotaMensual]').val();
reserva=$('input[name=reserva]').val();
 CuatoInicial=(PrecioPlazo*CuotaMinima/100).toFixed(0)-reserva;
PagoInicialReserva=parseInt(pagoInicial)+parseInt(reserva);
  $('input[name=sumarDecimal]').val("");
 totalPagado= $('input[name=totalPagado]').val("");
pago=parseInt($(input).val());

if (parseInt(pagoInicial)<CuatoInicial) {//este verifica que el pago sea mayor al minimo
  toastr.error('El pago tiene que ser mayor al minimo');
          $('input[name=cuotaMensual]').val("")  ;

$(input).val("");
}
else{

  toastr.success('Pago Permitido');
    
    

     PrecioTotalMenosCuota=PrecioPlazo-pagoInicial;
          
        cuota=PrecioTotalMenosCuota/plazo;

        if (cuota % 1 == 0) {
         $('input[name=cuotaMensual]').val(cuota)  ;

         
    }
    else{
         cuotaTotal=Math.trunc(cuota)+1;
         sumarDecimal(cuota,cuotaTotal);
          $('input[name=cuotaMensual]').val(cuotaTotal)  ;
    }

    totalPagado.val(PagoInicialReserva);
}
}

function sumarDecimal(numero,entero){

meses=$('input[name=meses]').val();
total=numero-entero;
totalpormeses=total*meses;
totalpositivo=(totalpormeses*-1).toFixed(2);
$('input[name=sumarDecimal]').val(totalpositivo);

}

function CambioMoneda(){//genera el codigo de la cuenta para ponerlo en en imput codigo del modal
  var moneda = $("input[name=moneda]").val(); 
  var usuario = $("input[name=usuario]").val();
  var password = $("input[name=password]").val();    
  if(moneda == ""){
    toastr.error("INTRODUSCA LOS DATOS CORRECTAMENTE");            
  }else{

    $('#loading').css('display','block');           
   
    $.ajax({
       url:'../AutorizarCambioMoneda',
        type: 'GET',
        dataType: 'json',
        data: {usuario:usuario, password: password, moneda:moneda},
        success: function(message){
          if (message.mensaje == 1) {
           
            $("input[name=dolar]").val(""); 
            $("input[name=boliviano]").val(""); 
            $("input[name=TipoDeCambioCompra]").val(moneda); 
            $('#ModalMoneda').modal('hide');
            toastr.success("TIENE PERMISO");                        
            $('#loading').css('display','none');         
          } else {
            toastr.error("NO TIENE PERMISO");                        
            $('#loading').css('display','none');         
          }
            //toastr.success(message.mensaje);  //asi se optiene cuando se envia algo en ajax           
        },error: function(){
            toastr.error("ERROR");            
            $('#loading').css('display','none');         
        },
    });
  }
}
function cambiarDolar(input){
dolar=$(input).val();
boliviano=$('input[name=TipoDeCambioCompra]').val();
cambioBoliviano=(boliviano*dolar).toFixed(2);
$('#cambiarDolar').text(cambioBoliviano+" Bs.");
}


function CompletarPago(input,opcion){//esta funcion completa el pago inicial entre el monto del banco con el monto en efectivo 
tipoPago=$('#tipoPagop');
pagoInicial=$('input[name=pagoInicial]').val();
montoBanco=$('input[name=montoBanco]');
montoEfectivo=$('input[name=montoEfectivo]');
PrecioContado=$('input[name=PrecioContado]');
if (tipoPago.prop('checked')) {
 if (pagoInicial!="" ) {

      if (opcion===1) {
          total=pagoInicial-montoBanco.val();
          montoEfectivo.val(total);

      }  
      else{
         total=pagoInicial-montoEfectivo.val();
         montoBanco.val(total);
      }
  }     
  else{
    toastr.error('COLOQUE EL PAGO INICIAL PRIMERAMENTE');
    montoEfectivo.val("");
    montoBanco.val("");
  }
}
else{
  if (opcion===1) {
          total=PrecioContado.val()-montoBanco.val();
          montoEfectivo.val(total);

      }  
      else{
         total=PrecioContado.val()-montoEfectivo.val();
         montoBanco.val(total);
      }
}


}