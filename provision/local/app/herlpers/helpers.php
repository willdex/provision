<?php 

use Illuminate\Support\Facades\DB;
class backup{
static public function restaurar(){

$day=date("d");
$mont=date("m");
$year=date("Y");
$hora=date("H-i-s");
$fecha=$day.'_'.$mont.'_'.$year;
$DataBASE=$fecha."_(".$hora."_hrs).sql";
$tables=array();
$result=DB::select('SHOW TABLES');	
if($result){
  foreach ($result as $key => $value) {
  	        $tables[] = $value;
  }
    $sql='SET FOREIGN_KEY_CHECKS=0;'."\n\n";
    $sql.='CREATE DATABASE IF NOT EXISTS '.BD.";\n\n";
    $sql.='USE '.BD.";\n\n";
    foreach($tables as $table){
        $result=DB::select('SELECT * FROM '.$table);
        if($result){
            $numFields=mysql_num_fields($result);
            $sql.='DROP TABLE IF EXISTS '.$table.';';
            $row2=mysql_fetch_row(DB::select('SHOW CREATE TABLE '.$table));
            $sql.="\n\n".$row2[1].";\n\n";
            for ($i=0; $i < $numFields; $i++){
                while($row=mysql_fetch_row($result)){
                    $sql.='INSERT INTO '.$table.' VALUES(';
                    for($j=0; $j<$numFields; $j++){
                        $row[$j]=addslashes($row[$j]);
                        $row[$j]=ereg_replace("\n","\\n",$row[$j]);
                        if (isset($row[$j])){
                            $sql .= '"'.$row[$j].'"' ;
                        }
                        else{
                            $sql.= '""';
                        }
                        if ($j < ($numFields-1)){
                            $sql .= ',';
                        }
                    }
                    $sql.= ");\n";
                }
            }
            $sql.="\n\n\n";
        }else{
            $error=1;
        }
    }
    if($error==1){
        echo 'error';
    }else{
        chmod(BACKUP_PATH, 0777);
        $sql.='SET FOREIGN_KEY_CHECKS=1;';
        $handle=fopen(BACKUP_PATH.$DataBASE,'w+');
        if(fwrite($handle, $sql)){
            fclose($handle);
            echo 'Copia de seguridad realizada';
        }else{
            echo 'Ocurrio un error';
        }
    }
}else{
    echo 'Ocurrio un error inesperado';
}

	}
}


?>