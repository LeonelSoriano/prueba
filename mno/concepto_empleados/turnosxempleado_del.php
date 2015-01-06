<?php
  include("db.php");  

	$id =$_REQUEST['codigo'];
        
	$sql = "select * from mrh_turnoxempleado where codigo=".$id;

        $result = mysql_query($sql);
        $test = mysql_fetch_array($result);
        if (!$result) 
                    {
                        die("Error: Data not found..");
                    }

        $cedulaempleado = $test['cedulaempleado'];
	
	// sending query
	mysql_query("DELETE FROM mrh_turnoxempleado WHERE codigo = '$id'")
	or die(mysql_error());  	
	

        
        
        
	header ("Location: turnosxempleado_ver.php?cedulaempleado=$cedulaempleado");
?>
