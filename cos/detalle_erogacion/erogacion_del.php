<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 04/09/14
 * Time: 11:33 PM
 */


if(isset($_GET['codigo'])){
    include_once('../../db.php');
    include_once('../../clases/funciones.php');

    $hoy = fecha_sicap();

    $codigo = $_GET['codigo'];


    $sql = "UPDATE cos_detalle_erogaciones SET eliminado = '$hoy' WHERE codigo='$codigo'";

    $result = mysql_query($sql);

    if (!$result){
       die("Error: Data not found.. de agregar erogaciones");
    }


}



header('Location: '.$_SERVER['HTTP_REFERER']);