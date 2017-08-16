<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
    <title>REPORTE DE RESERVAS</title>
</head>

<body>

  <img src="{{asset('images/logo.png')}}" width="150px" height="100px" style="float: right;">
  <table>
    <tr>
      <td align="center"> <font size="6">REPORTE DE VENTAS DEL</font> <br>
      <font size="6" color="red"> {{$fecha_inicio_aux[0]->fecha}} </font> <font size="6"> AL </font> <font size="6" color="red"> {{$fecha_fin_aux[0]->fecha}} </font></td>
    </tr> 
  </table>
<br><br>
  <table border="1" style="border-radius: 10px;">
    <thead>
    <tr style="background: #CEF6F5;">
      <th><center>VENDEDOR</center></th>
      <th><center>PROYECTO</center></th>
      <th><center>CLIENTE</center></th>
      <th><center>REGISTRO</center></th>
      <th><center>VENTA</center></th>          
    </tr>
    </thead>
    <tbody align="center">
      @foreach($lista as $list)
      <tr>
        <td align="left">{{$list->empleado}} <br>
        <b>CI:</b> {{$list->ci_empleado}}</td>
        <td align="left">{{$list->nombre}} <br>
        Fase {{$list->fase}} <br>
        Categoria: {{$list->categoria}}<br>
        Manzano: {{$list->manzano}}<br>
        Lote: {{$list->nroLote}}</td>
        <td align="left">{{$list->cliente}} <br>
        <b>CI:</b> {{$list->ci_cliente}}</td>
        <td>{{$list->fecha}}</td>
      <?php 
      switch ($list->estado) {
          case 'c':
              echo "<td>CONTADO</td>";                
              break;
          case 'p':
              echo "<td>PLAZO</td>";                                 
              break;
      }         
      ?>
      </tr>
      @endforeach
    </tbody>
  </table>
</body>
</html>
