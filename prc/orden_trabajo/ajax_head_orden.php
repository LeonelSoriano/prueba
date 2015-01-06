<?php


if(isset($_POST['codigo']) &&  $_POST['codigo'] != 0){

    include_once('../../db.php');
    include_once('../../clases/funciones.php');


    $codigo =  $_POST['codigo'];



    $sql = "SELECT * FROM prc_orden_trabajo WHERE eliminada = 'n' AND codigo='$codigo'";

    $result=mysql_query($sql);

    $test = mysql_fetch_array($result);


    $codigo_producto = $test['codigo_producto'];

    $produccion_planificada = $test['produccion_planificada'];

    $produccion_real = $test['produccion_real'];

    $fecha_inicio = $test['fecha_inicio'];

    $comentario = $test['comentario'];


    $fecha_culminacion = $test['fecha_culminacion'];


    $sql = "SELECT * FROM min_productos_servicios WHERE codigo ='$codigo_producto'";

    $result=mysql_query($sql);

    $test = mysql_fetch_array($result);

    $nombre_producto = $test['nombre'];

    echo("<br/> <label><span style='font-weight: bold;'>Nombre de producto:</span> ". $nombre_producto."</label>");
    echo("<br/><br/>");
    echo(" <label><span style='font-weight: bold;'>Produccion Plantificada:</span> ".utf8_decode($produccion_planificada)."</label>");
    echo("<br/><br/>");
    echo(" <label><span style='font-weight: bold;'>Produccion Real:</span> ".utf8_decode($produccion_real)."</label>");
    echo("<br/><br/>");
    echo(" <label><span style='font-weight: bold;'>Fecha de Inicio:</span> ".utf8_decode($fecha_inicio)."</label>");
    echo("<br/><br/>");
    echo(" <label><span style='font-weight: bold;'>Fecha de Culminación:</span> ".utf8_decode($fecha_culminacion)."</label>");;

    if(strlen($comentario) != 0){
        echo("<br/><br/>");

        echo(" <label><span style='font-weight: bold;'>Comentario:</span> ".utf8_decode($comentario)."</label>");
    }

    echo("<br/><br/><hr>");

}