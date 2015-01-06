<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 05/01/15
 * Time: 04:25 AM
 */

header("Content-Type: text/html;charset=utf-8");
ini_set('display_errors', 'On');
ini_set('display_errors', 1);

include_once('../../clases/LayoutForm.php');
include_once('../../db.php');


$layout = new LayoutForm('Módulo de Inventario | Productos y Servicios ');

$layout->append_to_header('



');

$layout->get_header();


$select_inventario = "";

$result=mysql_query("SELECT tipo FROM min_tipo_inventario");
while($test = mysql_fetch_array($result)){

    $select_inventario .= "<option>". $test["tipo"]."</option>";

}

$unidad_medida = "";

$result=mysql_query("SELECT descripcion,sigla FROM mco_unidad");
while($test = mysql_fetch_array($result)){

    $unidad_medida .= "<option>".$test['descripcion']." (". $test['sigla'].")". "</option>";
}


$layout->set_form(

    '


    '




);


$layout->get_footer();