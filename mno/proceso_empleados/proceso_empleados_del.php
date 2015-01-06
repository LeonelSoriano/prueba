<?php
  include("../../db.php");  

	$id =$_REQUEST['codigo'];
        
	$sql = "select * from mno_proceso_empleados where codigo=".$id;

        $result = mysql_query($sql);
        $test = mysql_fetch_array($result);
        if (!$result){die("Error: Data not found..");}
        $codigoempleado = $test['codigoempleado'];
        $sql = "select * from mrh_empleado where codigo=".$codigoempleado;
        $result = mysql_query($sql);
        $test = mysql_fetch_array($result);
        if (!$result){die("Error: Data not found..");}
        $cedulaempleado = $test['cedula'];
	
	// sending query
	mysql_query("DELETE FROM mno_proceso_empleados WHERE codigo = '$id'")
	or die(mysql_error());  	
	

        
        
        
	header ("Location: proceso_empleados_ver.php?cedulaempleado=$cedulaempleado");
?>
