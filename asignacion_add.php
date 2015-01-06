<?php

include_once('clases/Seguridad.php');

$a = new Seguridad();

$a->chekear_session();

?>

<?php
error_reporting(E_ALL ^ E_DEPRECATED);
// Conectando, seleccionando la base de datos
$link = mysql_connect('localhost', 'root', '123456')
or die('No se pudo conectar: ' . mysql_error());
echo 'Connected successfully';
mysql_select_db('db_sicap') or die('No se pudo seleccionar la base de datos');

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

<h1><img src="images/flickr.com/icon.png" alt="flickr" />Módulo de Recursos Humanos | Asignación de Turnos</h1>

<!-- Beginning of compulsory code below -->

<TABLE BORDER="0" CELLSPACING="4" WIDTH="500">

     <TR>
          <TD><label>Cédula de Empleado</label></TD>
          <TD><p><input type="text" name="cedula" id="cedula" size="20"></p></TD>
     </TR> 
     <TR>
		   <TD><label>Seleccione el Turno</label></TD>
           <TD>
			<select id="turno">
				<option value="0">Turno 1</option>
				<option value="1">Turno 2</option>
				<option value="2">Turno 3</option>
				<option value="3">Turno 4</option>
				<option value="4">Turno 5</option>
			</select> 
		  </TD>
		  
		  <TD>
			 <?php

				mysql_close($link);
			 ?> 
		  </TD>
	</TR>
	

	
</TABLE>


<p><input type="submit" value="Guardar datos" name="B1"></p>
<!-- / END -->

</body>
</html>
