<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 01/10/14
 * Time: 02:26 PM
 */



include_once('../../db.php');
$response = array();

$codigo = $_POST['codigo'];


$sql = "SELECT * FROM mno_new_concepto WHERE codigo = '$codigo'";


$result=mysql_query($sql);

$test = mysql_fetch_array($result);

//echo($test['valor']);


$response['valor'] = $test['valor'];
$response['tipo_pago'] = $test['tipo_forma_pago'];
$response['tipo_periocidad'] = $test['tipo_periocidad'];



echo json_encode($response);