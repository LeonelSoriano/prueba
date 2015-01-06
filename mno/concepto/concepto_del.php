<?php
  include("../../db.php");  

	$id =$_REQUEST['codigo'];
	
	
	// sending query
	mysql_query("DELETE FROM mno_concepto WHERE codigo = '$id'")
	or die(mysql_error());  	
	
	header("Location: concepto_ver.php");
?>
