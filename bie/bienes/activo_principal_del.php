<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 10/09/14
 * Time: 04:00 PM
 */

if(isset($_GET['id'])){

    $id = $_GET['id'];

    require_once('../../db.php');
    require_once('../../clases/funciones.php');

    $fecha_actual = fecha_sicap();

    $sql = "UPDATE bie_tipo_activo_principal SET eliminado = '$fecha_actual' WHERE codigo ='$id'";

    mysql_query($sql) or die('No se pudo guardar la información. '.mysql_error());

    redireccion_anterior();

}