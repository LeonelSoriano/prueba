<?php

include_once("../../clases/funciones.php");
include_once("../../db.php");

if(isset($_GET['codigo']))
{

    $codigo = $_GET['codigo'];

    $fecha_actual = fecha_sicap();

    $sql = "UPDATE prc_orden_trabajo SET eliminada = '$fecha_actual' WHERE codigo='$codigo' ";



    $result = mysql_query($sql) or die('No se pudo guardar la información. '.mysql_error());


    // redirrecion es directorio actual
    $host  = $_SERVER['HTTP_HOST'];
    $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

    $extra = 'ver_ordenes_trabajo.php';

    header("Location: http://$host$uri/$extra");



}

mysql_close($conn);