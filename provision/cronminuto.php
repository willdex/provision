<?php 

  $cnx = mysql_connect('localhost','root','provision123');
//servidor, usuario, contraseña , base de datos
   $conn= new mysqli('localhost','root','provision123','laprovision');
   if ($conn->connet_errno) {
      echo "conexion fallida";
   }
      /*mysql_select_db('provision',$cnx);
   $sql = 'update reserva set estado = 0 where estado = 1';
   $result = mysql_query($sql,$cnx);*/

      $consulta="select extract(hour from timediff(now(), prereserva.fecha)) as hora,prereserva.id,detalleprereserva.idLote from detalleprereserva, prereserva where prereserva.id=detalleprereserva.idPreReserva and  detalleprereserva.estado='p' and extract(hour from timediff(now(), prereserva.fecha))>=24 ";

    if ($result= $conn->query($consulta)) {
    
    

      while ($row = $result->fetch_assoc()) {
        $sql = 'update detalleprereserva set estado = "d" where estado = "p" and idPreReserva='.$row['id'];
$sql2 = 'update lote set estado = 0 where id = '.$row['idLote'];
        if ($conn->query($sql)===TRUE) {
          echo "modificado correctamente";
          

        }
        else{
          echo "no se modifico nada";
        }
   if ($conn->query($sql2)===TRUE) {
          echo "modificado correctamente";
          

        }
        else{
          echo "no se modifico nada";
        }

      }
      $result->free();
        //$sql = 'update detalleprereserva set estado = "d" where estado = "p" and idPreReserva=';
    }else{
    echo "coneccion fallida";

    }



   mysql_close($cnx);

?>
