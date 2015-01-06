<?php
  include("../../db.php");  

	$id =$_REQUEST['codigo'];
        $codigoconstante =$_REQUEST['codigoconstante'];	
        
        $sql = "update mno_constante set asignacion='N' where codigo='$codigoconstante'";
        //echo $sql;
        // exit;
        mysql_query($sql) or die('No se pudo actualizar la información. '.mysql_error());	
	// sending query
	mysql_query("DELETE FROM mco_montoconstante WHERE codigo = '$id'")
	or die(mysql_error());  	
	
	header("Location: montoconstante_ver.php");
?>
