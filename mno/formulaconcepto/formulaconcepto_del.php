<?php
  include("../../db.php");  

	$id =$_REQUEST['codigo'];
        $codigoconstante =$_REQUEST['codigoconcepto'];	
        
        $sql = "update mno_concepto set asignacion='N' where codigo='$codigoconcepto'";
        //echo $sql;
        // exit;
        mysql_query($sql) or die('No se pudo actualizar la información. '.mysql_error());	
	// sending query
	mysql_query("DELETE FROM mco_formulaconcepto WHERE codigo = '$id'")
	or die(mysql_error());  	
	
	header("Location: formulaconcepto_ver.php");
?>
