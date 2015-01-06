<?php
  include("../../db.php");  

	$id =$_REQUEST['codigo'];
	
	
	// sending query
	mysql_query("DELETE FROM mno_constante WHERE codigo = '$id'")
	or die(mysql_error());  	
	
	header("Location: apartados_ver.php");
?>
