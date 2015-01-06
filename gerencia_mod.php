<?php

include_once('clases/Seguridad.php');

$a = new Seguridad();

$a->chekear_session();

?>

<?php
       
require("db.php");
$id =$_REQUEST['codigo'];

$result = mysql_query("SELECT * FROM mrh_gerencia WHERE codigo  = '$id'");
//echo $result;
//exit;
$test = mysql_fetch_array($result);
if (!$result) 
		{
		die("Error: Data not found..");
		}
             
        $codigoalias=$test['codigoalias'];
        $descripcion=$test['descripcion'];
            
                
if(isset($_POST['submit']))
{	
        
        $codigoalias=$_POST['codigoalias'];
        $descripcion=$_POST['descripcion'];

        $sql = "update mrh_gerencia set codigoalias='$codigoalias',descripcion='$descripcion'
                 where codigo = '$id'";
       //echo $sql;
       //exit;
	mysql_query($sql)
        
				or die(mysql_error()); 
	echo "Guardado";
	
	header("Location: gerencia_ver.php");			
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

<h1><img src="images/flickr.com/icon.png" alt="flickr" />Módulo de Recursos Humanos | Gerencia</h1>

<!-- Beginning of compulsory code below -->
<form method="post">
<TABLE BORDER="0" CELLSPACING="4" WIDTH="500">

     <TR>
          <TD><label>Código</label></TD>
          <TD><p><input type="text" name="codigoalias" id="codigoalias" size="20" value="<?php echo $codigoalias?>"></p></TD>
     </TR> 
    <TR>
          <TD><label>Descripción</label></TD>
          <TD><p><input type="text" name="descripcion" id="descripcion" size="20" value="<?php echo $descripcion?>"></p></TD>
     </TR> 
     

</TABLE>

<p><input type="submit" name="submit" value="Guardar datos" ></p>
<a href="departamento_ver.php"><input type="button" value="Ver datos"></a> 

<!-- / END -->
x



</form>
</body>
</html>
