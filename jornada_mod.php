<?php

include_once('clases/Seguridad.php');

$a = new Seguridad();

$a->chekear_session();

?>

<?php
       
require("db.php");
$id =$_REQUEST['codigo'];

$result = mysql_query("SELECT * FROM mrh_jornada WHERE codigo  = '$id'");
//echo $result;
//exit;
$test = mysql_fetch_array($result);
if (!$result) 
		{
		die("Error: Data not found..");
		}
             
        $descripcion=$test['descripcion'];
        $horainicio=$test['horainicio'];
        $horafin=$test['horafin'];
        $fechavigencia=$test['fechavigencia'];
            
                
if(isset($_POST['submit']))
{	
        
        $descripcion=$_POST['descripcion'];
        $horainicio=$_POST['horainicio'];
        $horafin=$_POST['horafin'];
        $fechavigencia=$_POST['fechavigencia'];

        $sql = "update mrh_jornada set descripcion='$descripcion',horainicio='$horainicio',
                    horafin='$horafin',fechavigencia='$fechavigencia'
                        where codigo = '$id'";
       //echo $sql;
       //exit;
	mysql_query($sql)
        
				or die(mysql_error()); 
	echo "Guardado";
	
	header("Location: jornada_ver.php");			
}
mysql_close($conn);
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



<link rel="stylesheet" href="/resources/demos/style.css">

 <script>
    $(function() {
        $( "#datepicker1" ).datepicker({ dateFormat: 'yy-mm-dd' });
        $( "#datepicker2" ).datepicker({ dateFormat: 'yy-mm-dd' });
        $( "#datepicker3" ).datepicker({ dateFormat: 'yy-mm-dd' });
    });
</script>    
    


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
<TABLE BORDER="0" CELLSPACING="4" WIDTH="500">

     <TR>
          <TD><label>Descripción</label></TD>
          <TD><p><input type="text" name="descripcion" id="descripcion" size="20" value="<?php echo $descripcion?>"></p></TD>
     </TR> 
     <TR>
          <TD><label>Hora de Inicio</label></TD>
          <TD><p><input type="text" name="horainicio" id="horainicio" size="20" value="<?php echo $horainicio?>"></p></TD>
     </TR> 
     <TR>
          <TD><label>Hora de Fin</label></TD>
          <TD><p><input type="text" name="horafin" id="horafin" size="20" value="<?php echo $horafin?>"></p></TD>
     </TR> 
     <TR>
            <TD><label>Fecha de Vigencia</label></TD>
              <TD><p><input type="text" id="datepicker1" name="fechavigencia" value="<?php echo $fechavigencia?>"></p></TD>
     </TR>

</TABLE>

<p><input type="submit" name="submit" value="Guardar datos" ></p>
<a href="jornada_ver.php"><input type="button" value="Ver datos"></a> 

<!-- / END -->




</form>
</body>
</html>
