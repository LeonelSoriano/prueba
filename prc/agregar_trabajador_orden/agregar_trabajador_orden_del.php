<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 03/10/14
 * Time: 11:39 AM
 */







if(isset($_GET['id'])){

    $id = $_GET['id'];

    require_once('../../db.php');
    require_once('../../clases/funciones.php');

    $fecha_actual = fecha_sicap();

    $sql = "UPDATE prc_orden_trabajador SET eliminado = '$fecha_actual' WHERE codigo ='$id'";

    mysql_query($sql) or die('No se pudo guardar la información. '.mysql_error());

    redireccion_anterior();

}