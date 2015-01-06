<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 10/09/14
 * Time: 02:17 PM
 */


if(isset($_GET['codigo'])){

    $id = $_GET['codigo'];

    require_once('../../db.php');
    require_once('../../clases/funciones.php');

    $fecha_actual = fecha_sicap();

    $sql = "UPDATE mco_unidad_erogacion SET eliminado = '$fecha_actual' WHERE codigo ='$id'";

    mysql_query($sql) or die('No se pudo guardar la información. '.mysql_error());

    redireccion_anterior();

}