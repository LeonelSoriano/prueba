<?php
       
require("../../db.php");
$id =$_REQUEST['codigo'];

$result = mysql_query("SELECT * FROM mno_gerencia WHERE codigo  = '$id'");
//echo $result;
//exit;
$test = mysql_fetch_array($result);
if (!$result) 
		{
                    die("Error: Data not found..");
		}
             
        $codigogerencia=$test['codigoalias'];
        $descripciongerencia=$test['descripcion'];
        
?>

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
  
 <h1><img src="/sicap/images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong>                Módulo de Nómina | Unidad Administrativa</strong></h1>
<form method="post">

<table border=1>
    <tr>
        <td>
            <?php echo $codigogerencia?>
        </td>
        <td>
            <?php echo $descripciongerencia?>
        </td>
    </tr>
    <tr>
        <td align="center">Id</td>
        <td align="center">Unidad Administrativa</td>
        <td align="center">Descripción</td>
        <td align="center">Modificar</td>
        <td align="center">Eliminar</td>
        <td align="center">Departamento</td>
    </tr>
    <?php
	include("../../db.php");
	$result=mysql_query("SELECT * FROM mno_unidadadm WHERE codigogerencia=$id");
        while($test = mysql_fetch_array($result))
        	{
                //  calculos de horas
                    $unidad = $test['codigo'];	
                    echo "<tr align='center'>";	
                    //echo"<td><font color='black'>" .$test['codigo']."</font></td>";
                    echo"<td><font color='black'>". $test['codigo']. "</font></td>";
                    echo"<td><font coloi='black'>" .$test['codigoalias']."</font></td>";
                    echo"<td><font color='black'>". $test['descripcion']."</font></td>";
                    
                    echo"<td> <a href ='unidadadm_mod.php?gerencia=$id&unidad=$unidad'>Modificar</a>";
                    echo"<td> <a href ='unidadadm_del.php?gerencia=$id&unidad=$unidad'><center>Borrar</center></a>";
                    echo"<td> <a href ='../departamento/departamento.php?gerencia=$id&unidad=$unidad'><center>Departamento</center></a>";
                    echo "</tr>";
		}
	mysql_close($conn);
    ?>
</table> 
<table>   
    <tr>
       <a href="unidadadm.php?codigo=<?php echo $id?>"><input type="button" value="Atras"></a>
    </tr>
</table>    
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
 

<!-- / END -->

</form>

</body>
</html>
