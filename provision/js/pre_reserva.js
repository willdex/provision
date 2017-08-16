$(document).ready(function(){
    $('#btn_agregar').hide();      
    $('#div_crear_1').hide();      
    $('#div_crear_2').hide();     
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
var cont = 0;

//AGREGAR
function agregar(){
    $("#btn_agre").hide();  
    tabladatos = $('#body_busqueda');
    var fila = '<tr id="fila'+cont+'" align=center>\n\
        <td><select class="form-control" name=id_proyecto[] id=id_proyecto'+cont+' onchange=BuscarFase('+cont+')></select></td>\n\
        <td> <input name="id_lote[]" id="id_lote'+cont+'" type="hidden"> <select class="form-control" name=id_fase[] id=id_fase'+cont+' onchange=BuscarManzano(this,'+cont+') ></select></td>\n\
        <td><select class="form-control" name=nro_manzano[] id=nro_manzano'+cont+' onchange=BuscarLoteReserva(this,'+cont+') ></select></td>\n\
        <td align=left><select class="form-control" name="nro_lote[]" id="nro_lote'+cont+'" onchange=Buscar_Lote(this,'+cont+') ></select></td>\n\
        <td align=left> Nro. Lote: <font color="red" id="lote'+cont+'" size="3"> </font><br>\n\
        Nro. Manzano: <font color="red" id="manzano'+cont+'" size="3"> </font><br>  Precio: <font color="red" id="precio'+cont+'" size="3"> </font><br>  Descuento : <font color="red" id="porcentaje'+cont+'" size="3"> </font><br>  Precio Contado: <font color="red" id="descuento'+cont+'" size="3"> </font><br>\n\
        Superficie: <font color="red" id="superficie'+cont+'" size="3"> </font><br>\n\
        Proyecto: <font color="red" id="proyecto'+cont+'" size="3"> </font> </td>\n\
       <td> <button type="button" id="btn_eli'+cont+'" class="btn-sm btn-danger" title=Eliminar onclick="Eliminar_lista(' + cont + ')"><i class="fa fa-trash-o" aria-hidden="true"></i></button></td></tr>';            
    $('#body_busqueda').append(fila);
    BuscarProyecto(cont);
}
function Eliminar_lista(index){
  $('#fila' + index).remove();
  $("#btn_agre").show();   
  cont++;
}

function BuscarCliente(){

  $.get('verificarCarnet/'+$("input[name=ci]").val(), function(res){
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
       document.getElementById("m").checked = false;                      
       document.getElementById("f").checked = false;                    
    } else {
      
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

function Buscar_Lote(select,id){
  $('#loading').css('display','block');      
  idLote = $("#nro_lote"+id).val();
  proyecto=$("#id_proyecto"+id).val();
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

      precio = parseFloat(response[0].precio);
      $("#id_lote"+id).val(response[0].id_lote);            
      $("#lote"+id).text(response[0].nroLote);            
      $("#manzano"+id).text(response[0].manzano);            
      $("#precio"+id).text(precio.toFixed(2) +" $u$");            
      $("#porcentaje"+id).text(response[0].porcentaje +" %");            
      $("#categoria"+id).text(response[0].categoria);            
      $("#descuento"+id).text(response[0].descuento +" $u$");            
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



 function cargarCiudad(select){
    $('#loading').css('display','block');      

  id=$(select).val();
  lugarProcedencia=$('select[name=lugarProcedencia]');
  lugarProcedencia.empty();
        $.get('cargarCiudad/'+id,function(res){
           lugarProcedencia.append('<option>Seleccione un departamento');
for (var i = 0; i < res.length; i++) {
              lugarProcedencia.append('<option value='+res[i].id+'>'+res[i].estadonombre) ;
            }
    $('#loading').css('display','none');      
          
        });
    }
/*

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
          $("#porcentaje"+id).text("");            
          $("#descuento"+id).text("");                        
          $("#superficie"+id).text("");            
          $("#proyecto"+id).text("");                                           
          $("#categoria"+id).text("");                                           
          $("#btn_agre").hide();                                                     
        } else {
          if (response[0].estado == 0) {
              $("#id_lote"+id).val(response[0].id_lote);            
              $("#lote"+id).text(response[0].nroLote);            
              $("#manzano"+id).text(response[0].manzano);            
              $("#precio"+id).text(response[0].precio +" $u$");            
              $("#porcentaje"+id).text(response[0].porcentaje +" %");              
              $("#descuento"+id).text(response[0].descuento +" $u$");            
              $("#superficie"+id).text(response[0].superficie +" Km²");            
              $("#proyecto"+id).text(response[0].nombre); 
              $("#categoria"+id).text(response[0].categoria); 
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
             toastr.error("ESE LOTE NO ESTA DISPONIBLE");
            $("#btn_agregar").hide();
            $("#btn_agre").hide();                                                     
          }

        } 
    $('#loading').css('display','none');     

      });
  }
}
*/