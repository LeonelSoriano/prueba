<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 29/10/14
 * Time: 04:15 PM
 */



if(isset($_GET['id'])){

    $id = $_GET['id'];

    require_once('../../db.php');
    require_once('../../clases/funciones.php');

    $fecha_actual = fecha_sicap();

    $sql = "UPDATE min_productos_servicios SET eliminado = '$fecha_actual' WHERE codigo ='$id'";

    mysql_query($sql) or die('No se pudo guardar la información. '.mysql_error());

    redireccion_anterior();

}

?>

