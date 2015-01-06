<?php

include_once('clases/Seguridad.php');

$a = new Seguridad();

$a->chekear_session();

?>

<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 24/09/14
 * Time: 10:14 AM
 */


//print_r($_POST);




require_once("clases/ReporteLista.php");
require_once("./db.php");



$empleado_id = $_POST['codigo_empleado_hi'];
$anhio = $_POST['anhio'];
$mes = $_POST['mes'];

$reporte = new ReporteLista();


$extras = [];
$extras['Reportes de Turnos '] = "";
$extras[''] = "";





    $sql = "SELECT * FROM mrh_empleado WHERE codigo = '$empleado_id'";
    $result=mysql_query($sql);
    $test = mysql_fetch_array($result);

    $cedula =  $test['cedula'];
    $primernombre = $test['primernombre'];
    $primerapellido = $test['primerapellido'];

    $extras['Empleado: '] = $primerapellido .' ' . $primernombre;
    $extras['Cedula: '] = $cedula;




$sql = 'SELECT * FROM mco_empresa';


$result = mysql_query($sql);

$test = mysql_fetch_array($result);

$direccion = $test['direccion'];
//j-30598122-1

$reporte->config_head("Reporte Horario",$direccion,'images/empresalogo.jpg',$extras);

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


if($mes == '-'){

    $reporte->config_body('SELECT
mrh_turnos.horaentrada as "Hora de Entrada",
mrh_turnos.horasalida as "Hora Salida",
mrh_turnos.horadescanso as "Hora Descanso",
mrh_turnos.descripciontipoturno as "Tipo de Turno",
mrh_turnos.horaextradiurno as "Hora Extra Diurno",
mrh_turnos.horaextranocturno as "Hora Extra Nocturno",
mrh_turnos.horatsemana as "Horas Semanales",
mrh_turnos.bononocsemanal as "Bono Nocturno Semanal",
mrh_mes.descripcion as "Mes"

FROM mrh_turnoxempleado
INNER JOIN mrh_empleado
ON mrh_turnoxempleado.cedulaempleado = mrh_empleado.cedula
INNER JOIN mrh_turnos
ON mrh_turnos.codigo = mrh_turnoxempleado.codigoturno
INNER JOIN mrh_mes
on mrh_mes.codigo = mrh_turnoxempleado.codigomes
WHERE mrh_empleado.codigo = '.$empleado_id.' AND
mrh_turnoxempleado.anhio = '.$anhio.'
');


}else{

    $reporte->config_body('SELECT

mrh_turnos.horaentrada as "Hora de Entrada",
mrh_turnos.horasalida as "Hora Salida",
mrh_turnos.horadescanso as "Hora Descanso",
mrh_turnos.descripciontipoturno as "Tipo de Turno",
mrh_turnos.horaextradiurno as "Hora Extra Diurno",
mrh_turnos.horaextranocturno as "Hora Extra Nocturno",
mrh_turnos.horatsemana as "Horas Semanales",
mrh_turnos.bononocsemanal as "Bono Nocturno Semanal",
mrh_mes.descripcion as "Mes"

FROM mrh_turnoxempleado
INNER JOIN mrh_empleado
ON mrh_turnoxempleado.cedulaempleado = mrh_empleado.cedula
INNER JOIN mrh_turnos
ON mrh_turnos.codigo = mrh_turnoxempleado.codigoturno
INNER JOIN mrh_mes
on mrh_mes.codigo = mrh_turnoxempleado.codigomes
WHERE mrh_empleado.codigo = '.$empleado_id.' AND
mrh_turnoxempleado.anhio = '.$anhio.' AND
mrh_turnoxempleado.codigomes = '.$mes.'
');


}




$reporte->exec();