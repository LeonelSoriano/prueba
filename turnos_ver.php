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
    <h1><img src="images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong>                Módulo de Recursos Humanos | Turnos</strong></h1>

<!-- Beginning of compulsory code below -->
<form method="post">

<table border=1  class="tablas-nuevas">
    <tr>
        <th>Nombre Turno</th>  <!-- Nombre Turno -->
        <th>Hora de Entrada</th>  <!-- Hora de Entrada  -->
        <th>Hora de Salida</th>   <!-- Hora de Salida -->
        <th>Hora de Descanso</th>    <!-- Hora de Descanso -->
        <th>Turno</th>    <!-- Turno -->
        <th>Dias Trabajados</th>    <!-- Dias Trabajados -->
        <th>Hora de Trabajo Diario</th>    <!-- Hora de Trabajo Diario -->
        <th>Hora de Trabajo Semanal</th>    <!-- Hora de Trabajo Semanal -->
        <th>Horas Permitidas Laborales</th>    <!-- Horas Permitidas Laborales -->
        <th>Total Horas Extras</th>    <!-- Total Horas Extras -->
        <th>Horas Extra Diurnas</th>    <!-- Horas Extra Diurnas -->
        <th>Horas Extra Nocturnas</th>    <!-- Horas Extra Nocturnas -->
        <th>Horas de Trabajo Mensual</th>    <!-- Horas de Trabajo Mensual -->
        <th>Horas Nocturnas Diarias</th>    <!-- Horas Nocturnas Diarias -->
        <th>Horas Nocturnas Semanales</th>    <!-- Horas Nocturnas Semanales -->
        <th>Horas Nocturnas Mensuales</th>    <!-- Horas Nocturnas Mensuales -->
        <th>Bono Nocturno Diario</th>    <!-- Bono Nocturno Diario -->
        <th>Bono Nocturno Semanal</th>    <!-- Bono Nocturno Semanal-->
        <th>Bono Nocturno Mensual</th>    <!-- Bono Nocturno Mensual -->
        <th>Opciones</th>
    </tr>
    <?php
	include("db.php");
	$result=mysql_query("SELECT * FROM mrh_turnos");
        while($test = mysql_fetch_array($result))
        	{
                //  calculos de horas
                    $id = $test['codigo'];	
                    echo "<tr align='center'>";	
                    echo"<td><font color='black'>". $test['descripcion']. "</font></td>";
                    echo"<td><font color='black'>" .$test['horaentrada']."</font></td>";
                    echo"<td><font color='black'>". $test['horasalida']. "</font></td>";
                    echo"<td><font color='black'>". $test['horadescanso']. "</font></td>";
                    echo"<td><font color='black'>" .$test['descripciontipoturno']."</font></td>";
                    echo"<td><font color='black'>". $test['diaslaborales']. "</font></td>";
                    echo"<td><font color='black'>". $test['horatdiario']. "</font></td>";
                    echo"<td><font color='black'>". $test['horatsemana']. "</font></td>";
                    echo"<td><font color='black'>" .$test['hrslabpermitidas']."</font></td>";
                    echo"<td><font color='black'>" .$test['totalhrsextra']."</font></td>";
                    echo"<td><font color='black'>". $test['horaextradiurno']. "</font></td>";
                    echo"<td><font color='black'>" .$test['horaextranocturno']."</font></td>";
                    echo"<td><font color='black'>". $test['horatmensual']. "</font></td>";
                    echo"<td><font color='black'>". $test['hrsnocdiarias']. "</font></td>";
                    echo"<td><font color='black'>". $test['hrsnocsemanal']. "</font></td>";
                    echo"<td><font color='black'>". $test['hrsnocmensual']. "</font></td>";
                    echo"<td><font color='black'>". $test['bononocdiario']. "</font></td>";
                    echo"<td><font color='black'>" .$test['bononocsemanal']."</font></td>";
                    echo"<td><font color='black'>". $test['bononocmensual']. "</font></td>";
                    
                    echo"<td> <a href ='turnos_mod.php?codigo=$id'>Modificar</a>";
                    echo"<td> <a href ='turnos_del.php?codigo=$id'><center>Borrar</center></a>";
                    echo "</tr>";
		}
	mysql_close($conn);
    ?>
</table> 
<table>    
<td><a href="turnos.php"><input type="button" value="Atras"></a> </td>
<td><a href="turnos_ver_excel.php"><input type="button" value="Excel"></a> </td>
</table>
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
