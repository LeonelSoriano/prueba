<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 02/10/14
 * Time: 01:12 PM
 */



include_once('../../db.php');
$response = array();

$codigo = $_POST['codigo'];


$sql = "SELECT * FROM mno_new_variables WHERE codigo = '$codigo'";


$result=mysql_query($sql);

$test = mysql_fetch_array($result);

//echo($test['valor']);


$response['valor'] = $test['valor'];




echo json_encode($response);