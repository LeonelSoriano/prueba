<?php
  include("db.php");  

	$id =$_REQUEST['codigo'];
	
	
	// sending query
	mysql_query("DELETE FROM mrh_jornada WHERE codigo = '$id'")
	or die(mysql_error());  	
	
	header("Location: jornada_ver.php");
?>
