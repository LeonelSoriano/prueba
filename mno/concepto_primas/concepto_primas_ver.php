<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>SICAP | Sistema Integral de Costos</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="author" content="Tomas Bagdanavicius, http://www.lwis.net/free-css-drop-down-menu/" />
<meta name="keywords" content=" css, dropdowns, dropdown menu, drop-down, menu, navigation, nav, horizontal, vertical left-to-right, vertical right-to-left, horizontal linear, horizontal upwards, cross browser, internet explorer, ie, firefox, safari, opera, browser, lwis" />
<meta name="description" content="Clean, standards-friendly, modular framework for dropdown menus" />
<link href="../../css/helper.css" media="screen" rel="stylesheet" type="text/css" />
<link href="../../css/ui-lightness/jquery-ui-1.10.4.custom.css" rel="stylesheet">
<script src="../../js/jquery-1.10.2.js"></script>
<script src="../../js/jquery-ui-1.10.4.custom.js"></script>
<link href="../../css/stylesheet.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="/sicap/resources/demos/style.css">

 <script>
    $(function() {
        $( "#datepicker1" ).datepicker({ dateFormat: 'yy-mm-dd' });
        $( "#datepicker2" ).datepicker({ dateFormat: 'yy-mm-dd' });
        $( "#datepicker3" ).datepicker({ dateFormat: 'yy-mm-dd' });
    });
</script>    
<!-- Beginning of compulsory code below -->

<link href="/sicap/css/dropdown/dropdown.css" media="screen" rel="stylesheet" type="text/css" />
<link href="/sicap/css/dropdown/themes/flickr.com/default.ultimate.css" media="screen" rel="stylesheet" type="text/css" />

<!-- / END -->

</head>
<body class="flickr-com">

<p>&nbsp;</p>
<!-- Beginning of compulsory code below -->
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
  
 <h1><img src="/sicap/images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong>                Módulo de Nómina | Procesar Empleado</strong></h1>
<form method="post">


<table border=1  class="tablas-nuevas" >
    <tr>
        <th>Id</th>
        <th>Empleado</th>
        <th>Mes</th>
        <th>Semana</th>
        <th>Concepto</th>
        <th>Valor</th>

        
    </tr>
    
      <?php
	include("../../db.php");
        //$cedula =$_POST['cedulaempleado'];
        $cedula =$_REQUEST['cedulaempleado'];
        $sql = "select * from mrh_empleado where cedula='$cedula'";
        $result = mysql_query($sql);
        $test = mysql_fetch_array($result);
        if (!$result){die("Error: Data not found..");}
        $codigoempleado = $test['codigo'];
        echo $cedula;
	$result=mysql_query("SELECT * FROM mno_concepto_empleados WHERE codigoempleado='$codigoempleado'");
        while($test = mysql_fetch_array($result))
        	{
                //  calculos de horas
                    $id = $test['codigo'];	
                    echo "<tr align='center'>";	
                    //echo"<td><font color='black'>" .$test['codigo']."</font></td>";
                    echo"<td><font color='black'>". $test['codigo']. "</font></td>";
                    echo"<td><font color='black'>" .$test['codigoempleado']."</font></td>";
                    echo"<td><font color='black'>". $test['codigomes']."</font></td>";
                    echo"<td><font color='black'>". $test['codigosemana']."</font></td>";
                    echo"<td><font color='black'>" .$test['codigoconcepto']."</font></td>";
                    echo"<td><font color='black'>". $test['valor']."</font></td>";

      
                   // $codigoturno = $test['codigoturno'];
                    //$sql = "SELECT descripcion FROM mrh_turnos WHERE codigo =$codigoturno";
                    //echo $sql;
                    //exit;
                    /*$consulta = mysql_query($sql);
                    while($testeo = mysql_fetch_array($consulta)){
                        echo"<td><font color='black'>". $testeo['descripcion']."</font></td>";
                    }*/
                    //echo"<td><font color='black'>". $test['codigoturno']."</font></td>";
                    
                    echo"<td><a href ='turnosxempleado_mod.php?codigo=$id'>Modificar</a>";
                    echo"<td><a href ='turnosxempleado_del.php?codigo=$id'><center>Borrar</center></a>";
                    echo "</tr>";
		}
	mysql_close($conn);
    ?>
</table>
<table>    
    <tr>
        <a href="concepto_empleados.php"><input type="button" value="Atras"></a>
    </tr> 
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
