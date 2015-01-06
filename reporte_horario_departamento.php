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
 * Time: 11:34 AM
 */


//print_r($_POST);die;




require_once("clases/ReporteLista.php");
require_once("./db.php");
require_once("./clases/funciones.php");



$departamento = $_POST['departamento_hi'];
$anhio = $_POST['anhio'];
$mes = $_POST['mes'];

$reporte = new ReporteLista();


$extras = [];
$extras['Reportes de Turnos '] = "";
$extras[''] = "";


$sql_departamento = '';

if($departamento != ''){

    $sql_departamento = " mrh_empleado.codigo_departamento = '.$departamento.' AND ";

}


$sql = "SELECT * FROM mno_gerencia WHERE codigo = '$departamento'";
$result=mysql_query($sql);
$test = mysql_fetch_array($result);

$descripcion =  $test['descripcion'];


$extras['Departamento: '] = utf8_multiplataforma( $descripcion);


$sql = 'SELECT * FROM mco_empresa';


$result = mysql_query($sql);

$test = mysql_fetch_array($result);

$direccion = $test['direccion'];

$reporte->config_head("Reporte de Horarios por Departamentos",$direccion,'images/empresalogo.jpg');


if($mes == '-'){

    $reporte->config_body('SELECT
mrh_empleado.cedula as "Cedula",
CONCAT_WS(" ",mrh_empleado.primernombre,mrh_empleado.primerapellido) as "Nombre",
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
ON mrh_turnoxempleado.cedulaempleado = mrh_empleado.codigo
INNER JOIN mrh_turnos
ON mrh_turnos.codigo = mrh_turnoxempleado.codigoturno
INNER JOIN mrh_mes
on mrh_mes.codigo = mrh_turnoxempleado.codigomes
WHERE

'.$sql_departamento.'
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
ON mrh_turnoxempleado.cedulaempleado = mrh_empleado.codigo
INNER JOIN mrh_turnos
ON mrh_turnos.codigo = mrh_turnoxempleado.codigoturno
INNER JOIN mrh_mes
on mrh_mes.codigo = mrh_turnoxempleado.codigomes
WHERE '.$sql_departamento.'
mrh_turnoxempleado.anhio = '.$anhio.' AND
mrh_turnoxempleado.codigomes = '.$mes.'
');

}




$reporte->exec();