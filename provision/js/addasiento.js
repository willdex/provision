totaldebe = 0;
totalhaber = 0;
totaldebed = 0;
totalhaberd = 0;
cont = 0;
total = 0;
subtotaldebe = [];
subtotalhaber = [];

subtotaldebed = [];
subtotalhaberd = [];
input = "";
idcuenta = [];
tipocambio = 0;
//fjalñdfjña

function verificarrepetido(cuenta){//este se encarga de ferificar que no pueda agregar 2 cuentas iguales
    if(cont!=0){
    for (i=cont-1;cont>=0;i--){
            if(idcuenta[i]==cuenta){
                return false;
            } 
            else
            return true

    }}
else
    return true;
}

function agregar() {

   var tito=$('#idcuenta').val();
    if(verificarrepetido(tito)){
         idcuenta[cont] = $('#idcuenta').val();
    cuenta = $('#idcuenta option:selected').text();
    
    debe = parseInt($('#iddebe').val());

    haber = parseInt($('#idhaber').val());
    if (isNaN(debe)) {
        debe = 0;
    }
    if (isNaN(haber)) {
        haber = 0;
    }
    tipocambio = $('#tipocambio').val();
    if (debe != "" || haber != "")
    {
        subtotaldebe[cont] = debe;
        subtotalhaber[cont] = haber;
        subtotaldebed[cont] = debe / tipocambio;
        subtotalhaberd[cont] = haber / tipocambio;
        totaldebe = totaldebe + subtotaldebe[cont];
        totalhaber = totalhaber + subtotalhaber[cont];
        totaldebed = totaldebed + subtotaldebed[cont];
        totalhaberd = totalhaberd + subtotalhaberd[cont];

        var fila = '<tr class="selected" id="fila' + cont + '"><td><button type="button" class="btn btn-danger" onclick="eliminar(' + cont + ')">X</button>\n\
<button type="button" class="btn btn-primary" onclick="modificar(' + cont + ')">MODIFICAR</button></td>\n\
<td><input type="text" name="id_cuenta[]" value="'  +idcuenta[cont] + '"/></td>\n\
<td><label>' + cuenta + '</label></td>\n\
<td><input name="debe[]" type="number"   value="' + subtotaldebe[cont] + '" id="debe' + cont + '" onclick="bloquear(this)"></input></td>\n\
<td><input name="haber[]" type="number"  value="' + subtotalhaber[cont] + '" id="haber' + cont + '" onclick="bloquear(this)"></input></td>\n\
<td><input type="number" value="' + subtotaldebed[cont].toFixed(2) + '" id="debed' + cont + '" onclick="bloquear(this)"></input></td>\n\
<td><input type="number" value="' + subtotalhaberd[cont].toFixed(2) + '" id="haberd' + cont + '" onclick="bloquear(this)"></input></td></tr>';

        $("#totaldebe").text("B/. " + totaldebe);
        $("#totalhaber").text("B/. " + totalhaber);
        $("#totaldebed").text("$/. " + totaldebed.toFixed(2));
        $("#totalhaberd").text("$/. " + totalhaberd.toFixed(2));

        $('#detalles').append(fila);
    } else {
        alert("error al ingresar el detalle");

    }
    $('#iddebe').val("");
    $('#idhaber').val("");
    cont++;
    evaluar();}

}
function eliminar(index) {
   idcuenta[index]=0;
    totaldebe = totaldebe - subtotaldebe[index];
    totalhaber = totalhaber - subtotalhaber[index];
    totaldebed = totaldebed - subtotaldebed[index];
    totalhaberd = totalhaberd - subtotalhaberd[index];

    subtotaldebe[index] = 0;
    subtotalhaber[index] = 0;

    $('#totaldebe').html("" + totaldebe);
    $('#totalhaber').html("" + totalhaber);
    $('#totaldebed').html("" + totaldebed.toFixed(2));
    $('#totalhaberd').html("" + totalhaberd.toFixed(2));
    $('#fila' + index).remove();
    evaluar();

}
function evaluar() {//sirve para activar o desactivar el guardar si en caso los totales del debe o haber estan en "0"
    if (totaldebe > 0 || totalhaber > 0) {
        $('#guardar').show();
    } else {
        $('#guardar').hide();
    }
}
function desabilitar(id, input) {
    $(input).val("");
    $('#' + id).val("0");

}
function guardar() {
//    if (totaldebe == totalhaber) {
//        var token = $("input[name=_token]").val();
//        var glosa = $("#glosa").val();
//        var estado = $("#estado").val();
//        var categoria = $("#idcategoria").val();
//        var id_tipo_cambio = $("#idtipocambio").val();
//        var tipo_cambio = $("#tipocambio").val();
//        var fecha = $("#fecha").val();
//        var id_gestion = $('#id_gestion').val();
//        var id_empleado=$('#id_empleado').val();
//      
//        $.ajax({
//            url: '/asiento/',
//            headers: {'X-CSRF-TOKEN': token},
//            dataType: 'json',
//            type: 'POST',
//            data: {glosa: glosa, estado: 1, id_categoria: categoria, id_gestion: id_gestion, id_moneda: id_tipo_cambio, cambio_tipo: tipo_cambio, fecha: fecha,id_usuario:id_empleado},
//            success: function (data) {
//                var id = data.id;
//                for (var i = 0; i < cont; i++) {
//                    if (subtotaldebe[i] != 0 || subtotalhaber[i] != 0 || subtotaldebe[i] != "" || subtotalhaber[i] != "") {
//                        $.ajax({
//                            url: '/detalle',
//                            headers: {'X-CSRF-TOKEN': token},
//                            dataType: 'json',
//                            type: 'POST',
//                            data: {id_cuenta: idcuenta[i], id_asiento: id, debe: subtotaldebe[i], haber: subtotalhaber[i]},
//                            success: function (data, textStatus, jqXHR) {
//
//
//                            }
//                        });
//                    }
//                }
//
//                for (j = cont - 1; j >= 0; j--) {
//                    eliminar(j);
//                }
//                cont = 0;
//                alert("se registro correctamete");
//            }
//        });

//    } else {
//        alert("por favor cuadre su asiento")
//    }
}

function modificar(index) {
    var xdebe = subtotaldebe[index];
    var yhaber = subtotalhaber[index];
    subtotaldebe[index] = $('#debe' + index).val();
    
    subtotaldebed[index] = $('#debed' + index).val(subtotaldebe[index] * tipocambio);

    subtotalhaber[index] = $('#haber' + index).val();
    subtotalhaberd[index] = $('#haberd' + index).val(subtotalhaber[index] * tipocambio);


    if (xdebe > ($('#debe' + index).val())) {
        totaldebe = totaldebe - (xdebe - ($('#debe' + index).val()));
        totaldebed = totaldebe * tipocambio;
        $("#totaldebe").text("B/. " + totaldebe);
        $("#totaldebed").text("$/. " + totaldebed);

//       subtotaldebe[index]=subtotaldebe[index]-xdebe;
    } else
    if (xdebe < ($('#debe' + index).val())) {
        totaldebe = totaldebe + (($('#debe' + index).val()) - xdebe);
        totaldebed = totaldebe * tipocambio;
        $("#totaldebe").text("B/. " + totaldebe);
        $("#totaldebed").text("$/. " + totaldebed);
    }

    if (yhaber > ($('#haber' + index).val())) {
        totalhaber = totalhaber - (yhaber - ($('#haber' + index).val()));
        totalhaberd = totalhaber * tipocambio;
        $("#totalhaber").text("B/. " + totalhaber);
        $("#totalhaberd").text("$/. " + totalhaberd);

//       subtotalhaber[index]=subtotalhaber[index]-xhaber;
    } else
    if (yhaber < ($('#haber' + index).val())) {
        totalhaber = totalhaber + (($('#haber' + index).val()) - yhaber);
        totalhaberd = totalhaber * tipocambio;
        $("#totalhaber").text("B/. " + totalhaber);
        $("#totalhaberd").text("$/. " + totalhaberd);
    }
}
// $(document).keydown(function(tecla){ 
//            if (tecla.keyCode == 65) { 
//               alert("estoy aqui");
//                
//            }else if(tecla.keyCode == 83) { 
//                $('.s').css({ 'background-color' : 'blue' }); 
//            }else if(tecla.keyCode == 68){ 
//                $('.d').css({ 'background-color' : 'green' }); 
//            } 
//        });
function bloquear(text) {
    if (($(text).val() == 0)) {
        $(text).attr('disabled', 'disabled');
    }

}



