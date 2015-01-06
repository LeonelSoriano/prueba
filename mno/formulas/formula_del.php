<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 28/09/14
 * Time: 03:54 PM
 */


if(isset($_GET['id'])){

    $id = $_GET['id'];

    require_once('../../db.php');
    require_once('../../clases/funciones.php');


    $sql = "DELETE FROM mno_new_formulas WHERE codigo='$id'";


    mysql_query($sql) or die('No se actualizar los kilometros del vehiculo. '.mysql_error());

    redireccion_anterior();

}