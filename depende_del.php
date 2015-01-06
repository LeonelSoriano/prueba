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
 * Time: 09:33 AM
 */


if(isset($_GET['id'])){

    $id = $_GET['id'];
    $codigo = $_GET['codigo'];

    require_once('./db.php');
    require_once('./clases/funciones.php');




    $sql = "DELETE FROM mrh_empleado_depende WHERE codigo ='$id'";

    mysql_query($sql) or die('No se pudo guardar la información. '.mysql_error());

    $url_anterior =  $_SERVER['HTTP_REFERER'];

    header('Location:'.$url_anterior);
    die;

}