<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 30/11/14
 * Time: 11:18 AM
 */

require_once('./../../db.php');
include_once('../../clases/ReporteDivicionTotal.php');
require_once("./../../clases/funciones.php");


$tipo_post = $_POST['tipo'];

$a = new ReporteDivicionTotal();

$extras = array();
$extras['Historial de Compra'] = "";


$codigo_articulo_hi = '*';
$orden_h = '*';
if(isset($_POST['codigo_articulo_hi'])){
    $codigo_articulo_hi = $_POST['codigo_articulo_hi'];
    $orden_hi = $_POST['orden_hi'];
}

$mes =  $_POST['mes'];
$anhio = $_POST['anhio'];

$tipo = $_POST['tipo'];

$a->configure_header("Reporte Estructura de Costo","asd",'./../../images/empresalogo.jpg',$extras);

$a->generar($_POST['tipo'],$codigo_articulo_hi,$orden_hi,$mes,$anhio);
$a->exec();


?>