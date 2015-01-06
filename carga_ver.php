<?php

include_once('clases/Seguridad.php');

$a = new Seguridad();

$a->chekear_session();

?>

 <?php
        
        require("db.php");
        $id =$_REQUEST['codigo'];
        //echo $id;
        $result = mysql_query("SELECT cedula,primernombre,primerapellido FROM mrh_empleado WHERE codigo  = '$id'");
        $test = mysql_fetch_array($result);
        if (!$result) 
	{
		die("Error: Data not found..");
	}
        $cedulaempleado = $test['cedula'];
        $primernombre = $test['primernombre'];
        $primerapellido = $test['primerapellido'];
        
        
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
    <h1><img src="images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong>                Módulo de Recursos Humanos | Carga</strong></h1>
<table border=1 class="tablas-nuevas">

    <tr>
        <td align = "center"><?php echo $cedulaempleado?><td>
                <td align = "center"><?php echo strtoupper($primernombre." ".$primerapellido)?><td>
        
    </tr>
    
    <tr>
        <th align = "center">Cédula</th>
        <th align = "center">Nombres</th>
        <th align = "center">Apellidos</th>
        <th align = "center">Fecha de Nacimiento</th>
        <th align = "center">Parentesco</th>
        <th align = "center">Estudios</th>
        <th align = "center"></th>
        <th align = "center"></th>
    </tr>

    <?php     
        include("db.php");
	$result=mysql_query("SELECT * FROM mrh_carga where cedulaempleado='".$_GET['codigo']."'");
        while($test = mysql_fetch_array($result))
        	{
                //  calculos de horas
                    $id = $test['codigo'];	
                    $cedula = $test['cedula'];
                    echo "<tr align='center'>";	
                    //echo"<td><font color='black'>" .$test['codigo']."</font></td>";
                    echo"<td><font color='blue'>". $test['cedula']. "</font></td>";
                    echo"<td><font color='black'>". $test['primernombre']." ".$test['segundonombre']. "</font></td>";
                    echo"<td><font color='black'>". $test['primerapellido']." ".$test['segundoapellido']. "</font></td>";
                    echo"<td><font color='black'>" .$test['fechanacimiento']."</font></td>";
                    echo"<td><font color='black'>". $test['parentesco']. "</font></td>";
                    echo"<td><font color='black'>". $test['estudios']. "</font></td>";
                    echo"<td> <a href ='carga_mod.php?codigo=$id&cedula=$cedulaempleado'>Modificar</a>";
                    echo"<td> <a href ='carga_del.php?codigo=$id&cedula=$cedulaempleado'><center>Borrar</center></a>";
//                    echo"<td> <a href ='beneficiosxcarga.php?codigo=$id&cedula=$cedulaempleado'><center>Beneficios</center></a>";
                    echo "</tr>";
		}
	mysql_close($conn);
    ?>

</table>  
    <tr>
        <td>    
            <td><a href ="carga.php?codigo=<?php echo $_GET['codigo']?>"><input type="button" value="Atras"></a></td>
        </td>
    </tr>
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
