<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 16/09/14
 * Time: 12:46 PM
 */


if(isset($_GET['id'])){

    $id = $_GET['id'];

    require_once('../../db.php');
    require_once('../../clases/funciones.php');

    $fecha_actual = fecha_sicap();

    $sql = "SELECT kilometros,cod_vehiculo FROM bie_revicion_diaria_vhiculo WHERE codigo = '$id'";

    $result=mysql_query($sql);

    $test = mysql_fetch_array($result);

    $kilometros = $test['kilometros'];
    $codigo_vehiculo = $test['cod_vehiculo'];

    $sql = "SELECT kilometros FROM bie_tipo_vehiculo WHERE codigo = '$codigo_vehiculo'";

    $result=mysql_query($sql);
    $test = mysql_fetch_array($result);

    $kilometros_vehiculos = $test['kilometros'];


    $kilometros_actualizados = $kilometros_vehiculos - $kilometros;



    $sql = "UPDATE bie_revicion_diaria_vhiculo SET eliminado = '$fecha_actual' WHERE codigo ='$id'";

    mysql_query($sql) or die('No se pudo guardar la información. '.mysql_error());


    $sql = "UPDATE bie_tipo_vehiculo SET kilometros = '$kilometros_actualizados' WHERE codigo = '$codigo_vehiculo'";


    mysql_query($sql) or die('No se actualizar los kilometros del vehiculo. '.mysql_error());

    redireccion_anterior();

}