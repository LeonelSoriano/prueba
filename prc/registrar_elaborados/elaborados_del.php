<?php
header("Content-Type: text/html;charset=utf-8");


include("../../db.php");



$codigo = $_GET['codigo'];

$fecha_actual = date("Y-n-j");

$sql = "UPDATE  prc_elaborados SET desactivo='$fecha_actual' WHERE codigo=$codigo ";

mysql_query($sql) or die('No se pudo guardar la información. '.mysql_error());




// cierro bd
mysql_close($conn);






// redirrecion es directorio actual
$host  = $_SERVER['HTTP_HOST'];
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

$extra = 'elaborados_ver.php';

header("Location: http://$host$uri/$extra");


exit;