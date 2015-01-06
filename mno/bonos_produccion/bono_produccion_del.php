<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 03/10/14
 * Time: 09:04 AM
 */



if(isset($_GET['id'])){

    $id = $_GET['id'];

    require_once('../../db.php');
    require_once('../../clases/funciones.php');

    $fecha_actual = fecha_sicap();

    $sql = "UPDATE mno_new_bonos_produccion SET eliminado = '$fecha_actual' WHERE codigo ='$id'";

    mysql_query($sql) or die('No se pudo guardar la información mno_new_bonos_produccion. '.mysql_error());

    redireccion_anterior();

}



?>


