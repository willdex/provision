total_debe = 0;
total_haber = 0;
total_total_debe = 0;
total_total_haber = 0;
function reporte_libro_diario() {
    $('#tabla').empty();
    var fecha1 = $('#fecha').val();
    var fecha2 = $('#fecha2').val();
    var tabla = $('#tabla');
    var numero1 = "";
    var numero2 = "";
    var total_columna = 0;
    var activar = 1;
    $.get('reporte_libro_diario/' + fecha1 + '/' + fecha2, function (response) {
        total_columna = response.length;
        for (i = 0; i < response.length; i++) {
            if (numero1 == numero2 && i == 0) {
                tabla.append("<tr style='background-color: #2ECCFA'><td>" + response[i].numero + "</td>\n\
<td style='background-color: #A9D0F'>" + response[i].fecha + "</td><td>egreso</td>\n\
<td style='background-color: #A9D0F'>" + response[i].glosa + "</td>\n\
<td style='background-color: #A9D0F'>" + response[i].codigo + "</td>\n\
<td style='background-color: #A9D0F'>" + response[i].nombre + "</td>\n\
<td style='background-color: #A9D0F'>" + response[i].debe + "</td>\n\
<td>" + response[i].haber + "</td><tr>");
                total_debe = total_debe + parseInt(response[i].debe);
                total_haber = total_haber + parseInt(response[i].haber);
                total_total_debe = total_total_debe + parseInt(response[i].debe);
                total_total_haber = total_total_haber + parseInt(response[i].haber);
            } else {
                if (numero1 == numero2) {
                    tabla.append("<tr align=center><td></td><td></td><td>egreso</td>\n\
<td></td>\n\
<td>" + response[i].codigo + "</td>\n\
<td>" + response[i].nombre + "</td>\n\
<td>" + response[i].debe + "</td>\n\
<td>" + response[i].haber + "</td><tr>");
                    total_debe = total_debe + parseInt(response[i].debe);
                    total_haber = total_haber + parseInt(response[i].haber);
                    total_total_debe = total_total_debe + parseInt(response[i].debe);
                    total_total_haber = total_total_haber + parseInt(response[i].haber);
                } else {
                    if (numero1 != numero2 && i != 0 && activar == 1) {


                        tabla.append("<tr align=center style='background-color: #85E1D5'><td><b>TOTAL ASIENTO DEBE, HABER</b></td><td></td><td></td>\n\
<td></td>\n\
<td></td>\n\
<td></td>\n\
<td><b>" + total_debe + "</b></td>\n\
<td><b>" + total_haber + "</b></td><tr>");

                        total_debe = 0;
                        total_haber = 0;

                        tabla.append("<tr align=center style='background-color: #2ECCFA'><td>" + response[i].numero + "</td><td>" + response[i].fecha + "</td><td>egreso</td>\n\
<td>" + response[i].glosa + "</td>\n\
<td>" + response[i].codigo + "</td>\n\
<td>" + response[i].nombre + "</td>\n\
<td>" + response[i].debe + "</td>\n\
<td>" + response[i].haber + "</td><tr>");
                        total_debe = total_debe + parseInt(response[i].debe);
                        total_haber = total_haber + parseInt(response[i].haber);
                        total_total_debe = total_total_debe + parseInt(response[i].debe);
                        total_total_haber = total_total_haber + parseInt(response[i].haber);

                    }
                }
            }
            if (i + 1 < total_columna) {
                numero1 = response[i].numero;
                numero2 = response[i + 1].numero;
            } else {
                tabla.append("<tr align=center style='background-color: #85E1D5'><td><b>TOTAL ASIENTO DEBE, HABER</b></td><td></td><td></td>\n\
<td></td>\n\
<td></td>\n\
<td></td>\n\
<td><b>" + total_debe + "</b></td>\n\
<td><b>" + total_haber + "</b></td><tr>");
                tabla.append("<tr align=center style='background-color: #FC74A6'><td><b>TOTAL DEBE, HABER</b></td><td></td><td></td>\n\
<td></td>\n\
<td></td>\n\
<td></td>\n\
<td><b>" + total_total_debe + "</b></td>\n\
<td><b>" + total_total_haber + "</b></td><tr>");

            }
        }




    });

}

function reporte_libro_mayor() {
    var fecha1 = $('#fecha').val();
    var fecha2 = $('#fecha2').val();
    var numero1 = "";
    var numero2 = "";
    var total_columna = 0;
    $('#tabla').empty();
    var tabla = $('#tabla');
    $.get('reporte_libro_mayor/' + fecha1 + '/' + fecha2, function (response) {
        total_columna = response[0][0].length;
        for (i = 0; i < response.length; i++) {
            for (j = 0; j < response[i].length; j++) {
                if (j == 0) {
                    tabla.append("<tr style='background-color: #2ECCFA'><td><b>" + response[i][j].codigo + "</b></td>\n\
<td style='background-color: #A9D0F'><b>" + response[i][j].nombre + "<b></td>\n\
<td style='background-color: #A9D0F'>" + response[i][j].numero + "</td>\n\
<td style='background-color: #A9D0F'>" + response[i][j].debe + "</td>\n\
<td style='background-color: #A9D0F'>" + response[i][j].haber + "</td>\n\
<tr>");
                     total_debe = total_debe + parseInt(response[i][j].debe);
                        total_haber = total_haber + parseInt(response[i][j].haber);
                         total_total_debe = total_total_debe + parseInt(response[i][j].debe);
                        total_total_haber = total_total_haber + parseInt(response[i][j].haber);
                }
                else{
                   tabla.append("<tr ><td></td>\n\
<td></td>\n\
<td>" + response[i][j].numero + "</td>\n\
<td >" + response[i][j].debe + "</td>\n\
<td >" + response[i][j].haber + "</td>\n\
<tr>");   
                     total_debe = total_debe + parseInt(response[i][j].debe);
                        total_haber = total_haber + parseInt(response[i][j].haber);
                         total_total_debe = total_total_debe + parseInt(response[i][j].debe);
                        total_total_haber = total_total_haber + parseInt(response[i][j].haber);
                }

            }
              tabla.append("<tr align=center style='background-color: #85E1D5'><td><b>TOTAL ASIENTO DEBE, HABER</b></td><td></td><td></td>\n\
\n\
<td><b>" + total_debe + "</b></td>\n\
<td><b>" + total_haber + "</b></td><tr>");
             tabla.append("<tr ><td></td>\n\
<td></td>\n\
<td></td>\n\
<td ></td>\n\
<td ></td>\n\
<tr>");   
            total_debe=0;
            total_haber=0;
            
        }
         tabla.append("<tr align=center style='background-color: #FC74A6'><td><b>TOTAL DEBE, HABER</b></td><td></td>\n\
<td></td>\n\
<td><b>" + total_total_debe + "</b></td>\n\
<td><b>" + total_total_haber + "</b></td><tr>");
    });
}