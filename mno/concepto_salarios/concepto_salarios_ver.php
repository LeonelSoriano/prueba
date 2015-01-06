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

    <br/>
<table border=1  class="tablas-nuevas" >
    <tr style="text-align: center">
        <th>Cedula</th>
        <th>Empleado</th>
        <th>Año</th>
        <th>Mes</th>
        <th>Semana 1</th>
        <th>Semana 2</th>
        <th>Semana 3</th>
        <th>Semana 4</th>
        <th>Semana 5</th>
        <th>Sueldo</th>
        <th></th>

    </tr>
    
      <?php
	include("../../db.php");
        //$cedula =$_POST['cedulaempleado'];
        $codigo =$_REQUEST['codigo'];


	    $result=mysql_query('SELECT
mno_new_concepto_empleado.codigo as codigo,
mno_new_concepto_empleado.codigo_empleado as codigo_empleado,
mno_new_concepto_empleado.mes as mes_codigo,
mrh_empleado.cedula as cedula,
CONCAT_WS(" ",mrh_empleado.primernombre,mrh_empleado.primerapellido) as nombre,
mno_new_concepto_empleado.anhio as anhio,
mrh_mes.descripcion as mes,
mno_new_concepto_empleado.semana_1 as semana_1,
mno_new_concepto_empleado.semana_2 as semana_2,
mno_new_concepto_empleado.semana_3 as semana_3,
mno_new_concepto_empleado.semana_4 as semana_4,
mno_new_concepto_empleado.semana_5 as semana_5,
mno_new_concepto_empleado.total as total
FROM mno_new_concepto_empleado
INNER JOIN mrh_empleado
ON mno_new_concepto_empleado.codigo_empleado = mrh_empleado.codigo
INNER JOIN mrh_mes
ON mrh_mes.codigo = mno_new_concepto_empleado.mes
WHERE mno_new_concepto_empleado.codigo_empleado = '.$codigo.' AND  mno_new_concepto_empleado.codigo_concepto = 1
AND eliminado=\'no\'
ORDER BY mno_new_concepto_empleado.anhio,mno_new_concepto_empleado.mes');



        while($test = mysql_fetch_array($result))
        	{
                //  calculos de horas
                    $id = $test['codigo'];	
                    $codigo_empleado= $test['codigo_empleado'];
                    $mes = $test['mes_codigo'];
                    $anhio = $test['anhio'];

                    echo "<tr align='center'>";
                    //echo"<td><font color='black'>" .$test['codigo']."</font></td>";
                    echo"<td><font color='black'>". $test['cedula']. "</font></td>";
                    echo"<td><font color='black'>" .$test['nombre']."</font></td>";
                    echo"<td><font color='black'>". $test['anhio']."</font></td>";
                    echo"<td><font color='black'>". $test['mes']."</font></td>";
                    echo"<td><font color='black'>" .$test['semana_1']."</font></td>";
                    echo"<td><font color='black'>" .$test['semana_2']."</font></td>";
                    echo"<td><font color='black'>" .$test['semana_3']."</font></td>";
                    echo"<td><font color='black'>" .$test['semana_4']."</font></td>";
                    echo"<td><font color='black'>" .$test['semana_5']."</font></td>";
                    echo"<td><font color='black'>". $test['total']."</font></td>";


                    echo"<td><a href ='concepto_salario_del.php?codigo=".$codigo_empleado."&mes=".$mes."&anhio=".$anhio."'>Borrar</a>";
                    echo "</tr>";
		}
	mysql_close($conn);
    ?>
</table>
    <br/>
<table>    
    <tr>
        <a href="./concepto_salarios.php"><input type="button" value="Atras"></a>
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
