<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html >
<head>
<title>SICAP | Sistema Integral de Costos</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="author" content="Tomas Bagdanavicius, http://www.lwis.net/free-css-drop-down-menu/" />
<meta name="keywords" content=" css, dropdowns, dropdown menu, drop-down, menu, navigation, nav, horizontal, vertical left-to-right, vertical right-to-left, horizontal linear, horizontal upwards, cross browser, internet explorer, ie, firefox, safari, opera, browser, lwis" />
<meta name="description" content="Clean, standards-friendly, modular framework for dropdown menus" />
<link href="../../css/helper.css" media="screen" rel="stylesheet" type="text/css" />
<script src="../../js/htmlDatePicker.js" type="text/javascript"></script>

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
            <h1><img src="../../images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong>                Módulo de Recursos Humanos | Cargo</strong></h1>
    
<table border=none class="tablas-nuevas">
   
    <tr id="tmp">
        <th >Código</th>
        <th>Código Alias</th>
        <th>Descripción</th>
        <th>Serial</th>
        <th>Precio A</th>
        <th>Precio B</th>
        <th>Precio C</th>
        <th>Precio D</th>
        <th>Existencia Inicial</th>
        <th>Existencia Máxima</th>
        <!--<th>Foto Artículo</th>-->
        <th>Ubicación</th>
        <th>Peso</th>
        <th>Profundidad</th>
        <th>Ancho</th>
        <th>Fabricante</th>
        <th>Fecha Vencimiento</th>
        <th>Observación</th>
        <th>Unidad de Medida</th>
    </tr>
    <?php
	include("../../db.php");
	$result=mysql_query("SELECT * FROM min_articulos");
        while($test = mysql_fetch_array($result))
        	{

                    $id = $test['codigo'];	
                    echo "<tr align='center'>";	
                    //echo"<td><font color='black'>" .$test['codigo']."</font></td>";
                    echo"<td><font color='black'>". $test['codigo']. "</font></td>";
                    echo"<td><font color='black'>" .$test['codigo_alias']."</font></td>";
                    echo"<td><font color='black'>". $test['descripcion']."</font></td>";
                    echo"<td><font color='black'>". $test['serial']."</font></td>";
                    echo"<td><font color='black'>". $test['precio_a']."</font></td>";
                    echo"<td><font color='black'>". $test['precio_b']."</font></td>";
                    echo"<td><font color='black'>". $test['precio_c']."</font></td>";
                    echo"<td><font color='black'>". $test['precio_d']."</font></td>";
                    echo"<td><font color='black'>". $test['existencia_inicial']."</font></td>";
                    echo"<td><font color='black'>". $test['existencia_maxima']."</font></td>";
                    /*echo"<td><font color='black'>". $test['foto_articulo']."</font></td>";*/
                    echo"<td><font color='black'>". $test['ubicacion']."</font></td>";
                    echo"<td><font color='black'>". $test['peso']."</font></td>";
                    echo"<td><font color='black'>". $test['profundidad']."</font></td>";
                    echo"<td><font color='black'>". $test['ancho']."</font></td>";
                    echo"<td><font color='black'>". $test['fabricante']."</font></td>";
                    echo"<td><font color='black'>". $test['fecha_vencimiento']."</font></td>";
                    echo"<td><font color='black'>". $test['observacion']."</font></td>";
                    echo"<td> <a href ='cargo_mod.php?codigo=$id'>Modificar</a>";
                    echo"<td> <a href ='cargo_del.php?codigo=$id'><center>Borrar</center></a>";
                    echo "</tr>";
		}
	mysql_close($conn);
    ?>
</table> 
    <a href="articulo.php"><input type="button" value="Atras"></a> 
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