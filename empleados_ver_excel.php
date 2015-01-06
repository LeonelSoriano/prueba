<?php

include_once('clases/Seguridad.php');

$a = new Seguridad();

$a->chekear_session();

?>

<?php
$file="empleados.xls";
$test="<table  ><tr><td>Cell 1</td><td>Cell 2</td></tr></table>";
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$file");
echo $test;
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
  
 <h1><img src="/sicap/images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong>                Módulo de Nómina | Carga Laboral</strong></h1>

<?php
include("../../db.php");
	$cedula =$_REQUEST['cedulaempleado'];
	$sql = "select * from mrh_empleado where cedula='$cedula'";
	//echo $sql;
    $result = mysql_query($sql);
    $test = mysql_fetch_array($result);
        if (!$result){die("Error: Data not found..");}
        $codigoempleado = $test['codigo'];
        $nombreempleado = $test['primernombre'];
        $apellidoempleado = $test['primerapellido'];
?>

<table border=1  class="tablas-nuevas" >
	<tr>
		<th><?php echo $cedula ?></th>
		
	</tr>
	<tr>
		<th><?php echo $nombreempleado ?></th>
		<th><?php echo $apellidoempleado ?></th>
	</tr>		
   <tr>
   <th>Id</th>
   <th>Empleado</th>  
   <th>Mes</th> 
   <th>Semana</th>  
   <th>Sueldo Base</th>
   <th>Salario Normal</th>
   <th>Salario Integral</th>
   <th>Bonos Fijos</th>  
   <th>Asignaciones Fijas</th>
   <th>Horas Extras Diurnas</th> 
   <th>Horas Extras Nocturnas</th>
   <th>Bono Nocturno</th>
   <th>Total Primas</th>
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
        //echo $cedula;
	    $result=mysql_query("SELECT * FROM mno_cargalaboral WHERE codigoempleado='$codigoempleado'");
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
                    $var_sueldobase = number_format($test['sueldo_base'], 2, ',', '');
                    $var_salario_normal = number_format($test['salario_normal'], 2, ',', '');
                    $var_salario_integral = number_format($test['salario_integral'], 2, ',', '');
                    $var_bono_fijos = number_format($test['bonos_fijos'], 2, ',', '');
                    $var_asignaciones_fijas = number_format($test['asignaciones_fijas'], 2, ',', '');
                    $var_horas_extras_diurnas = number_format($test['horas_extras_diurnas'], 2, ',', '');
                    $var_horas_extras_nocturnas = number_format($test['horas_extras_nocturnas'], 2, ',', '');
                    $var_bono_nocturno = number_format($test['bono_nocturno'], 2, ',', '');
                    $var_total_primas = number_format($test['total_primas'], 2, ',', '');
                   
                    echo"<td><font color='black'>".$var_sueldobase ."</font></td>";
                    echo"<td><font color='black'>". $var_salario_normal."</font></td>";
                    echo"<td><font color='black'>".$var_salario_integral ."</font></td>";
                    echo"<td><font color='black'>".$var_bono_fijos ."</font></td>";
                    echo"<td><font color='black'>". $var_asignaciones_fijas."</font></td>";
                    echo"<td><font color='black'>".$var_horas_extras_diurnas ."</font></td>";
                    echo"<td><font color='black'>". $var_horas_extras_nocturnas."</font></td>";
                    echo"<td><font color='black'>". $var_bono_nocturno."</font></td>";
                    echo"<td><font color='black'>" .$var_total_primas ."</font></td>"; 
                    echo "</tr>";
		}
?>		
</table>
<table border=1  class="tablas-nuevas" >

   <tr>
   <th>Diferencia de Sueldo</th> 
   <th>Cesta Ticket</th>  
   <th>Cesta Ticket Adicional</th>  
   <th>Feriado</th>  
   <th>Vacaciones</th>
   <th>Utilidades</th>  
   <th>Aguinaldos</th>  
   <th>Comisiones</th>  
   <th>Bono Post Vacacional</th>  
   <th>Dias Prestaciones</th>  
   
   </tr>
 <?php  
   	    $result=mysql_query("SELECT * FROM mno_cargalaboral WHERE codigoempleado='$codigoempleado'");
        while($test = mysql_fetch_array($result))
        	{
                //  calculos de horas
                    $id = $test['codigo'];	
                    echo "<tr align='center'>";	
                    $var_diferencia_sueldo = number_format($test['diferencia_sueldo'], 2, ',', '');
                    $var_cestaticket = number_format($test['cestaticket'], 2, ',', '');
                    $var_cestaticket_adicional = number_format($test['cestaticket_adicional'], 2, ',', '');
                    $var_monto_feriado = number_format($test['monto_feriado'], 2, ',', '');
                    $var_bono_vacacional = number_format($test['bono_vacacional'], 2, ',', '');
                    $var_utilidades = number_format($test['utilidades'], 2, ',', '');
                    $var_aguinaldos = number_format($test['aguinaldos'], 2, ',', '');
                    $var_comisiones = number_format($test['comisiones'], 2, ',', '');
                    $var_bono_post_vacacional = number_format($test['bono_post_vacacional'], 2, ',', '');
                    $var_dias_prestaciones = number_format($test['dias_prestaciones'], 2, ',', '');
                   
                    echo"<td><font color='black'>".$var_diferencia_sueldo ."</font></td>";
                    echo"<td><font color='black'>". $var_cestaticket."</font></td>";
                    echo"<td><font color='black'>".$var_cestaticket_adicional ."</font></td>";
                    echo"<td><font color='black'>".$var_monto_feriado ."</font></td>";
                    echo"<td><font color='black'>". $var_bono_vacacional."</font></td>";
                    echo"<td><font color='black'>".$var_utilidades  ."</font></td>";
                    echo"<td><font color='black'>". $var_aguinaldos."</font></td>";
                    echo"<td><font color='black'>". $var_comisiones."</font></td>";
                    echo"<td><font color='black'>" .$var_bono_post_vacacional ."</font></td>"; 
                    echo"<td><font color='black'>" .$var_dias_prestaciones ."</font></td>"; 
                    echo "</tr>";
		}
 ?>  
   
 </table>
 
 
<table border=1  class="tablas-nuevas" >
 
<tr>
   <th>Intereses Prestaciones</th> 
   <th>SSO</th> 
   <th>PIE</th> 
   <th>BANAVIH</th> 
   <th>INCES</th>  
   <th>SINDICATO</th> 
   <th>Deporte</th>  
   <th>Caja de Ahorro</th>
   <th>Otros Beneficios</th>  
   <th>Carga Laboral</th>
   <th>Carga Laboral Veces</th>
   <th>Carga Laboral Porcentaje</th>
 </tr>
 
 <?php

	    $result=mysql_query("SELECT * FROM mno_cargalaboral WHERE codigoempleado='$codigoempleado'");
        while($test = mysql_fetch_array($result))
        	{
                //  calculos de horas
                    $id = $test['codigo'];	
                    echo "<tr align='center'>";	
                    $var_interes_prestaciones= number_format($test['interes_prestaciones'], 2, ',', '');
                    $var_seguro_social = number_format($test['seguro_social'], 2, ',', '');
                    $var_pie = number_format($test['pie'], 2, ',', '');
                    $var_banavih = number_format($test['banavih'], 2, ',', '');
                    $var_inces = number_format($test['inces'], 2, ',', '');
                    $var_sindical = number_format($test['sindical'], 2, ',', '');
                    $var_deporte = number_format($test['deporte'], 2, ',', '');
                    $var_caja_ahorro = number_format($test['caja_ahorro'], 2, ',', '');
                    $var_total_obl= number_format($test['total_obl'], 2, ',', '');
                    $var_cargalaboral= number_format($test['cargalaboral'], 2, ',', '');
                    $var_cargalaboral_veces = number_format($test['cargalaboral_veces'], 2, ',', '');
                    $var_cargalaboral_porc= number_format($test['cargalaboral_porc'], 2, ',', '');                    
                    
                    
                   
                    echo"<td><font color='black'>".$var_interes_prestaciones ."</font></td>";
                    echo"<td><font color='black'>". $var_seguro_social."</font></td>";
                    echo"<td><font color='black'>".$var_pie ."</font></td>";
                    echo"<td><font color='black'>".$var_banavih ."</font></td>";
                    echo"<td><font color='black'>". $var_inces."</font></td>";
                    echo"<td><font color='black'>".$var_sindical ."</font></td>";
                    echo"<td><font color='black'>". $var_deporte."</font></td>";
                    echo"<td><font color='black'>". $var_caja_ahorro."</font></td>";
                    echo"<td><font color='black'>" .$var_total_obl ."</font></td>"; 
                    echo"<td><font color='black'>". $var_cargalaboral."</font></td>";
                    echo"<td><font color='black'>". $var_cargalaboral_veces."</font></td>";
                    echo"<td><font color='black'>" .$var_cargalaboral_porc ."</font></td>";                    
                    
                    echo "</tr>";
		}
?>	
 </table>
 <?php
 
 
 
 
   
	mysql_close($conn);
    ?>
</table>
<table>    
    <tr>
        <a href="carga_laboral.php"><input type="button" value="Atras"></a>
         <td><a href="carga_laboral_ver_excel.php"><input type="button" value="Excel"></a></td>
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
