<?php

include_once('clases/Seguridad.php');

$a = new Seguridad();

$a->chekear_session();

?>

<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 20/09/14
 * Time: 02:15 PM
 */

require_once("clases/ReporteLista.php");


$reporte = new ReporteLista();


$extras = [];
$extras['Reportes de Empleados '] = "";


$sql = 'SELECT * FROM mco_empresa';


$result = mysql_query($sql);

$test = mysql_fetch_array($result);

$direccion = $test['direccion'];

$reporte->config_head("Reporte de Empleados",$direccion,'images/empresalogo.jpg');

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
min_productos_servicios.nombre as "Nombre del Articúlo",
min_productos_servicios.existencia as "Existencia"
FROM min_productos_servicios
INNER JOIN min_tipo_inventario
on min_productos_servicios.inventario = min_tipo_inventario.codigo
WHERE
min_productos_servicios.inventario = 1 ');

$reporte->exec();