<?php

include_once('clases/Seguridad.php');

$a = new Seguridad();

$a->chekear_session();

?>

<?php
include_once('./clases/funciones.php');
include("./db.php");
$codigo =$_REQUEST['codigo'];
$mes = $_GET['mes'];
$anhio = $_GET['anhio'];


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

<form method="post" >

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
    <h1><img src="images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong>                Módulo de Recursos Humanos | Turnos por Empleado</strong></h1>


                                    <br/>
    <div style="margin-right: 20px">
        <?php  echo(codigo_to_mes($_GET['mes'])); echo('    ');  echo($_GET['anhio']); ?><br/>

        <?php
        echo('</br>');

            $sql = "SELECT * FROM mrh_empleado WHERE codigo = '$codigo'";

             $result=mysql_query($sql);
            $test = mysql_fetch_array($result);

        echo('CI: ');
        echo($test['cedula']);
        echo('  ');
        echo($test['primernombre']);
        echo('  ');
        echo($test['primerapellido']);

        ?>

    </div>
                                    <br/>
<table border=1 class="tablas-nuevas" style="text-align: center">
    <tr>

        <th>Semana</th>
        <th>Hora Entrada</th>
        <th>Hora Salida</th>
        <th>Horas Semanal</th>

<!--        <th></th>-->
<!--        <th></th>-->
    </tr>
    
      <?php

        //$cedula =$_POST['cedulaempleado'];


	$result=mysql_query(" SELECT
    mrh_turnoxempleado.codigo as codigo,
	mrh_empleado.cedula as cedula,
mrh_turnos.horaentrada as entrada,
mrh_turnos.horasalida as salida,
mrh_turnos.horatsemana as semana,
mrh_turnoxempleado.codigosemana as codigosemana
FROM
    mrh_turnoxempleado
        INNER JOIN
    mrh_empleado ON mrh_turnoxempleado.cedulaempleado = mrh_empleado.codigo
        INNER JOIN
    mrh_turnos ON mrh_turnoxempleado.codigoturno = mrh_turnos.codigo
WHERE
    mrh_turnoxempleado.cedulaempleado = '$codigo'
        AND mrh_turnoxempleado.anhio = '$anhio'
        AND mrh_turnoxempleado.codigomes = '$mes' AND mrh_turnoxempleado.eliminado = 'no';");

        while($test = mysql_fetch_array($result))
        	{
                //  calculos de horas
                    $id = $test['codigo'];

                    echo "<tr align='center'>";
                    //echo"<td><font color='black'>" .$test['codigo']."</font></td>";
                    echo"<td><font color='black'>" .$test['codigosemana']."</font></td>";
                    echo"<td><font color='black'>" .$test['entrada']."</font></td>";
                    echo"<td><font color='black'>". $test['salida']."</font></td>";
                    echo"<td><font color='black'>". $test['semana']."</font></td>";


                    //echo"<td><font color='black'>". $test['codigoturno']."</font></td>";
//                    echo"<td><a href ='turnosxempleado_mod.php?codigo=$id'>Modificar</a>";
//                    echo"<td><a href ='turnosxempleado_del.php?codigo=$id'><center>Borrar</center></a>";
                    echo "</tr>";
		}
	mysql_close($conn);
    ?>
</table>
                                    <br/>
<table>    
    <tr>
        <a href="turnosxempleado.php"><input type="button" value="Atras"></a>
        <a href="turnosxempleado_del.php?codigo=<?php echo($codigo); ?>&mes=<?php echo($mes); ?>&anhio=<?php echo($anhio ); ?>"><input type="button" value="Eliminar"></a>
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
