<?php
  include("../../db.php");  

	$gerencia =$_REQUEST['gerencia'];
        $unidad =$_REQUEST['unidad'];
        $departamento =$_REQUEST['departamento'];
	
	
	// sending query
	mysql_query("DELETE FROM mno_departamento WHERE codigounidad = '$unidad' and codigogerencia='$gerencia' and codigo='$departamento'")
	or die(mysql_error());  
        
        echo "<script type='text/javascript'>";
        echo "    alert('Registro Eliminado');";
        echo "</script>";  	
	
	header("Location: departamento_ver.php?gerencia=$gerencia&unidad=$unidad");
?>
