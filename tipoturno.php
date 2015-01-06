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
<link href="./css/stylesheet.css" rel="stylesheet" type="text/css" />

<!-- / END -->

</head>


<body class="flickr-com">
<!--<p><a href="mrh_menu.html" class="main-site">Principal</a></p>-->
<!--<h1><img src="images/seleccion_sicap_archivos/image002.jpg" alt="flickr" />Módulo de Recursos Humanos | Cargo</h1>-->
<!-- Beginning of compulsory code below -->
<form method="post">
    <div id="body_bottom_bgd">
        <div id=""> <!--<img src="images/Logo_Inventario.png"/>-->
          <!--</div>-->                <!-- Menu -->
                  <!--  ?php include 'include/nav.php'; ?>-->
                <div align="justify" id="right_col" >
                    <div id="header">
                    </div>
                        <div id="">
                            <div id="firefoxbug"><!-- firefoxbug -->
                               <!-- <div id="blue_line"></div>-->
                                <div class="dynamicContent" align="left">
                                  <!--  <h1>Inicio</h1>-->
    <!--<p><a href="seleccion_sicap.html" class="main-site">Principal</a></p>-->
<h1><img src="images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong>                Módulo de Recursos Humanos | Tipo de Turno</strong></h1>

<TABLE BORDER="0" CELLSPACING="4" WIDTH="500">

     <TR>
          <TD><label>Descripción</label></TD>
          <TD><p><input type="text" name="descripcion" id="descripcion" size="20"></p></TD>
     </TR> 
     <TR>
          <TD><label>Hora de Inicio</label></TD>
          <TD><p><input type="text" name="horainicio" id="horainicio" size="10"></p></TD>
     </TR> 
     <TR>
          <TD><label>Hora de Fin</label></TD>
          <TD><p><input type="text" name="horafin" id="horafin" size="10"></p></TD>
     </TR> 
     <TR>
          <TD><label>Horas Semanales</label></TD>
          <TD><p><input type="text" name="horasemanales" id="horasemanales" size="10"></p></TD>
     </TR> 
</TABLE>

<TABLE>
    <TR>
        <TD><input type="submit" value="Guardar datos" name="submit"></TD>
        <TD><a href="tipoturno_ver.php"><input type="button" value="Ver datos"></a> </TD>
        <TD><a href="mrh_menu.php"><input type="button" value="Atras"></a></TD>
    </TR>
</TABLE>
<!-- / END -->
                                    <p></p>
                                </div>
                            </div><!--end firefoxbug-->
                        </div><!--end left_bgd-->

                </div>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p>
                  <!--end right_col-->
                </p>
                <p>&nbsp; </p>
            <div class="clearboth"></div>
        </div>
        <div align="center" class="pie">SICAP 2014</div>
    </div>

        
        
        
<?php
// Rutina para Guardar información
if (isset($_POST['submit']))
	{	   
	include 'db.php';
        $descripcion=$_POST['descripcion'];
        $horainicio=$_POST['horainicio'];
        $horafin=$_POST['horafin'];
        $horasemanales=$_POST['horasemanales'];
        
        $sql = "insert into mrh_tipoturno(descripcion,horainicio,horafin,horasemanales)
                                                      values('$descripcion','$horainicio','$horafin','$horasemanales')";
	//echo $sql;
        //exit;
	mysql_query($sql) or die('No se pudo guardar la información. '.mysql_error());			

        echo "<script type='text/javascript'>";
        echo "    alert('Registro Almacenado');";
        echo "</script>";
	        }
?>
</form>
</body>
</html>