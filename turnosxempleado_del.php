<?php

include_once('clases/Seguridad.php');

$a = new Seguridad();

$a->chekear_session();

?>

<?php
  include("db.php");
include_once("./clases/funciones.php");

	$id =$_REQUEST['codigo'];
    $mes = $_GET['mes'];
    $anhio = $_GET['anhio'];

    $fecha_actual = fecha_sicap();
	
	// sending query
	mysql_query("UPDATE mrh_turnoxempleado SET mrh_turnoxempleado.eliminado=
      '$fecha_actual' WHERE codigomes = '$mes' AND anhio = '$anhio' AND cedulaempleado = '$id'")
	or die(mysql_error());  	
	

        

        
	header ("Location: turnosxempleado.php");
?>
