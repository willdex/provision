 var URLactual;
$(document).ready(function(){
 

  URLactual = window.location.pathname;
   var idd=$('#iddelperfil').val();
 
   if(idd==''){
   	 var route = "/";
 
	 window.location.href = route;
	}else {
 var route = "Autorizaciones/"+idd;
 Cargarpermiso(route);
 cargarvistademenu(route);
 }

});

 
 function Cargarpermiso(route){
 

$.get(route,function(res){
   $(res).each(function(key,value){
 
   	if(URLactual==value.urlObjeto){



$("#perfilpuedeGuardar").val(value.puedeGuardar);
$("#perfilpuedeEliminar").val(value.puedeEliminar);
$("#perfilpuedeModificar").val(value.puedeModificar);
 $("#perfilpuedeListar").val(value.puedeListar);
 if (value.perfilpuedeListar!='1') {
  $('#listar').attr('hidden',false);
 }
$("#perfilpuedeVerReporte").val(value.puedeVerReporte);
$("#perfilpuedeImprimir").val(value.puedeImprimir);
   	}else {}



});
});
//$("#Productos").hide();
//$("#Categoria").val();
}



    function cargarvistademenu(route){


 

$.get(route,function(res){
   $(res).each(function(key,value){
		var url=value.urlObjeto;
       var completo=url.replace('/','',url);
        
 var categorias ="Categoria";
 var pro ="Productos";
 var med="Medida";
 var inge="Ingredientes"; 
 var com="Gestionarcompras"; 
 var prov="GestionarProveedor";
 var lisr="listadeventa";
var emple="Empleados";
var cargo="cargoempleado";
var turno="Gestionarturno";


var objeto="GestionarObjeto";
var Modulo="GestionarModulo";
var Perfil="GestionarPerfil";
var libroorden="Gestionarlibroorden";
var Sucursal="GestionarSucursal";
var Pais="GestionarPais";
var Reporte="GestionarReporte";



 var listar=value.puedeListar;
 if(categorias==completo){
       
      if(listar==0){
			$("#Categoria").hide();
      }else {$("#Categoria").show();}



 }else {}
 
 if(pro==completo){
     
      if(listar==0){
			$("#Productos").hide();
      }else {$("#Productos").show();}

 }else {}
  
 if(med==completo){
     
      if(listar==0){
			$("#Medida").hide();
      }else {$("#Medida").show();}

 }else {}
 
 if(inge==completo){
     
      if(listar==0){
			$("#Ingredientes").hide();
      }else {$("#Ingredientes").show();}

 }else {}



  if(com==completo){
     
      if(listar==0){
			$("#Gestionarcompras").hide();
      }else {$("#Gestionarcompras").show();}

 }else {}


  if(prov==completo){
     
      if(listar==0){
			$("#GestionarProveedor").hide();
      }else {$("#GestionarProveedor").show();}

 }else {}



  if(lisr==completo){
     
      if(listar==0){
			$("#listadeventa").hide();
      }else {$("#listadeventa").show();}

 }else {}




if(emple==completo){
     
      if(listar==0){
			$("#Empleados").hide();
      }else {$("#Empleados").show();}

 }else {}

if(cargo==completo){
     
      if(listar==0){
			$("#cargoempleado").hide();
      }else {$("#cargoempleado").show();}

 }else {}

if(turno==completo){
     
      if(listar==0){
			$("#Gestionarturno").hide();
      }else {$("#Gestionarturno").show();}

 }else {}


if(objeto==completo){
     
      if(listar==0){
			$("#GestionarObjeto").hide();
      }else {$("#GestionarObjeto").show();}

 }else {}

if(Modulo==completo){
     
      if(listar==0){
			$("#GestionarModulo").hide();
      }else {$("#GestionarModulo").show();}

 }else {}
 if(Perfil==completo){
     
      if(listar==0){
			$("#GestionarPerfil").hide();
      }else {$("#GestionarPerfil").show();}

 }else {}
 if(libroorden==completo){
     
      if(listar==0){
			$("#Gestionarlibroorden").hide();
      }else {$("#Gestionarlibroorden").show();}

 }else {}


 if(Sucursal==completo){
     
      if(listar==0){
			$("#GestionarSucursal").hide();
      }else {$("#GestionarSucursal").show();}

 }else {}
 if(Pais==completo){
     
      if(listar==0){
			$("#GestionarPais").hide();
      }else {$("#GestionarPais").show();}

 }else {}

if(Reporte==completo){
     
      if(listar==0){
			$("#GestionarReporte").hide();
      }else {$("#GestionarReporte").show();}

 }else {}









   	});
});

    }