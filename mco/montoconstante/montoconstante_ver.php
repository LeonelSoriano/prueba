<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>SICAP | Sistema Integral de Costos</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="author" content="Tomas Bagdanavicius, http://www.lwis.net/free-css-drop-down-menu/" />
<meta name="keywords" content=" css, dropdowns, dropdown menu, drop-down, menu, navigation, nav, horizontal, vertical left-to-right, vertical right-to-left, horizontal linear, horizontal upwards, cross browser, internet explorer, ie, firefox, safari, opera, browser, lwis" />
<meta name="description" content="Clean, standards-friendly, modular framework for dropdown menus" />
<link href="../../css/helper.css" media="screen" rel="stylesheet" type="text/css" />
<script src="../../js/htmlDatePicker.js" type="text/javascript"></script>
<link href="../../css/htmlDatePicker.css" rel="stylesheet">
<!-- Beginning of compulsory code below -->
<link href="/sicap/css/dropdown/dropdown.css" media="screen" rel="stylesheet" type="text/css" />
<link href="/sicap/css/dropdown/themes/flickr.com/default.ultimate.css" media="screen" rel="stylesheet" type="text/css" />
<link href="../../css/stylesheet.css" rel="stylesheet" type="text/css" />
<!-- / END -->

</head>
<body class="flickr-com">

<!--<p><a href="mrh_menu.html" class="main-site">Principal</a></p>-->

<!--<h1><img src="images/flickr.com/icon.png" alt="flickr" />Módulo de Recursos Humanos | Listado de Turnos</h1>-->

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
    <h1><img src="/sicap/images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong>                Módulo de Nómina | Constante</strong></h1>
    
<table border=1>
    <tr>
        <td align="center">Id</td>
        <td align="center">Constante</td>
        <td align="center">Identificación</td>
        <td align="center">Nombre</td>
        <td align="center">Monto</td>
        <td align="center">Modificar</td>
        <td align="center">Borrar</td>
    </tr>
    <?php
	include("../../db.php");
	$result=mysql_query("SELECT * FROM mco_montoconstante");
        while($test = mysql_fetch_array($result))
        	{
                //  calculos de horas
                    $id = $test['codigo'];	
                    $codigoconstante = $test['codigoconstante'];
                    //echo"<td><font color='black'>" .$test['codigo']."</font></td>";
                    echo"<td><font color='black'>". $test['codigo']. "</font></td>";
                    echo"<td><font color='black'>" .$test['codigoconstante']."</font></td>";
                    
                    $resultado = mysql_query("SELECT * FROM mno_constante WHERE codigo=$codigoconstante");
                    while($testeo = mysql_fetch_array($resultado))
                    {
                        echo"<td><font color='black'>" .$testeo['codigoproceso']."</font></td>";
                        echo"<td><font color='black'>" .$testeo['descripcion']."</font></td>";
                    }
                    echo"<td><font color='black'>". $test['monto']."</font></td>";
                    echo"<td> <a href ='montoconstante_mod.php?codigo=$id&codigoconstante=$codigoconstante'>Modificar</a>";
                    echo"<td> <a href ='montoconstante_del.php?codigo=$id&codigoconstante=$codigoconstante'><center>Borrar</center></a>";
                    echo "</tr>";
		}
	mysql_close($conn);
    ?>
</table> 
<a href="montoconstante.php"><input type="button" value="Atras"></a> 
<p></p>
                                </div>
                            </div><!--end firefoxbug-->
                        </div><!--end left_bgd-->

                </div>
                <p>
                  <!--end right_col-->
                </p>
                <p>&nbsp; </p>
            <div class="clearboth"></div>
        </div>
        <div align="center" class="pie">SICAP 2014</div>
    </div>

<!-- / END -->

</form>

</body>
</html>
