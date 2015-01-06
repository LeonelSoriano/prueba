<?php
  include("../../db.php");  

	$gerencia =$_REQUEST['gerencia'];
        $unidad =$_REQUEST['unidad'];
	
	
	// sending query
	mysql_query("DELETE FROM mno_unidadadm WHERE codigo = '$unidad' and codigogerencia='$gerencia'")
	or die(mysql_error());  	
	
	header("Location: unidadadm_ver.php?codigo=$gerencia");
?>
