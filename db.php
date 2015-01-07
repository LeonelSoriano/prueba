<?php  
error_reporting(E_ALL ^ E_DEPRECATED);
	$conn = mysql_connect('0.0.0.0', 'leonel', '');
	 if (!$conn)
    {
	 die('Could not connect: ' . mysql_error());
	}
	mysql_select_db("db_sicap", $conn);

	mysql_query("SET NAMES utf8") or die('No se pudo guardar la información. '.mysql_error());

