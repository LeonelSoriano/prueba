<?php

include_once('clases/Seguridad.php');

$a = new Seguridad();

$a->chekear_session();

?>

<?php
  include("db.php");  

	$id =$_REQUEST['codigo'];
	
	
	// sending query
	mysql_query("DELETE FROM mno_aporte WHERE codigo = '$id'")
	or die(mysql_error());  	
        echo "<script language='JavaScript' type='text/javascript'>";
        echo "alert('El Registro se ha Eliminado');";		
        echo "</script>";
	
        header("Location: aporte_ver.php");
?>
