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
require_once('db.php');

$reporte = new ReporteLista();


$extras = [];
$extras['Reportes de Empleados '] = "";

$sql = 'SELECT * FROM mco_empresa';


$result = mysql_query($sql);

$test = mysql_fetch_array($result);

$direccion = $test['direccion'];
//j-30598122-1

$reporte->config_head("Reporte de Empleados",$direccion,'images/empresalogo.jpg',$extras);

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


$reporte->config_body('SELECT
mrh_empleado.nacionalidad as "Nacionalidad",
                          mrh_empleado.cedula as "Cedula",
                          mrh_empleado.ficha as "Ficha",
                          mrh_empleado.primernombre as "Primer Nombre",
                          mrh_empleado.primerapellido as "Primer Apellido",
                          mrh_empleado.condicion as "Condición",
                          mrh_empleado.fechanacimiento as "Fecha de Nacimiento",
                          mrh_empleado.telefono as "Teléfono",
                          mrh_empleado.tipo_trabajador as "Tipo Trabajador",
                          mrh_cargo.descripcion as "Cargo"
                        FROM mrh_empleado
                        INNER JOIN mrh_cargo
                        ON mrh_cargo.codigo = mrh_empleado.codigocargo');

$reporte->exec();