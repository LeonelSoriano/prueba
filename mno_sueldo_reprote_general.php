<?php

include_once('clases/Seguridad.php');

$a = new Seguridad();

$a->chekear_session();

?>

<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 30/09/14
 * Time: 12:54 AM
 */

header("Content-Type: text/html;charset=utf-8");
ini_set('display_errors', 'On');
ini_set('display_errors', 1);



require_once("./clases/ReporteLista.php");
require_once("./clases/funciones.php");



$anhio = $_GET['anhio'];
$mes = $_GET['mes'];

$numero_lunes = count(getMondays($anhio,$mes));

$quinta_semana = 0;

if($numero_lunes == 5){
    $quinta_semana = 5;
}







$reporte = new ReporteLista();


$extras = [];
$extras['Reportes de Empleados '] = "";
$extras[$anhio] = codigo_to_mes($mes);


$sql = 'SELECT * FROM mco_empresa';


$result = mysql_query($sql);

$test = mysql_fetch_array($result);

$direccion = $test['direccion'];

$reporte->config_head("Reporte de sueldos",$direccion,'images/empresalogo.jpg');

//$reporte->config_body('SELECT
//mrh_empleado.cedula as "Cedula de Identidad",
//CONCAT_WS(" ",mrh_empleado.primernombre,mrh_empleado.primerapellido) as "Nombre",
//mrh_cargo.descripcion as "Cargo",
//mrh_empleado.fechanacimiento as "Fecha de Nacimiento",
//mrh_empleado.telefono as "Telefono",
//mrh_empleado.direccionhabitacion as "Direccion Habitación"
//FROM mrh_empleado
//INNER JOIN mrh_cargo
//ON mrh_cargo.codigo = mrh_empleado.codigocargo
//ORDER BY mrh_empleado.cedula;');

$str_sql = 'SELECT
mrh_empleado.cedula as "Cédula",
CONCAT_WS(" ",mrh_empleado.primernombre,mrh_empleado.primerapellido) as "Nombre",
mrh_cargo.descripcion as "Cargo",
REPLACE(REPLACE(REPLACE(FORMAT(TRUNCATE(mno_new_concepto_empleado.semana_1,2),2),",","A"),".",","),"A",".") as "Semana Uno",
REPLACE(REPLACE(REPLACE(FORMAT(TRUNCATE(mno_new_concepto_empleado.semana_2,2),2),",","A"),".",","),"A",".") as "Semana Dos",
REPLACE(REPLACE(REPLACE(FORMAT(TRUNCATE(mno_new_concepto_empleado.semana_3,2),2),",","A"),".",","),"A",".") as "Semana Tres",
REPLACE(REPLACE(REPLACE(FORMAT(TRUNCATE(mno_new_concepto_empleado.semana_4,2),2),",","A"),".",","),"A",".") as "Semana Cuatro",';

if($numero_lunes == 5){
    $str_sql .= 'REPLACE(REPLACE(REPLACE(FORMAT(TRUNCATE(mno_new_concepto_empleado.semana_5,2),2),",","A"),".",","),"A",".") as "Semana Cinco",';
}

$str_sql .= 'REPLACE(REPLACE(REPLACE(FORMAT(TRUNCATE(mno_new_concepto_empleado.semana_1*'.$numero_lunes.',2),2),",","A"),".",","),"A",".") as "Sueldo Mensual Base(s)",
REPLACE(REPLACE(REPLACE(FORMAT(TRUNCATE(mno_new_concepto_empleado.total,2),2),",","A"),".",","),"A",".") as "Total"
FROM mno_new_concepto_empleado
INNER JOIN mrh_empleado
ON mno_new_concepto_empleado.codigo_empleado = mrh_empleado.codigo
inner join mrh_cargo
on mrh_empleado.codigocargo = mrh_cargo.codigo
INNER JOIN mrh_mes
ON mrh_mes.codigo = mno_new_concepto_empleado.mes
WHERE
mno_new_concepto_empleado.codigo_concepto = 1 AND
mno_new_concepto_empleado.mes = '.$mes.' AND
mno_new_concepto_empleado.anhio = '.$anhio.'
ORDER BY mrh_empleado.cedula*1 DESC';

$reporte->config_body($str_sql);

$reporte->exec();