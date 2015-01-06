<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 26/11/14
 * Time: 02:17 PM
 */


require_once('./../../db.php');
include_once('../../clases/ReporteDivicionTotal.php');
require_once("./../../clases/funciones.php");


$tipo_post = $_POST['tipo'];



$a = new ReporteDivicionTotal();

$extras = array();
$extras['Historial de Compra'] = "";


$a->configure_header("Reporte Mano de Obra","asd",'./../../images/empresalogo.jpg',$extras);




$codigo_articulo_hi = '*';
$orden_h = '*';
if(isset($_POST['codigo_articulo_hi'])){
    $codigo_articulo_hi = $_POST['codigo_articulo_hi'];
    $orden_hi = $_POST['orden_hi'];
}


$mes = $_POST['mes'];
$anhio = $_POST['anhio'];

$a->generar($_POST['tipo'],$codigo_articulo_hi,$orden_hi,$mes,$anhio);
$a->exec();





?>

