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
<link href="css/ui-lightness/jquery-ui-1.10.4.custom.css" rel="stylesheet">
	<script src="js/jquery-1.10.2.js"></script>
	<script src="js/jquery-ui-1.10.4.custom.js"></script>   
<script src="js/htmlDatePicker.js" type="text/javascript"></script>
<link href="css/htmlDatePicker.css" rel="stylesheet">

<!-- Beginning of compulsory code below -->

<link href="css/dropdown/dropdown.css" media="screen" rel="stylesheet" type="text/css" />
<link href="css/dropdown/themes/flickr.com/default.ultimate.css" media="screen" rel="stylesheet" type="text/css" />
 <script>
    $(function() {
        $( "#datepicker1" ).datepicker({ dateFormat: 'yy-mm-dd' });
    });
</script>    
<!-- / END -->

</head>
<body class="flickr-com">

<p><a href="mrh_menu.php" class="main-site">Principal</a></p>

<h1><img src="images/flickr.com/icon.png" alt="flickr" />Módulo de Recursos Humanos | Jornada</h1>

<!-- Beginning of compulsory code below -->
<form method="post">
<TABLE BORDER="0" CELLSPACING="4" WIDTH="500">

     <TR>
          <TD><label>Descripción</label></TD>
          <TD><p><input type="text" name="descripcion" id="descripcion" size="20"></p></TD>
     </TR> 
     <TR>
          <TD><label>Hora de Inicio</label></TD>
          <TD><p><input type="text" name="horainicio" id="horainicio" size="20"></p></TD>
     </TR> 
     <TR>
          <TD><label>Hora de Fin</label></TD>
          <TD><p><input type="text" name="horafin" id="horafin" size="20"></p></TD>
     </TR> 
     <TR>
            <TD><label>Fecha de Vigencia</label></TD>
              <TD><p><input type="text" id="datepicker1" name="fechavigencia"></p></TD>
     </TR>

</TABLE>

<p><input type="submit" value="Guardar datos" name="submit"></p>
<a href="jornada_ver.php"><input type="button" value="Ver datos"></a> 
<!-- / END -->

<?php
if (isset($_POST['submit']))
	{	   
	include 'db.php';
        $descripcion=$_POST['descripcion'];
        $horainicio=$_POST['horainicio'];
        $horafin=$_POST['horafin'];
        $fechavigencia=$_POST['fechavigencia'];
        
        $sql = "insert into mrh_jornada(descripcion,horainicio,horafin,fechavigencia)
            values('$descripcion','$horainicio','$horafin','$fechavigencia')";
	//echo $sql;
        //exit;
	mysql_query($sql) or die('No se pudo guardar la información. '.mysql_error());			
	echo "Registro Almacenado";			
	        }
?>
</form>
</body>
</html>

