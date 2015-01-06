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
    
<table border=1 class="tablas-nuevas">
    <tr>
        <th  align="center">Id</th>
        <th align="center">Concepto</th>
        <th align="center">Identificación</th>
        <th align="center">Nombre</th>
        <th align="center">Fórmula</th>
        <th align="center">Modificar</th>
        <th align="center">Borrar</th>
    </tr>
    <?php
	include("../../db.php");
	$result=mysql_query("SELECT * FROM mco_formulaconcepto");
        while($test = mysql_fetch_array($result))
        	{
                //  calculos de horas
                    $id = $test['codigo'];	
                    $codigoconcepto = $test['codigoconcepto'];
                    //echo"<td><font color='black'>" .$test['codigo']."</font></td>";
                    echo"<td><font color='black'>". $test['codigo']. "</font></td>";
                    echo"<td><font color='black'>" .$test['codigoconcepto']."</font></td>";
                    
                    $sql = "SELECT * FROM mno_concepto WHERE codigo=$codigoconcepto";
                    //echo $sql;
                    $resultado = mysql_query($sql);
                    //echo $resultado;
                    //exit;
                    while($testeo = mysql_fetch_array($resultado))
                    {
                        echo"<td><font color='black'>" .$testeo['codigoproceso']."</font></td>";
                        echo"<td><font color='black'>" .$testeo['descripcion']."</font></td>";
                    }
                    echo"<td><font color='black'>". $test['formula']."</font></td>";
                    echo"<td> <a href ='formulaconcepto_mod.php?codigo=$id&codigoconcepto=$codigoconcepto'>Modificar</a>";
                    echo"<td> <a href ='formulaconcepto_del.php?codigo=$id&codigoconcepto=$codigoconcepto'><center>Borrar</center></a>";
                    echo "</tr>";
		}
	mysql_close($conn);
    ?>
</table> 
<a href="formulaconcepto.php"><input type="button" value="Atras"></a> 
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
