<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 10/09/14
 * Time: 11:45 AM
 */

if(isset($_GET['id']) && isset($_GET['codigo'])){

    $id = $_GET['id'];
    $codigo = $_GET['codigo'];

    include_once('../../db.php');
    include_once('../../clases/funciones.php');

    $fecha_actual = fecha_sicap();


    $sql = "UPDATE bien_metros_departamento
        SET eliminado='$fecha_actual'
        WHERE codigo='$codigo'";


    mysql_query($sql) or die('No se pudo guardar la información. '.mysql_error());

    header("Location: ./agregar_departamento_activo_principal.php?id=$id");

}