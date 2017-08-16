$(document).ready(function(){
$('#loading').css('display','none');


});

function CargarDatosACtualizar(id){
$('#loading').css('display','block');

$('#id_usuario').val(id);

  $("#btn_actualizar").hide();  

    $.get('cargar_usuario/'+id , function (response) {

        $("#name_up").val(response.name);      
        $("#apellido_up").val(response.apellido);
        $("#direccion_up").val(response.direccion);
        $("#ci_up").val(response.ci);
        $("#nit_up").val(response.nit);
        $("#celular_up").val(response.celular);

        $("#telefono_up").val(response.telefono);
        $("#celular_up").val(response.celular);
      if (response.estado=='1') {
       $("select[name=estado_up]").append("<option value=1>ACTIVO</option><option value=0>INACTIVO</option>");
      }else{
         $("select[name=estado_up]").append("<option value=0>INACTIVO</option><option value=1>ACTIVO</option>");
      }
    switch (response.privilegio){
        case 0:
       $("select[name=privilegio_up]").append(' <option value="0">ADMINISTRADOR</option> <option value="1">OFICINA</option> <option value="2">VENDEDOR</option><option value="3">CONTADOR</option>');

        break;

        case 1:
       $("select[name=privilegio_up]").append(' <option value="1">OFICINA</option> <option value="0">ADMINISTRADOR</option>  <option value="2">VENDEDOR</option><option value="3">CONTADOR</option>');

        break;

        case 2:
       $("select[name=privilegio_up]").append('<option value="2">VENDEDOR</option> <option value="1">OFICINA</option> <option value="0">ADMINISTRADOR</option>  <option value="3">CONTADOR</option>');


        case 3:
       $("select[name=privilegio_up]").append('<option value="3">CONTADOR</option> <option value="2">VENDEDOR</option> <option value="1">OFICINA</option> <option value="0">ADMINISTRADOR</option>  ');

        break;
    }
$('#loading').css('display','none');
    });

  
}
