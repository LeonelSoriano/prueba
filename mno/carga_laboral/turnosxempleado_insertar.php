<?php
include 'db.php';
        $cedulaempleado = $_POST['cedulaempleado'];
        $codigomes = $_POST['codigomes'];
        $codigosemana = $_POST['codigosemana'];
        $codigoturno = $_POST['codigoturno'];					
        $sql = "insert into mrh_turnoxempleado(cedulaempleado,codigomes,codigosemana,codigoturno) 
		 VALUES ('$cedulaempleado','$codigomes','$codigosemana','$codigoturno')";
	//echo $sql;
        mysql_query($sql); 

?> 

