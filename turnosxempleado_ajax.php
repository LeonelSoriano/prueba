<?php

include_once('clases/Seguridad.php');

$a = new Seguridad();

$a->chekear_session();

?>

<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 13/10/14
 * Time: 01:41 PM
 */

include_once('db.php');
include_once('./clases/funciones.php');


$anhio =  $_POST['anhio'];
$mes = $_POST['mes'];
$check_mensual = $_POST['check_mensual'];

$semanas = count( getMondays($anhio,$mes));


echo('<TABLE BORDER="0" CELLSPACING="10" >');

if($check_mensual == 'no'){



for($i = 0;$i < $semanas;$i++){
    echo("</br>

            <label >Semana ".($i +1)."</label>



            <select name='codigoturno".($i+1)."' id='codigoturno' >");


    $consulta_mysql='select * from mrh_turnos';
    $resultado_consulta_mysql=mysql_query($consulta_mysql);
    while($fila=mysql_fetch_array($resultado_consulta_mysql)){
        echo "<option value='".$fila['codigo']."'>".$fila['descripcion'].'-'.$fila['horaentrada'].'-'.$fila['horasalida']."</option>";
    }

    echo('</select></br>


');
}



}

if($check_mensual == 'si'){


    echo("

            <label style='white-space: nowrap'>Semana</label>


            <select name='codigoturno' id='codigoturno' >");


    $consulta_mysql='select * from mrh_turnos';
    $resultado_consulta_mysql=mysql_query($consulta_mysql);
    while($fila=mysql_fetch_array($resultado_consulta_mysql)){
        echo "<option value='".$fila['codigo']."'>".$fila['descripcion'].'-'.$fila['horaentrada'].'-'.$fila['horasalida']."</option>";
    }

    echo('</select>


');


}

echo('</TABLE>');


mysql_close($conn);