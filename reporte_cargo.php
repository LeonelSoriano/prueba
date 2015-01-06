<?php

include_once('clases/Seguridad.php');

$a = new Seguridad();

$a->chekear_session();

?>

<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 03/12/14
 * Time: 10:41 AM
 */


require_once("clases/ReporteLista.php");


$reporte = new ReporteLista();


$extras = [];
$extras['Reportes de Turnos '] = "";



$sql = 'SELECT * FROM mco_empresa';


$result = mysql_query($sql);

$test = mysql_fetch_array($result);

$direccion = $test['direccion'];


$reporte->config_head("Reporte de Cargos",$direccion,'images/empresalogo.jpg');


$reporte->config_body("SELECT
mrh_cargo.descripcion as Nombre,
mrh_cargo.tipo_cargo as 'Tipo de Mano de Obra',
mrh_cargo.tipo_cargo_opcion as 'Tipo'
 FROM mrh_cargo");

$reporte->exec();

?>


