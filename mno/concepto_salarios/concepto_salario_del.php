<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 30/09/14
 * Time: 12:13 AM
 */



if(isset($_GET['codigo'])){

    $id = $_GET['codigo'];
    $mes = $_GET['mes'];
    $anhio = $_GET['anhio'];

    require_once('../../db.php');
    require_once('../../clases/funciones.php');

    $fecha_actual = fecha_sicap();

    mysql_query('SET SQL_SAFE_UPDATES=0');


    $sql = "UPDATE mno_new_concepto_empleado SET eliminado = '$fecha_actual' WHERE codigo_empleado ='$id'
      AND mes = '$mes' AND anhio ='$anhio' ";



    mysql_query($sql) or die('No se pudo guardar la información. '.mysql_error());

    mysql_query('SET SQL_SAFE_UPDATES=1');

    //redireccion_anterior();

}