<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 20/11/14
 * Time: 10:38 AM
 */



require_once('./../../db.php');
include_once('../../clases/ReporteDivicionTotal.php');
require_once("./../../clases/funciones.php");


$tipo_post = $_POST['tipo'];

$a = new ReporteDivicionTotal();

$extras = array();
$extras['Historial de Compra'] = "";
//
//
//$asd = utf8_decode('Importación');
//
//$historial_tipo = '';
//if($_POST['tipo'] == "compra"){
//    $historial_tipo = 'Compra';
//}else if($_POST['tipo'] == "venta"){
//    $historial_tipo = "Venta";
//}
//


//
//
//
//
//    $sql = '';
//
//
//

//
//
//    $a->setDivicionIndex(0);
//    $a->setDivicionSubIndex(1);
//

$codigo_articulo_hi = '*';
$orden_h = '*';
if(isset($_POST['codigo_articulo_hi'])){
    $codigo_articulo_hi = $_POST['codigo_articulo_hi'];
    $orden_hi = $_POST['orden_hi'];
}

$mes =  $_POST['mes'];
$anhio = $_POST['anhio'];

$tipo = $_POST['tipo'];

$a->configure_header("Reporte de Insumo "  ,"asd",'./../../images/empresalogo.jpg',$extras);

$a->generar($_POST['tipo'],$codigo_articulo_hi,$orden_hi,$mes,$anhio);
    $a->exec();





?>

