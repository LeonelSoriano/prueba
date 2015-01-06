<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 30/10/14
 * Time: 02:27 PM
 */

include_once('../../db.php');


$mes = $_POST['mes'];
$anio =  $_POST['anhio'];

$str_return = '';
$sql = "SELECT * FROM prc_orden_trabajo WHERE fecha_culminacion LIKE '".$anio."-".$mes."%' AND eliminada='n'";

$result=mysql_query($sql);



//echo ("<option value='hola'>".$test['codigo_alias']."</option>");

$str_return .= ' <select id="ordenes" style="font-size: 1.1em; min-width: 100px">';

$str_return .= "<option value='-1'>----------</option>";
while($test = mysql_fetch_array($result)) {

    $codigo = $test['codigo'];
    $codigo_alias = $test['codigo_alias'];

    $str_return .= "<option value='$codigo'>$codigo_alias</option>";
}
$str_return .= '</select>';
echo($str_return);



