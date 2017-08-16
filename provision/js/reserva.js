$(document).ready(function(){
    $('#btn_agregar').hide();      
    $('#div_crear_1').show();      
    $('#div_crear_2').show();   
    $('#loading').css('display','none');      

});

function crear(){
  $("#div_crear_1").show();
  $("#div_crear_2").show();
}

var id_proyecto = [];
var id_fase = [];
var id_lote = [];
var nro_lote = [];
var nro_manzano = [];
var subTotal = [];
var MontoBanco = [];
var cont = 0;

//AGREGAR
function agregar(){
    $("#btn_agre").hide();  
    tabladatos = $('#body_busqueda');
    var fila = '<tr id="fila'+cont+'" >\n\
        <td><select class="form-control" name=id_proyecto[] id=id_proyecto'+cont+' onchange=BuscarFase('+cont+') ></select></td>\n\
        <td><select class="form-control" name=id_fase[] id=id_fase'+cont+' onchange=BuscarManzano(this,'+cont+') ></select></td>\n\
        <td><select class="form-control" name=nro_manzano[] id=nro_manzano'+cont+' onchange=BuscarLoteReserva(this,'+cont+') ></select></td>\n\
        <td align=left><select class="form-control" name=nro_lote[] id=nro_lote'+cont+' onchange=Buscar_Lote(this,'+cont+') ></select><input name="id_lote[]" id="id_lote'+cont+'" type="hidden" ></td>\n\
        <td> Nro. Manzano: <font color="red" id="manzano'+cont+'" size="3"> </font><br>  Precio a Plazo: <font color="red" id="precio'+cont+'" size="3"> </font><br> Descuento : <font color="red" id="porcentaje'+cont+'" size="3"> </font><br>  Precio Contado: <font color="red" id="descuento'+cont+'" size="3"> </font><br>  \n\
        Superficie: <font color="red" id="superficie'+cont+'" size="3"> </font><br> Categoria: <font color="red" id="categoria'+cont+'" size="3"> </font><br>\n\
        Proyecto: <font color="red" id="proyecto'+cont+'" size="3"> </font> </td>\n\
        <td><input name="subTotal[]" onchange=sumarTotal(this,'+cont+') id="subTotal'+cont+'" type="text" placeholder="Monto" size="7" style="text-align: center;" onkeypress="return numerosmasdecimal(event)" value="0"> $u$. </td>\n\
        <td><select onchange="cargarBanco(this,'+cont+')" name="tipoPago[]" class="form-control" id="tipoPago'+cont+'"> <option value="e">Efectivo<option value="b">Banco</select><br><select onchange=cargarCuenta(this,'+cont+') style="display:none" name="banco[]" class="form-control" id="banco'+cont+'"></select><br><select  style="display:none" name="cuenta[]" class="form-control" id="cuenta'+cont+'"></select><br><input style="display:none" type="text" class="form-control" placeholder="Nro de documento" name="nroDocumento[]" id="nroDocumento'+cont+'" onkeypress="return bloqueo_de_punto(event)"><br><input style="display:none" type="hidden" onchange=sumarTotal(this,'+cont+') class="form-control" placeholder="Monto Banco" name="MontoBanco[]" id="MontoBanco'+cont+'" value="0" onkeypress="return bloqueo_de_punto(event)">\n\
       <td> <button type="button" id="btn_eli'+cont+'" class="btn-sm btn-danger" title=Eliminar onclick="Eliminar_lista(' + cont + ')"><i class="fa fa-trash-o" aria-hidden="true"></i></button></td>\n\
       </tr>';            
    $('#body_busqueda').append(fila);
    BuscarProyecto(cont);
}

function Eliminar_lista(index){
  totales=0;
  subtotal= parseFloat($('#subTotal'+index).val());
  montoBanco= parseFloat($('#MontoBanco'+index).val());
  totales=parseFloat(subtotal)+parseFloat(montoBanco);
  total=parseFloat($('#montoTotal').val());
  restar=total-totales;
$('#montoTotal').val(restar);

  $("#btn_agre").show();   
  $('#fila' + index).remove();
}

function sumarTotal(input,i){
sumar=0;
montoBanco=0;
for (var i = 0; i < cont; i++) {
  if (!isNaN($('#subTotal'+i).val())) {
    subtotal= $('#subTotal'+i).val();
    sumar=sumar+parseFloat(subtotal);
  }
  if (!isNaN($('#MontoBanco'+i).val())) {
    montoBanco= $('#MontoBanco'+i).val();
    sumar=sumar+parseFloat(montoBanco);
  }  
}
$('#montoTotal').val(sumar);
}

function BuscarCliente(){
    $('#loading').css('display','block');      

  $.get('verificarCarnet/'+$("input[name=ci]").val(), function(res){
    if (res[0].contador == 0) {
      toastr.info("EL CLIENTE ES NUEVO");
      $("input[name=nombre]").val("");
      $("input[name=apellidos]").val("");
      $("input[name=fechaNacimiento]").val("");
      $("input[name=nacionalidad]").val("");
      $("input[name=celular]").val("");
      $("input[name=celular_ref]").val("");
      $("input[name=lugarProcedencia]").val("");
      $("select[name=estadoCilvil]").val("");
      $("input[name=domicilio]").val("");
      $("input[name=nit]").val("");
      $("input[name=ocupacion]").val("");

       document.getElementById("m").checked = false;                      
       document.getElementById("f").checked = false;                    
    } else {
      $("input[name=nombre]").val(res[0].nombre);
      $("input[name=apellidos]").val(res[0].apellidos);
      $("input[name=fechaNacimiento]").val(res[0].fechaNacimiento);
      $("input[name=nacionalidad]").val(res[0].nacionalidad);
      $("input[name=celular]").val(res[0].celular);
      $("input[name=celular_ref]").val(res[0].celular_ref);
      $("input[name=lugarProcedencia]").val(res[0].lugarProcedencia);
      $("select[name=estadoCilvil]").val(res[0].estadoCilvil);
      $("input[name=domicilio]").val(res[0].domicilio);
      $("input[name=nit]").val(res[0].nit);
      $("input[name=ocupacion]").val(res[0].ocupacion);

      if (res[0].genero == 'm') {
       document.getElementById("m").checked = true;                      
      } else {
       document.getElementById("f").checked = true;                
      }
      //$("input[name=genero]:checked").val(res[0].genero);
      //$("#sexo").val($('input[name="genero"]:checked').val());
      toastr.success("EXISTE ESE CLIENTE");      
    }    
    $('#loading').css('display','none');      

  });
}


function BuscarProyecto(j){
  $('#loading').css('display','block'); 
  $("#id_lote"+j).val("");            
  $("#lote"+j).text("");            
  $("#manzano"+j).text("");            
  $("#precio"+j).text("");            
  $("#porcentaje"+j).text("");            
  $("#categoria"+j).text("");            
  $("#descuento"+j).text("");            
  $("#superficie"+j).text("");            
  $("#proyecto"+j).text("");   
  $('#nro_manzano'+j).empty();
  $('#id_fase'+j).empty();      
  $('#nro_lote'+j).empty();      
  $.get('BuscarProyecto',function(res){
    $('#id_proyecto'+j).append('<option value=0>Proyectos');
    for (var i = 0; i < res.length; i++) {
      $('#id_proyecto'+j).append('<option value='+res[i].id+'>'+res[i].nombre);    
    }
    $('#loading').css('display','none');      
  });
}


function BuscarFase(j){
  proyecto=$("#id_proyecto"+j).val();
  $("#id_lote"+j).val("");            
  $("#lote"+j).text("");            
  $("#manzano"+j).text("");            
  $("#precio"+j).text("");            
  $("#porcentaje"+j).text("");            
  $("#categoria"+j).text("");            
  $("#descuento"+j).text("");            
  $("#superficie"+j).text("");            
  $("#proyecto"+j).text("");
  $('#id_fase'+j).empty();      
  $('#nro_manzano'+j).empty();
  $('#nro_lote'+j).empty();
  $('#loading').css('display','block');      
  $.get('BuscarFase/'+proyecto, function(res){
    $('#id_fase'+j).append('<option value=0>Fases');
    for (var i = 0; i < res.length; i++) {
      $('#id_fase'+j).append('<option>'+res[i].fase);    
    }
    $('#loading').css('display','none');      
  });
}

function BuscarManzano(select,j){
  $('#loading').css('display','block');      
  $("#id_lote"+j).val("");            
  $("#lote"+j).text("");            
  $("#manzano"+j).text("");            
  $("#precio"+j).text("");            
  $("#porcentaje"+j).text("");            
  $("#categoria"+j).text("");            
  $("#descuento"+j).text("");            
  $("#superficie"+j).text("");            
  $("#proyecto"+j).text("");
  fase=$(select).val();
  proyecto=$("#id_proyecto"+j).val();
  $('#nro_manzano'+j).empty();
    $('#nro_lote'+j).empty();
  $.get('BuscarManzano/'+fase+'/'+proyecto,function(res){
    $('#nro_manzano'+j).append('<option value=0>Nro Manzano');
    for (var i = 0; i < res.length; i++) {
$('#nro_manzano'+j).append('<option value='+res[i].manzano+'>'+res[i].manzano);
    
    }
    $('#loading').css('display','none');      

  });

}
function BuscarLoteReserva(select,j){
  $('#loading').css('display','block');      
  $("#id_lote"+j).val("");            
  $("#lote"+j).text("");            
  $("#manzano"+j).text("");            
  $("#precio"+j).text("");            
  $("#porcentaje"+j).text("");            
  $("#categoria"+j).text("");            
  $("#descuento"+j).text("");            
  $("#superficie"+j).text("");            
  $("#proyecto"+j).text("");
  fase=$(select).val();
  proyecto=$("#id_proyecto"+j).val();
  $('#nro_lote'+j).empty();
  $.get('BuscarLoteReserva/'+fase+'/'+proyecto, function(res){
    $('#nro_lote'+j).append('<option value=0>Nro Lote');
    for (var i = 0; i < res.length; i++) {
$('#nro_lote'+j).append('<option value='+res[i].id+'>'+res[i].nroLote);
    
    }
    $('#loading').css('display','none');      

  });

}
function MontoTotal(id){
  total = 0;
  for (var i = 0; i <= cont; i++) {
    if (!isNaN(parseFloat($("#subTotal"+i).val()))) {
      total = parseFloat(total) + parseFloat($("#subTotal"+i).val());          
    }
  }
  $("#montoTotal").val(parseFloat(total)); 
}



var verificar=0;

function Buscar_Lote(select,id){
  $('#loading').css('display','block');      
  idLote = $("#nro_lote"+id).val();
      $.get('BuscarLoteId/'+idLote+'/'+proyecto, function (response) { 
          if (response[0].estado == 0) {    
            for (var i = 0; i < cont; i++) {
              if (!isNaN($('#id_lote'+i).val())) {
                if ($('#id_lote'+i).val() == response[0].id_lote) {
                  $("#id_lote"+id).val("");            
                  $("#lote"+id).text("");            
                  $("#manzano"+id).text("");            
                  $("#precio"+id).text("");            
                  $("#porcentaje"+id).text("");            
                  $("#categoria"+id).text("");            
                  $("#descuento"+id).text("");            
                  $("#superficie"+id).text("");            
                  $("#proyecto"+id).text("");   
                  $('#id_proyecto'+id).empty();
                  $('#nro_manzano'+id).empty();
                  $('#id_fase'+id).empty();      
                  $('#nro_lote'+id).empty();  
                  BuscarProyecto(id);                    
                  alert("ESE LOTE YA SE A ELEGIDO, SELECCIONE OTRO");
                  $('#loading').css('display','none');
                  return;      
                }
              }
            }
            $("#id_lote"+id).val(response[0].id_lote);            
            $("#lote"+id).text(response[0].nroLote);            
            $("#manzano"+id).text(response[0].manzano);            
            $("#precio"+id).text(parseInt(response[0].precio) +" $u$");            
            $("#porcentaje"+id).text(response[0].porcentaje +" %");            
            $("#categoria"+id).text(response[0].categoria);            
            $("#descuento"+id).text(parseInt(response[0].descuento) +" $u$");            
            $("#superficie"+id).text(response[0].superficie +" Mt²");            
            $("#proyecto"+id).text(response[0].nombre);
            if (response[0].estado == 0) {
              $("#btn_agregar").show(); 
              $("#btn_eli"+id).show();
              $("#btn_agre").show();                                                                           
              cont++;
            } else {
              $("#btn_agregar").hide();
              $("#btn_eli"+id).hide(); 
              $("#btn_agre").hide();               
            }  
          } else {
            toastr.options.positionClass = "toast-bottom-center";          
            toastr.error("ESE LOTE NO ESTA DISPONIBLE");            
            $("#btn_agregar").hide();
            $("#btn_agre").hide();                                                     
          }
    $('#loading').css('display','none');      
         
      });
  
}

function cargarBanco(select,j){
    $('#loading').css('display','block');      

  if ($(select).val()=="b") {
    $('#banco'+j).css('display','block');
    $('#cuenta'+j).css('display','block');
 $('#nroDocumento'+j).css('display','block');
 $('#MontoBanco'+j).css('display','block');

       $('#banco'+j).empty();
    $.get('cargarBanco',function(res){
       $('#banco'+j).append('<option value=0> Seleccione un Banco') ;
        for (var i = 0; i < res.length; i++) {
           $('#banco'+j).append('<option value='+res[i].id+'>'+res[i].nombre) ;
        }
    $('#loading').css('display','none');      

    });
  }
  else{
     $('#banco'+j).css('display','none');
    $('#cuenta'+j).css('display','none');
 $('#nroDocumento'+j).css('display','none');
       $('#banco'+j).empty();
        $('#cuenta'+j).empty();
 $('#nroDocumento'+j).val("");
 $('#MontoBanco'+j).css('display','none');
 $('#MontoBanco'+j).val("");

    $('#loading').css('display','none');      

  }
}
function cargarCuenta(select,j){
    $('#loading').css('display','block');      

  idBanco=$(select).val();
    $('#cuenta'+j).empty();
    $.get('cargarCuenta/'+idBanco,function(res){
        for (var i = 0; i < res.length; i++) {
           $('#cuenta'+j).append('<option value='+res[i].id+'>'+res[i]. nroCuenta) ;
        }
    $('#loading').css('display','none');      

    });
  
}

//VALIDAR EN EL REPORTE LAS FECHAS
function Validar_Reporte_Reserva(){    
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

function ReporteReserva(){    
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
        window.open('ReporteReservaPDF/'+fecha_inicio+'/'+fecha_fin);         
        toastr.success('CARGANDO REPORTE');         
      }      
  }
}
/* ANTES ESTABA ESTE CODIGO

$(document).ready(function(){
    $('#loading').css("display","none");
});
    var clic = 1;
    lotes = "";
    punto="";
    function divLogin(lote,tipo) {
      if ($(lote).attr('data-status')=='0') {
        point=$(lote);
        $('#btnreservar').attr('disabled',false);
       if (tipo==0) {
         punto=$(lote).attr('points');
       }
       else{
        punto=$(lote).attr('d');
       }
         if (lotes=="") {
            lote.style.fill = "#0195bf"; 
         }
         else{
        if (lote != lotes && lotes != "") {
            lotes.style.fill = "#85f793";
            lote.style.fill = "#0195bf";
           }
        }
        lotes = lote;
      }

    }

function buscarCliente(){
  $('#loading').css("display","block");

ci=$('#cliente').val();
if (ci!="") {
$.get('buscarCliente/'+ci,function(res){


  if (res.mensaje=="1") {
   toastr.error('ESE USUARIO NO EXISTE');
    $('#id_cliente').val("" );
     $('#nombreCli').val("" );
      $('#btn_actualizar').attr('disabled',true);
  }
  else{
    $('#nombreCli').val(res[0].nombre + " " +res[0].apellido);
    $('#id_cliente').val(res[0].id );
    $('#btn_actualizar').attr('disabled',false);
  }
  $('#loading').css("display","none");

});
}
else{
    $('#id_cliente').val("" );
    $('#btn_actualizar').attr('disabled',false);

}
}

function CargarDatos(){

  if (punto!="") {
  $('#loading').css("display","block");
  $("#btn_actualizar").hide();  
  $("#id_lote").val("");      
  $("#nro_lote_ac").val("");
  $("#superficie_ac").val("");
  $("#superficie_aux").val("");
  $("#id_manzano_ac").val("");
  $("#nro_manzano").val("");

  punto= punto.trim();
    $.get('../cargar_lote/'+punto , function (response) { 

        $("#id_lote").val(response[0].id);      
        $("#nro_lote_ac").val(response[0].nro_lote);
        $("#superficie_ac").val(response[0].superficie);
        $("#superficie_aux").val(response[0].superficie);
  $("#nro_manzano").val(response[0].numero_manzano);

        $("#id_manzano_ac").val(response[0].id_manzano);
        $("#btn_actualizar").show();  
         $('#loading').css("display","none");
    });
  }
  else{

  }
}

function buscarReservas(opcion){
  $('#loading').css('display','block');
  if (opcion==1 && $('#fecha').val()!="") {
    var fecha=$('#fecha').val();
    $.get('../buscar_reserva/'+fecha,function(res){
  $('#lista_reserva').empty();
  for (var i = 0; i < res.length; i++) {
   $('#lista_reserva').append("<tr style='text-align: center;'    ><td>"+res[i].nombre_cliente+"</td><td>"+res[i].apellido+"</td><td>"+res[i].ci+"</td><td>"+res[i].fecha+"</td><td>"+res[i].nro_lote+"</td><td>"+res[i].nro_manzano+"</td><td>"+res[i].name+"</td><td><button data-toggle='modal' data-target='#myModalAnular'   onclick='anularReserva("+res[i].id_reserva+")' class='btn btn-danger'>Anular Reserva</button > <a href="+$('#urlveta').val()+"/"+res[i].id_reserva+" class='btn btn-primary'>VENDER</a></td></tr>");;

    }
  $('#loading').css('display','none');

  });
}
else{
  if (opcion==2 && $('#ci').val()!="") {
    var ci=$('#ci').val();
    $.get('../buscar_reserva_ci/'+ci,function(res){
  $('#lista_reserva').empty();
  for (var i = 0; i < res.length; i++) {
   $('#lista_reserva').append("<tr style='text-align: center;'    ><td>"+res[i].nombre_cliente+"</td><td>"+res[i].apellido+"</td><td>"+res[i].ci+"</td><td>"+res[i].fecha+"</td><td>"+res[i].nro_lote+"</td><td>"+res[i].nro_manzano+"</td><td>"+res[i].name+"</td><td><button data-toggle='modal' data-target='#myModalAnular'   onclick='anularReserva("+res[i].id_reserva+")' class='btn btn-danger'>Anular Reserva</button> <a href="+$('#urlveta').val()+"/"+res[i].id_reserva+" class='btn btn-primary'>VENDER</a></td></tr>");;

    }
  $('#loading').css('display','none');

  });
}else{$('#loading').css('display','none');}
}
}
function anularReserva(id){
$('#id_reserva').val(id);
}
/*
function guardar_lote(){
      $.ajax({
            url:"mapa",
          headers: {'X-CSRF-TOKEN': token},
         type: 'POST',
        dataType: 'json',
    data: {nro_lote:nro_lote,dimension:dimension, estado:estado},
              });
}*/
/*
function BuscarLote(){

  if (punto!="") {
  $('#loading').css("display","block");
  $("#btn_actualizar").hide();  
  $("#id_lote").val("");      
  $("#nro_lote_ac").val("");
  $("#superficie_ac").val("");
  $("#superficie_aux").val("");
  $("#id_manzano_ac").val("");
  $("#nro_manzano").val("");

  punto= punto.trim();
    $.get('cargar_lote/'+punto , function (response) { 
        $("#id_lote").val(response[0].id);      
        $("#nro_lote_ac").val(response[0].nro_lote);
        $("#superficie_ac").val(response[0].superficie);
        $("#superficie_aux").val(response[0].superficie);
  $("#nro_manzano").val(response[0].numero_manzano);

        $("#id_manzano_ac").val(response[0].id_manzano);
        $("#btn_actualizar").show();  
         $('#loading').css("display","none");
    });
  }
  else{

  }
}
function Pintar(){
  $('#loading').css('display','block');

  nro_lote=$('#nro_lote2').val();
  nro_manzano=$('#nro_manzano2').val();
  if (nro_lote!="" && nro_manzano2!="") {
  $.get('../buscar_lote/'+nro_lote+'/'+nro_manzano,function(res){

    if (res.mensaje=="1") {
     toastr.error('EL LOTE NO ESTA DISPONIBLE');
      punto="";
    $('#btnreservar').attr('disabled',true);

     $('#nro_lote2').val("" );
     $('#nro_manzano2').val("" );
    }
    else{
      if (res[0].tipo_etiqueta=="0") {
    $('polygon[points="'+res[0].point+'"]').css('fill','black'); 
    punto=res[0].point;
    $('#btnreservar').attr('disabled',false);
     toastr.success('EL LOTE  ESTA DISPONIBLE');
}
else{
  $('path[d="'+res[0].point+'"]').css('fill','black'); 
    punto=res[0].point;
    $('#btnreservar').attr('disabled',false);
     toastr.success('EL LOTE  ESTA DISPONIBLE');
}
// alert($('button[name=880.7,107.6 879.1,139.9 892,130.6 893.7,108.2]').attr('name'));
  }
  $('#loading').css('display','none');
  

 });
 }
 else
  {
    toastr.error('LLENAR LOS CAMPOS NRO DE LOTE Y NRO DE MANZANO');
  $('#loading').css('display','none');
    
  }
}

*/