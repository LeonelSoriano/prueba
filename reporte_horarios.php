<?php

include_once('clases/Seguridad.php');

$a = new Seguridad();

$a->chekear_session();

?>

<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 22/09/14
 * Time: 03:56 PM
 */

require_once("clases/ReporteLista.php");


$reporte = new ReporteLista();


$extras = [];
$extras['Reportes de Turnos '] = "";



$sql = 'SELECT * FROM mco_empresa';


$result = mysql_query($sql);

$test = mysql_fetch_array($result);

$direccion = $test['direccion'];



$reporte->config_head("Reporte Horarios",$direccion,'images/empresalogo.jpg');

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


$reporte->config_body('SELECT mrh_turnos.descripcion as "Turno",
mrh_turnos.horaentrada as "Hora de Entrada",
mrh_turnos.horasalida as "Hora de Salida",
mrh_turnos.horadescanso as "Hora de Descanso",
mrh_turnos.descripciontipoturno as "Tipo de Turno",
mrh_turnos.diaslaborales as "Días Laborales",
mrh_turnos.horaextradiurno as "Hora Extra Díurno",
mrh_turnos.horaextranocturno as "Hora Extra Nocturno",
mrh_turnos.horatmensual as "Hora Mensuales",
mrh_turnos.bononocdiario as "Bono Nocturno Diario"
FROM
mrh_turnos');

$reporte->exec();