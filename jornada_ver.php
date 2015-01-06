<?php

include_once('clases/Seguridad.php');

$a = new Seguridad();

$a->chekear_session();

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>SICAP | Sistema Integral de Costos</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="author" content="Tomas Bagdanavicius, http://www.lwis.net/free-css-drop-down-menu/" />
<meta name="keywords" content=" css, dropdowns, dropdown menu, drop-down, menu, navigation, nav, horizontal, vertical left-to-right, vertical right-to-left, horizontal linear, horizontal upwards, cross browser, internet explorer, ie, firefox, safari, opera, browser, lwis" />
<meta name="description" content="Clean, standards-friendly, modular framework for dropdown menus" />
<link href="css/helper.css" media="screen" rel="stylesheet" type="text/css" />

<script src="js/htmlDatePicker.js" type="text/javascript"></script>
<link href="css/htmlDatePicker.css" rel="stylesheet">

<!-- Beginning of compulsory code below -->

<link href="css/dropdown/dropdown.css" media="screen" rel="stylesheet" type="text/css" />
<link href="css/dropdown/themes/flickr.com/default.ultimate.css" media="screen" rel="stylesheet" type="text/css" />

<!-- / END -->

</head>
<body class="flickr-com">

<p><a href="mrh_menu.php" class="main-site">Principal</a></p>

<h1><img src="images/flickr.com/icon.png" alt="flickr" />Módulo de Recursos Humanos | Jornada</h1>

<!-- Beginning of compulsory code below -->
<form method="post">

<table border=1>
    <tr>
        <td>Id</td>
        <td>Descripción</td>
        <td>Hora de Inicio</td>
        <td>Hora de Fin</td>
        <td>Fecha de Vigencia</td>
    </tr>
    <?php
	include("db.php");
	$result=mysql_query("SELECT * FROM mrh_jornada");
        while($test = mysql_fetch_array($result))
        	{
                //  calculos de horas
                    $id = $test['codigo'];	
                    echo "<tr align='center'>";	
                    //echo"<td><font color='black'>" .$test['codigo']."</font></td>";
                    echo"<td><font color='black'>". $test['codigo']. "</font></td>";
                    echo"<td><font color='black'>" .$test['descripcion']."</font></td>";
                    echo"<td><font color='black'>". $test['horainicio']."</font></td>";
                    echo"<td><font color='black'>". $test['horafin']."</font></td>";
                    echo"<td><font color='black'>". $test['fechavigencia']."</font></td>";
                    echo"<td> <a href ='jornada_mod.php?codigo=$id'>Modificar</a>";
                    echo"<td> <a href ='jornada_del.php?codigo=$id'><center>Borrar</center></a>";
                    echo "</tr>";
		}
	mysql_close($conn);
    ?>
</table> 
    <a href="jornada.php"><input type="button" value="Atras"></a> 


<!-- / END -->

</form>

</body>
</html>
