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

<h1><img src="images/flickr.com/icon.png" alt="flickr" />Módulo de Recursos Humanos | Asignación de Turnos</h1>

<!-- Beginning of compulsory code below -->
<form method="post">
	
<TABLE BORDER="0" CELLSPACING="4" WIDTH="500">

     <TR>
          <TD><label>Cédula de Empleado</label></TD>
          <TD><p><input type="text" name="cedula" id="cedula" size="20"></p></TD>
     </TR> 
     <TR>
		   <TD><label>Seleccione el Turno</label></TD>
           <TD>
			<select id="turno" name="turno">
				<option value="0">-------</option>
				<option value="1">Turno 1</option>
				<option value="2">Turno 2</option>
				<option value="3">Turno 3</option>
				<option value="4">Turno 4</option>
				<option value="5">Turno 5</option>
			</select> 
		  </TD>
		  <td>&nbsp;</td>
		  <td><input type="submit" name="submit" value="Guardar Datos" /></td>

	</TR>
	

	
</TABLE>

<?php
if (isset($_POST['submit']))
	{	   
	include 'db.php';
					$turno= $_POST['turno'] ;					
					$cedula=$_POST['cedula'] ;

												
		 mysql_query("INSERT INTO `mrh_asignacion`(codigoturno,cedulaempleado) 
		 VALUES ('$turno','$cedula')"); 
				
				
	        }
?>
</form>
<table border=1>
	
			<?php
			include("db.php");
			
				
			$result=mysql_query("SELECT * FROM mrh_asignacion");
			
			while($test = mysql_fetch_array($result))
			{
				$id = $test['codigo'];	
				echo "<tr align='center'>";	
				echo"<td><font color='black'>" .$test['codigoturno']."</font></td>";
				echo"<td><font color='black'>". $test['cedulaempleado']. "</font></td>";
				//echo"<td> <a href ='view.php?codigo=$id'>Edit</a>";
				echo"<td> <a href ='asignacion_del.php?codigo=$id'><center>Borrar</center></a>";
									
				echo "</tr>";
			}
			mysql_close($conn);
			?>
</table>


<!-- / END -->

</body>
</html>
