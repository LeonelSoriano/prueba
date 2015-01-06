<?php
    $cedulaempleado ="";
    $nombre="";
    $apellido="";

if (isset($_POST['eliminar']))
	{	
		include_once("../../db.php");
		$bd_ejecutar = 1;
        $cedulaempleado = $_POST['cedulaempleado'];
        
        $sql = "select * from mrh_empleado where cedula='$cedulaempleado'";
        $result = mysql_query($sql);
        $test = mysql_fetch_array($result);
        if (!$result){die("error mrh_empleado cedula");}
       
        $codigoempleado = $test['codigo'];
        $codigomes = $_POST['mes']; 
        
            if($cedulaempleado==""){
                echo "<script type='text/javascript'>";
                echo "    alert('Debe seleccionar la cedula');";
                echo "</script>";  
                $bd_ejecutar=0;
            }


	
		if ($bd_ejecutar==1){
			// sending query
			mysql_query("DELETE FROM mno_cargalaboral WHERE codigoempleado = '$codigoempleado' and codigomes = '$codigomes'")
			or die(mysql_error());  
			
			echo "<script type='text/javascript'>";
                echo "    alert('Calculo Eliminado');";
                echo "</script>"; 	
        }        
	}
	
if (isset($_POST['ver_turnos']))
	{	
            $bd_mostrar = 1;
            $cedulaempleado = $_POST['cedulaempleado'];   
            $mes = $_POST['mes'];   
            if($cedulaempleado==""){
                echo "<script type='text/javascript'>";
                echo "    alert('Debe seleccionar la cedula');";
                echo "</script>";  
                $bd_mostrar=0;
            }
            
            if ($bd_mostrar==1){
                header ("Location: /sicap/mno/carga_laboral/carga_laboral_ver.php?cedulaempleado=$cedulaempleado&mes=$mes");  
            }
                
	}
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
<form method="post" name="carga_laboral">
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
<TABLE BORDER="0" CELLSPACING="4" WIDTH="500">

    <TR>
        <TD width="173"><label>Cédula de Empleado</label></TD>
        <TD width="94">
            <input type="text" name="cedulaempleado" id="cedulaempleado" size="20"  value=<?php echo $cedulaempleado ?>></TD>
        <TD>
            <!--<input type="submit" value="Buscar" name="submit">-->
            <input type="button" onClick="javascript: buscar_empleado()" name="buscar" value="Buscar" >
        </TD>
    </TR> 
    <TR>
        <TD><label>Nombre</label></TD>
        <TD><input type="text" name="nombre" id="nombre" size="20" disabled value=<?php echo strtoupper($nombre) ?>></TD>
        <TD width="107"><label>Apellido</label></TD>
        <TD width="98"><input type="text" name="apellido" id="apellido" size="20" disabled value=<?php echo strtoupper($apellido) ?>></TD>
    </TR>
    <TR>
        <TD><label>Mes</label></TD>
            <?php // consulta de los meses
        // Consultar la base de datos
                include("../../db.php");
                $consulta_mysql='select * from mrh_mes';
                $resultado_consulta_mysql=mysql_query($consulta_mysql);
                echo "<TD>";
                echo "<select name='mes' id='mes' onChange='cargasemana(this.value)'>";
                    echo "<option value='0'>------</option>";
                    while($fila=mysql_fetch_array($resultado_consulta_mysql)){
                        echo "<option value='".$fila['codigo']."'>".$fila['descripcion']."</option>";
                    }
                echo "</select>";
                echo "</TD>";
             ?>   

        <TD><label>Semana</label></TD>
        <TD>
           <select name='codigosemana' id='codigosemana'></select>
        </TD>
    </TR>
        
</TABLE>

<TABLE>
<TR>
    <TD>
        <a><input type="Submit" name="ver_turnos" value="Ver Datos"></a> 
    </TD>
    <TD>
        <!--<input type="button" onClick="javascript: insertar()" name="asignar" value="Asignar Turno" >-->
        <a><input type="Submit" name="submit" value="Calcular Carga Laboral"></a> 
    </TD> 
    <TD>
        <!--<input type="button" onClick="javascript: insertar()" name="asignar" value="Asignar Turno" >-->
        <a><input type="Submit" name="eliminar" value="Eliminar Calculos"></a> 
    </TD>     
    <TD>
        <a href="/sicap/mno_menu.html"><input type="button" value="Atras"></a> 
    </TD>
</TR>
</TABLE>
<!-- / END -->
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
</form>
</body>
</html>

<script type="text/javascript">
	    //EVENTOS EN javascript

function objetoAjax(){
	var xmlhttp=false;
	try {
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	} catch (e) {
 
	try {
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	} catch (E) {
		xmlhttp = false;
	}
}
 
if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
	  xmlhttp = new XMLHttpRequest();
	}
	return xmlhttp;
}

/*function insertar(){
	
	divResultado = document.getElementById('resultado');
	
	var	cedulaempleado = document.getElementById("cedulaempleado").value;
	var	codigomes = document.getElementById("mes").value;
        var	codigosemana = document.getElementById("semana").value;
        var	codigoturno = document.getElementById("turno").value;
  
  	alert(codigosemana);
	exit;
        
	ajax=objetoAjax();
	ajax.open("POST", "turnosxempleado_insertar.php",true);
	
	ajax.onreadystatechange=function() {
  	if (ajax.readyState==4) {
		divResultado.innerHTML = ajax.responseText
	}
 }

        ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	trama="cedulaempleado="+cedulaempleado+
                "&codigomes="+codigomes+
                    "&codigosemana="+codigosemana+
                        "&codigoturno="+codigoturno;
        //alert(trama);
        //exit;
        ajax.send(trama);

	alert('Registro Guardado');
			
			
}*/

function buscar_empleado(){
    win = window.open("carga_laboral_buscarempleado.php", "nuevo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=400, height=400");
    win.focus(); 
}


function cargasemana(str)
	{
		if (str=="")
		{
			document.getElementById("mes").innerHTML="";
			return;
			
			}
		
		if (window.XMLHttpRequest)
		{// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
			
			}
			else
			{// code for IE6, IE5
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
				
				}
				
		xmlhttp.onreadystatechange=function()
		{
			if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				document.getElementById("codigosemana").innerHTML=xmlhttp.responseText;
				
				}
				
			}
		xmlhttp.open("GET","/sicap/semana.php?codigomes="+str,true);
		
		xmlhttp.send();
	}
</script>


<?php

include("../../db.php");
//$cedulaempleado =$_REQUEST['cedulaempleado'];

if ($cedulaempleado<>""){
    $sql = "select * from mrh_empleado where cedula=".$cedulaempleado;
    $result = mysql_query($sql);
    $test = mysql_fetch_array($result);
    if (!$result){die("mrh_empleado where cedula");}

    $nombre = $test['primernombre'];
    $apellido = $test['primerapellido'];
}
        

if (isset($_POST['submit']))
{	   
       
        
		include("../../db.php");
        $bd_guardar=1;
        
        // aqui va validacion de que si ya existe el calculo de la carga laboral
        
        
        $var_acumulador_carga=0;
		$var_cargalaboral = 0;
		$var_sueldobase =0;
		$var_total_bono =0;
		$var_total_asignacion  =0;
		$var_horas_extras_diurnas  =0;
		$var_horas_extras_nocturnas =0;
		$var_bono_nocturno_total =0;
		$var_total_primas =0;
		$var_diferencia_sueldo =0;
		$var_cestaticket_adicional =0;
		$var_cestaticket =0;
		$var_monto_feriado =0; 
		$var_bono_vacacional =0;
		$var_utilidades =0;
		$var_aguinaldos =0;
		$var_comisiones =0;
		$var_bono_post_vacacional =0;
		$var_dias_prestaciones =0;
		$var_interes_prestaciones =0;
		$var_seguro_social =0;
		$var_pie =0;
		$var_banavih =0;
		$var_inces =0;
		$var_sindical =0;
		$var_deporte =0;
		$var_caja_ahorro =0;
		$var_total_obl =0;
		$var_cargalaboral_veces = 0;
		$var_cargalaboral_porc = 0;
		$var_total_bono_nocturno=0;
		$var_salario_normal = 0;
		$var_salario_integral = 0;
		$var_sueldobase = 0;
		$var_total_salario_normal = 0;
		$var_bono = 0 ;
		$var_total_diferencia_salario = 0;
		$var_total_horas_extras_diurnas = 0;
		$var_total_horas_extras_nocturnas = 0;
		$var_total_bono_extras_nocturno = 0;
		$var_total_cesta_ticket = 0;
		$var_total_cesta_ticket_adicional = 0;
		$var_total_monto_feriado = 0;
		$var_total_bono_otro = 0;
		$var_total_comisiones = 0;
		$var_total_complemento_compensatorio=0;
		$var_total_salario_integral = 0;
		$var_total_bono_no_fijos=0;
		$var_total_comisiones_total = 0;
		
		
		
		
		
		
            
        if($bd_guardar==1){
        
        $cedulaempleado = $_POST['cedulaempleado'];
        
        $sql = "select * from mrh_empleado where cedula='$cedulaempleado'";
        $result = mysql_query($sql);
        $test = mysql_fetch_array($result);
        if (!$result){die("Error: Data not found..");}
       
        $codigoempleado = $test['codigo'];
        $codigomes = $_POST['mes']; 
        $fechaingreso = $test['fechaingreso'];
        
        //$codigosemana= $_POST['codigosemana']; 
        $sql = "select * from mrh_semana where codigomes=$codigomes";
        $consulta = mysql_query($sql);
            while($test = mysql_fetch_array($consulta)){
                $codigosemana = $test['codigosemana'];
                $sql = "select * from mno_proceso_empleados where codigoempleado=$codigoempleado and codigomes=$codigomes and codigosemana=$codigosemana";
                $result = mysql_query($sql);
                while($registro = mysql_fetch_array($result)){
                    $var_gerencia = $registro['codigogerencia'];
                    $var_unidadadm = $registro['codigogerencia'];
                    $var_departamento = $registro['codigodepartamento'];
                    $var_sueldobase = $registro['sueldobase'];
                    //echo $var_sueldobase;       
                    $var_acumulador_carga = $var_sueldobase;
                }
                
                $sql = "select * from mno_view_concepto_empleados  where codigoempleado=$codigoempleado and codigomes=$codigomes and codigosemana=$codigosemana order by codigoproceso";    
                    $result = mysql_query($sql);
                    while($registro = mysql_fetch_array($result)){
                        $codigoconcepto=$registro['codigoconcepto'];
                        $valor =$registro['valor'];
                        //echo $codigoconcepto;
                            $sql = "select * from mco_view_formulaconcepto where codigo=$codigoconcepto ";    
                                   $resultado = mysql_query($sql);
                                   while($campos = mysql_fetch_array($resultado)){
										$formula=$campos['formula'];
										//echo $formula."-";
										$monto_resultado = formula_completa($formula);
										$monto_resultado = calcular_formula($monto_resultado);
										//echo $monto_resultado;
										$monto = $monto_resultado; 
											$sql = "select * from mno_concepto where codigo=$codigoconcepto";
											$ciclo = mysql_query($sql);
											while($field = mysql_fetch_array($ciclo)){
												$var_concepto = $field["codigoproceso"];
												echo $var_concepto;
												$variable = substr($var_concepto,2,3);
												
												// Salario Base
												if ($variable=="1AA"){
														
														$valor = $valor * $monto;
														//echo $valor."-";
														//echo $monto."-";
														$var_multiplo = calcular_lunes($codigomes);
														
														
														$var_sueldobase = $var_sueldobase * $valor * $var_multiplo;
														//echo "-".$var_sueldobase."-";
														$var_sueldobase_semanal = $var_sueldobase * (12/52);
														//echo "-".$var_sueldobase_semanal."-";
														
														$sql = "update 
																	mno_concepto_empleados 
																set 
																	resultado='$var_sueldobase_semanal'
																where 
																	codigoempleado='$codigoempleado' and 
																	codigomes='$codigomes' and 
																	codigosemana='$codigosemana' and
																	codigoconcepto='$codigoconcepto'";
																//echo $sql;
																//exit;
															mysql_query($sql) or die(mysql_error()); 

												}
												
												
												// Asignaciones Fijas y Bonos Fijos 
												elseif ($variable=="1BB"){
														
														$valor = $valor * $monto;
														//echo $valor."-";
														//echo $monto."-";
														
														$var_bono = $valor;
														
														$var_total_bono = $var_total_bono + $var_bono;
														//echo "-".$var_total_bono."-";
													
												} 
												
												
												// Bonos que dependen del sueldo base
												elseif ($variable=="1CA"){
														
														$valor = $valor * $monto;
														//echo $valor."-";
														//echo $monto."-";
														
														$var_bono = $valor * $var_sueldobase;
														
														$sql = "update 
																	mno_concepto_empleados 
																set 
																	resultado='$var_bono'
																where 
																	codigoempleado='$codigoempleado' and 
																	codigomes='$codigomes' and 
																	codigosemana='$codigosemana' and
																	codigoconcepto='$codigoconcepto'";
																//echo $sql;
																//exit;
															mysql_query($sql) or die(mysql_error()); 
														
														$var_total_bono = $var_total_bono + $var_bono;
														//echo "-".$var_total_bono."-";
													
												} 
												
												
												// Bono por Antiguedad
												elseif ($variable=="1CB"){
														
														$valor = $valor * $monto;
														//echo $valor."-";
														//echo $monto."-";
														
														$var_bono = calcular_antiguedad($codigoempleado)*$valor;
														
														$sql = "update 
																	mno_concepto_empleados 
																set 
																	resultado='$var_bono'
																where 
																	codigoempleado='$codigoempleado' and 
																	codigomes='$codigomes' and 
																	codigosemana='$codigosemana' and
																	codigoconcepto='$codigoconcepto'";
																//echo $sql;
																//exit;
															mysql_query($sql) or die(mysql_error()); 
														
														$var_total_bono = $var_total_bono + $var_bono;
														//echo "-".$var_total_bono."-";
													
												}
												
												// Asignaciones Fijas
												// Asignaciones que dependen de una cantidad
												elseif ($variable=="1CC"){
														$valor = $valor * $monto;
														//echo $valor."-";
														//echo $monto."-";
														
														$var_asignacion = $valor;
														
														$var_total_asignacion = $var_total_asignacion + $var_asignacion;
														//echo "-".$var_total_asignacion."-";
												} 
												
												
												// Bono por Años de Servicio
												elseif ($variable=="1CD"){
														$valor = $valor * $monto;
														//echo $valor."-";
														//echo $monto."-";
														
														$var_bono = calcular_anos_servicio($codigoempleado)*$valor;

														$sql = "update 
																	mno_concepto_empleados 
																set 
																	resultado='$var_bono'
																where 
																	codigoempleado='$codigoempleado' and 
																	codigomes='$codigomes' and 
																	codigosemana='$codigosemana' and
																	codigoconcepto='$codigoconcepto'";
																//echo $sql;
																//exit;
															mysql_query($sql) or die(mysql_error()); 
															
														$var_total_bono= $var_total_bono + $var_bono;
														//echo "-".$var_total_asignacion."-";
												}
												// Asignaciones que depende el sueldo base
												elseif ($variable=="1CE"){
														$valor = $valor * $monto;
														//echo $valor."-";
														//echo $monto."-";
														
														$var_asignacion = $valor;
														
														$var_total_asignacion = $var_total_asignacion + $var_asignacion;
														//echo "-".$var_total_asignacion."-";
												}
												
												// Bono Nocturno
												elseif ($variable=="1DD"){
														
														//echo $valor."**";
														//echo $monto."//";
														
														$var_turno = calcular_turno($codigoempleado,$codigomes,$codigosemana);
														
														
														if($var_turno=="D"){
															$var_turno = 8;
															$monto = 0;
														}
														elseif($var_turno=="M"){
															$var_turno = 7.5;
															
														}
														elseif($var_turno=="N"){
															$var_turno = 7;
														}
														
														
														$horas_semanales = calcular_horas_semanales($codigoempleado,$codigomes,$codigosemana);
														
													
														$var_sb = $var_sueldobase * (12/52);
														//echo "||".$var_sb."||";
														
														$var_bono_nocturno = ($var_sb/$var_turno)*$monto*$horas_semanales;
														
														$sql = "update 
																	mno_concepto_empleados 
																set 
																	resultado='$var_bono_nocturno'
																where 
																	codigoempleado='$codigoempleado' and 
																	codigomes='$codigomes' and 
																	codigosemana='$codigosemana' and
																	codigoconcepto='$codigoconcepto'";
																//echo $sql;
																//exit;
															mysql_query($sql) or die(mysql_error()); 
														
														//echo "-| ".$var_bono_nocturno." |-";
														
														
														$var_total_bono_nocturno = $var_total_bono_nocturno + $var_bono_nocturno;
														//echo "-".$var_total_bono_nocturno."-";

														
												}


												// SALARIO NORMAL
												elseif ($variable=="1EE"){
														//echo $valor."**";
														//echo $monto."//";
														
														$var_multiplo = calcular_lunes($codigomes);
														
														$valor = $valor * $monto;

														
														$var_bono_total_normal = 0;
														
														
																												
														$var_variable = 'p$1AA';
														$var_sueldobase_normal= buscar_resultado($var_variable,$codigoempleado,$codigomes,$codigosemana,$codigoconcepto);
														$var_variable = 'p$1BB';
														$var_bono_normal = buscar_resultado($var_variable,$codigoempleado,$codigomes,$codigosemana,$codigoconcepto);
														$var_bono_total_normal = $var_bono_total_normal + $var_bono_normal;
														$var_variable = 'p$1CA';
														$var_bono_normal = buscar_resultado($var_variable,$codigoempleado,$codigomes,$codigosemana,$codigoconcepto);
														$var_bono_total_normal = $var_bono_total_normal + $var_bono_normal;
														$var_variable = 'p$1CB';
														$var_bono_normal = buscar_resultado($var_variable,$codigoempleado,$codigomes,$codigosemana,$codigoconcepto);
														$var_bono_total_normal = $var_bono_total_normal + $var_bono_normal;
														$var_variable = 'p$1CC';
														$var_bono_normal = buscar_resultado($var_variable,$codigoempleado,$codigomes,$codigosemana,$codigoconcepto);
														$var_bono_total_normal = $var_bono_total_normal + $var_bono_normal;
														$var_variable = 'p$1CD';
														$var_bono_normal = buscar_resultado($var_variable,$codigoempleado,$codigomes,$codigosemana,$codigoconcepto);
														$var_bono_total_normal = $var_bono_total_normal + $var_bono_normal;
														$var_variable = 'p$1DD';
														$var_bono_normal = buscar_resultado($var_variable,$codigoempleado,$codigomes,$codigosemana,$codigoconcepto);
														$var_bono_total_normal = $var_bono_total_normal + $var_bono_normal;
														//echo "||||".$var_bono_total_normal."||||";
														
														$var_salario_normal = $var_sueldobase_normal + $var_bono_total_normal;
														$sql = "update 
																	mno_concepto_empleados 
																set 
																	resultado='$var_salario_normal'
																where 
																	codigoempleado='$codigoempleado' and 
																	codigomes='$codigomes' and 
																	codigosemana='$codigosemana' and
																	codigoconcepto='$codigoconcepto'";
																//echo $sql;
																//exit;
														mysql_query($sql) or die(mysql_error()); 
														
														
														$var_total_salario_normal = ($var_sueldobase+$var_total_bono+$var_total_asignacion+$var_total_bono_nocturno);	
														
														
														
														
														//echo "-".$var_salario_normal."-";
														
												}
												
												
												// Horas Extras Diurnas
												elseif ($variable=="1FF"){
														//echo $valor."**";
														//echo $monto."//";
														
														$var_turno = calcular_turno($codigoempleado,$codigomes,$codigosemana);
														
														if($var_turno=="D"){
															$var_turno = 8;
														}
														elseif($var_turno=="M"){
															$var_turno = 7.5;
														}
														elseif($var_turno=="N"){
															$var_turno = 7;
														}
														
														$var_horas_extras_diurno_turno = calcular_diurno($codigoempleado,$codigomes,$codigosemana);
														$valor = ($valor + $var_horas_extras_diurno_turno);
														//echo $var_turno."|";
														$var_horas_extras_diurnas = (($var_salario_normal/$var_turno)*$monto)*$valor;
														$sql = "update 
																	mno_concepto_empleados 
																set 
																	resultado='$var_horas_extras_diurnas'
																where 
																	codigoempleado='$codigoempleado' and 
																	codigomes='$codigomes' and 
																	codigosemana='$codigosemana' and
																	codigoconcepto='$codigoconcepto'";
																//echo $sql;
																//exit;
														mysql_query($sql) or die(mysql_error()); 
														
														$var_total_horas_extras_diurnas = $var_total_horas_extras_diurnas + $var_horas_extras_diurnas;
														
														//echo "-".$var_horas_extras_diurnas."-";
														
														
														
												}
												
												
												// Horas Extras Nocturnas
												elseif ($variable=="1GG"){
														//echo $valor."**";
														//echo $monto."//";
														
														$var_turno = calcular_turno($codigoempleado,$codigomes,$codigosemana);
														
														if($var_turno=="D"){
															$var_turno = 8;
														}
														elseif($var_turno=="M"){
															$var_turno = 7.5;
														}
														elseif($var_turno=="N"){
															$var_turno = 7;
														}
														
														$var_horas_extras_nocturno_turno = calcular_diurno($codigoempleado,$codigomes,$codigosemana);
														$valor = ($valor + $var_horas_extras_diurno_turno);
														//echo $var_turno."|";
														$var_horas_extras_nocturnas = (($var_salario_normal/$var_turno)*$monto)*$valor;
														
														$sql = "update 
																	mno_concepto_empleados 
																set 
																	resultado='$var_horas_extras_nocturnas'
																where 
																	codigoempleado='$codigoempleado' and 
																	codigomes='$codigomes' and 
																	codigosemana='$codigosemana' and
																	codigoconcepto='$codigoconcepto'";
																//echo $sql;
																//exit;
														mysql_query($sql) or die(mysql_error()); 
														
														$var_total_horas_extras_nocturnas = $var_total_horas_extras_nocturnas + $var_horas_extras_nocturnas;
														
														//echo "-".$var_horas_extras_nocturnas."-";
														//echo "-".$var_total_horas_extras_nocturnas."-";
														
														
														
												}
												
												
												// Bono Nocturno Extra
												elseif ($variable=="1GH"){
														//echo $valor."**";
														//echo $monto."//";
														
														$var_turno = calcular_turno($codigoempleado,$codigomes,$codigosemana);
														$valor = $valor * 0;
														
														if($var_turno=="D"){
															$var_turno = 8;
														}
														elseif($var_turno=="M"){
															$var_turno = 7.5;
														}
														elseif($var_turno=="N"){
															$var_turno = 7;
														}
														
														$var_variable = 'p$1GG';
														$var_buscar_horas_extras = buscar_valor_concepto($var_variable,$codigoempleado,$codigomes,$codigosemana,$codigoconcepto);
														$var_horas_extras_nocturno_turno = 0;
														$var_horas_extras_nocturno_turno = calcular_diurno($codigoempleado,$codigomes,$codigosemana);
														
														$valor = ($valor + $var_horas_extras_nocturno_turno);
														//echo $var_turno."|";
														
														$var_bono_extras_nocturno = ((($var_salario_normal/$var_turno)*$monto)*$var_buscar_horas_extras + $var_horas_extras_nocturno_turno);
														
														$sql = "update 
																	mno_concepto_empleados 
																set 
																	resultado='$var_bono_extras_nocturno'
																where 
																	codigoempleado='$codigoempleado' and 
																	codigomes='$codigomes' and 
																	codigosemana='$codigosemana' and
																	codigoconcepto='$codigoconcepto'";
																//echo $sql;
																//exit;
														mysql_query($sql) or die(mysql_error()); 
														
														$var_total_bono_extras_nocturno = $var_total_bono_extras_nocturno + $var_bono_extras_nocturno;
														
														//echo "-".$var_horas_extras_nocturnas."-";
														//echo "-".$var_total_horas_extras_nocturnas."-";
														
												}
												
												
												// Total de Primas
												// Primas que dependen de cantidad
												elseif ($variable=="1HH"){
												        //echo $valor."**";
														//echo $monto."//";		
														
														$valor = ($valor*$monto);

														$var_prima = $valor;
														
														$sql = "update 
																	mno_concepto_empleados 
																set 
																	resultado='$var_prima'
																where 
																	codigoempleado='$codigoempleado' and 
																	codigomes='$codigomes' and 
																	codigosemana='$codigosemana' and
																	codigoconcepto='$codigoconcepto'";
																//echo $sql;
																//exit;
														mysql_query($sql) or die(mysql_error());
														
														
														//echo "-".$var_primas."-";
														$var_total_primas =  $var_total_primas + $var_prima;
														

														
												}
												// Primas por hijos que depende de cantidad
												elseif ($variable=="1HJ"){
												        //echo $valor."**";
														//echo $monto."//";		
														
														$valor = ($valor*$monto);
														$var_cantidad_hijos = buscar_hijos($codigoempleado);
														$var_prima_hijo = $valor * $var_cantidad_hijos;
														
														$sql = "update 
																	mno_concepto_empleados 
																set 
																	resultado='$var_prima_hijo'
																where 
																	codigoempleado='$codigoempleado' and 
																	codigomes='$codigomes' and 
																	codigosemana='$codigosemana' and
																	codigoconcepto='$codigoconcepto'";
																//echo $sql;
																//exit;
														mysql_query($sql) or die(mysql_error());
														
														
														//echo "-".$var_primas."-";
														$var_total_primas =  $var_total_primas + $var_prima_hijo;
														

														
												}
												// Primas por hijos que depende de salario
												elseif ($variable=="1HI"){
												        //echo $valor."**";
														//echo $monto."//";		
														
														$valor = ($valor*$monto);
														$var_cantidad_hijos = buscar_hijos($codigoempleado);
														$var_prima_hijo = $var_salario_normal * $var_cantidad_hijos * $valor;
														
														$sql = "update 
																	mno_concepto_empleados 
																set 
																	resultado='$var_prima_hijo'
																where 
																	codigoempleado='$codigoempleado' and 
																	codigomes='$codigomes' and 
																	codigosemana='$codigosemana' and
																	codigoconcepto='$codigoconcepto'";
																//echo $sql;
																//exit;
														mysql_query($sql) or die(mysql_error());
														
														
														//echo "-".$var_primas."-";
														$var_total_primas =  $var_total_primas + $var_prima_hijo;
														

														
												}
												
												// Diferencia de Sueldo
												elseif ($variable=="1JJ"){
												        //echo $valor."**";
														//echo $monto."//";	
														
														$var_variable = 'p$1EE';
														$var_salario_normal_diferencia = buscar_resultado($var_variable,$codigoempleado,$codigomes,$codigosemana,$codigoconcepto);
														
														//echo "|   ".$var_salario_normal_diferencia."    |";	
														
														
														$var_diferencia_sueldo = $var_salario_normal_diferencia *$monto ;
														$var_total_diferencia_salario = $var_total_diferencia_salario + $var_diferencia_sueldo;
														//echo $var_diferencia_sueldo;
														
													
														
														$sql = "update 
																	mno_concepto_empleados 
																set 
																	resultado='$var_diferencia_sueldo'
																where 
																	codigoempleado='$codigoempleado' and 
																	codigomes='$codigomes' and 
																	codigosemana='$codigosemana' and
																	codigoconcepto='$codigoconcepto'";
																//echo $sql;
																//exit;
														mysql_query($sql) or die(mysql_error()); 

										
														
												} 
												
												
												// calculo de cesta ticket adicional
												
												elseif ($variable=="1KK"){
														//echo $valor."**";
														//echo $monto."//";		

														
														
														$var_cestaticket_adicional = $valor * $monto;

														$sql = "update 
																	mno_concepto_empleados 
																set 
																	resultado='$var_cestaticket_adicional'
																where 
																	codigoempleado='$codigoempleado' and 
																	codigomes='$codigomes' and 
																	codigosemana='$codigosemana' and
																	codigoconcepto='$codigoconcepto'";
																//echo $sql;
																//exit;
														mysql_query($sql) or die(mysql_error()); 
														
														$var_total_cesta_ticket_adicional = $var_total_cesta_ticket_adicional + $var_cestaticket_adicional;														


												} 
												
												// Calculo de Cesta Ticket
												elseif ($variable=="1LL"){
												        //echo "**".$valor."**";
														//echo $monto."//";		
														// calculo de cestaticker
														$var_multiplo = calcular_lunes($codigomes);
														$valor = $valor *$var_multiplo;
														
														$var_cestaticket = $valor * $monto;
														
														$sql = "update 
																	mno_concepto_empleados 
																set 
																	resultado='$var_cestaticket'
																where 
																	codigoempleado='$codigoempleado' and 
																	codigomes='$codigomes' and 
																	codigosemana='$codigosemana' and
																	codigoconcepto='$codigoconcepto'";
																//echo $sql;
																//exit;
														mysql_query($sql) or die(mysql_error()); 
														
														$var_total_cesta_ticket = $var_total_cesta_ticket + $var_cestaticket;
														
														//echo "-".$var_cestaticket;


												} 
												
												// Calculo de Dia Feriado
												elseif ($variable=="1MM"){
												        //echo "**".$valor."**";
														//echo $monto."//";		
														
														
														$var_monto_feriado = $var_salario_normal * $monto * $valor;
														
														$sql = "update 
																	mno_concepto_empleados 
																set 
																	resultado='$var_monto_feriado '
																where 
																	codigoempleado='$codigoempleado' and 
																	codigomes='$codigomes' and 
																	codigosemana='$codigosemana' and
																	codigoconcepto='$codigoconcepto'";
																//echo $sql;
																//exit;
														mysql_query($sql) or die(mysql_error()); 
														
														$var_total_monto_feriado = $var_total_monto_feriado + $var_monto_feriado;
														
														//echo "-".$var_monto_feriado;
														

												} 
												
												// Otros Bonos que no inciden en el salario Normal
												elseif ($variable=="1MN"){
														echo $valor."-";
														echo $monto."-";
														$var_multiplo = calcular_lunes($codigomes);
														$valor = $var_multiplo * $valor;
														$valor = $valor * $monto;
														
														
														$var_bono_otro = $valor;
																					
														$sql = "update 
																	mno_concepto_empleados 
																set 
																	resultado='$var_bono_otro'
																where 
																	codigoempleado='$codigoempleado' and 
																	codigomes='$codigomes' and 
																	codigosemana='$codigosemana' and
																	codigoconcepto='$codigoconcepto'";
																//echo $sql;
																//exit;
															mysql_query($sql) or die(mysql_error()); 
														
														$var_total_bono_otro = $var_total_bono_otro + $var_bono_otro;
														//echo "-".$var_total_bono."-";
													
												}
												
												// Bono que depende del numero de lunes
												elseif ($variable=="1MR"){
														//echo $valor."-";
														//echo $monto."-";
								
														$valor = $valor * $monto;
														
														
														$var_bono_otro = $valor;
																					
														$sql = "update 
																	mno_concepto_empleados 
																set 
																	resultado='$var_bono_otro'
																where 
																	codigoempleado='$codigoempleado' and 
																	codigomes='$codigomes' and 
																	codigosemana='$codigosemana' and
																	codigoconcepto='$codigoconcepto'";
																//echo $sql;
																//exit;
															mysql_query($sql) or die(mysql_error()); 
														
														$var_total_bono_otro = $var_total_bono_otro + $var_bono_otro;
														//echo "-".$var_total_bono."-";
													
												} 
												
												
												// Bono por Produccion
												elseif ($variable=="1MS"){
														//echo $valor."-";
														//echo $monto."-";
														
														$var_multiplo = calcular_lunes($codigomes);
														$valor = $valor * $var_multiplo;
	
														$var_unidades_producidas = buscar_unidades_producidas($codigoempleado,$codigomes,$codigosemana);
														$var_bono_produccion = $valor*$var_unidades_producidas;
																					
														$sql = "update 
																	mno_concepto_empleados 
																set 
																	resultado='$var_bono_produccion'
																where 
																	codigoempleado='$codigoempleado' and 
																	codigomes='$codigomes' and 
																	codigosemana='$codigosemana' and
																	codigoconcepto='$codigoconcepto'";
																//echo $sql;
																//exit;
														
														
														mysql_query($sql) or die(mysql_error()); 
														
														$var_total_bono_otro = $var_total_bono_otro + $var_bono_produccion;
														//echo "-".$var_total_bono."-";
													
												}	
												
																							
												// Bono por Antiguedad

												elseif ($variable=="1MP"){
														
														$valor = $valor * $monto;
														//echo $valor."-";
														//echo $monto."-";
														
														$var_bono_otro = calcular_antiguedad($codigoempleado)*$valor;
														//echo "||||||".$var_bono_otro."||||||";
														
														
														$sql = "update 
																	mno_concepto_empleados 
																set 
																	resultado='$var_bono_otro'
																where 
																	codigoempleado='$codigoempleado' and 
																	codigomes='$codigomes' and 
																	codigosemana='$codigosemana' and
																	codigoconcepto='$codigoconcepto'";
																//echo $sql;
																//exit;
															mysql_query($sql) or die(mysql_error()); 
														
														$var_total_bono_otro = $var_total_bono_otro + $var_bono_otro;
														//echo "-".$var_total_bono."-";
													
												}
												
												
												// Bono por Años de Servicios
												elseif ($variable=="1MQ"){
														$valor = $valor * $monto;
														//echo $valor."-";
														//echo $monto."-";
														
														$var_bono_otro = calcular_anos_servicio($codigoempleado)*$valor;


														$sql = "update 
																	mno_concepto_empleados 
																set 
																	resultado='$var_bono_otro'
																where 
																	codigoempleado='$codigoempleado' and 
																	codigomes='$codigomes' and 
																	codigosemana='$codigosemana' and
																	codigoconcepto='$codigoconcepto'";
																//echo $sql;
																//exit;
															mysql_query($sql) or die(mysql_error()); 
															
														$var_total_bono_otro= $var_total_bono_otro + $var_bono_otro;
														//echo "-".$var_total_asignacion."-";
													
												}
												

												// CAlculo de Bono vacacional
												elseif ($variable=="1NN"){
												       $valor = $valor * $monto;
														//echo $valor."-";
														//echo $monto."-";
														
														$var_bono_vacacional = ($var_salario_normal * calcular_antiguedad_nomina($codigoempleado))/360;
														
														
														$sql = "update 
																	mno_concepto_empleados 
																set 
																	resultado='$var_bono_vacacional'
																where 
																	codigoempleado='$codigoempleado' and 
																	codigomes='$codigomes' and 
																	codigosemana='$codigosemana' and
																	codigoconcepto='$codigoconcepto'";
																//echo $sql;
																//exit;
															mysql_query($sql) or die(mysql_error()); 
														
														
														//echo "-".$var_total_bono."-";
														

												}
												// Calculo de Vacaciones
												elseif ($variable=="1NO"){
												       $valor = $valor * $monto;
														//echo $valor."-";
														//echo $monto."-";
														
														$var_vacaciones = ($var_salario_normal * calcular_antiguedad_nomina($codigoempleado))/360;
														
														
														$sql = "update 
																	mno_concepto_empleados 
																set 
																	resultado='$var_vacaciones'
																where 
																	codigoempleado='$codigoempleado' and 
																	codigomes='$codigomes' and 
																	codigosemana='$codigosemana' and
																	codigoconcepto='$codigoconcepto'";
																//echo $sql;
																//exit;

														mysql_query($sql) or die(mysql_error()); 

												}
												
												 // Calculo de Utilidades
												elseif ($variable=="1OO"){
												
												$var_multiplo = calcular_lunes($codigomes);
												$valor = $valor * $var_multiplo;
														
														//echo $valor."-";
														//echo $monto."-";
														
														$var_utilidades = $var_salario_normal*$monto;

														$sql = "update 
																	mno_concepto_empleados 
																set 
																	resultado='$var_utilidades'
																where 
																	codigoempleado='$codigoempleado' and 
																	codigomes='$codigomes' and 
																	codigosemana='$codigosemana' and
																	codigoconcepto='$codigoconcepto'";
																//echo $sql;
																//exit;
															mysql_query($sql) or die(mysql_error()); 
															
														

												} // Calculo de Aguinaldos
												elseif ($variable=="1PP"){
												$var_multiplo = calcular_lunes($codigomes);
												$valor = $valor * $var_multiplo;
														
														//echo $valor."-";
														//echo $monto."-";
														
														$var_aguinaldos = $var_salario_normal*$monto;

														$sql = "update 
																	mno_concepto_empleados 
																set 
																	resultado='$var_aguinaldos'
																where 
																	codigoempleado='$codigoempleado' and 
																	codigomes='$codigomes' and 
																	codigosemana='$codigosemana' and
																	codigoconcepto='$codigoconcepto'";
																//echo $sql;
																//exit;
															mysql_query($sql) or die(mysql_error()); 
														
												} 
												
												// Calculo de Comisiones
												elseif ($variable=="1QQ"){
												        														$valor = $valor * $monto;
														//echo $valor."-";
														//echo $monto."-";
														
														$var_comisiones = $valor * $monto;

														$sql = "update 
																	mno_concepto_empleados 
																set 
																	resultado='$var_comisiones'
																where 
																	codigoempleado='$codigoempleado' and 
																	codigomes='$codigomes' and 
																	codigosemana='$codigosemana' and
																	codigoconcepto='$codigoconcepto'";
																//echo $sql;
																//exit;
															mysql_query($sql) or die(mysql_error()); 
															
														$var_total_comisiones= $var_total_comisiones + $var_comisiones;
													
												}
												// Comision por Ventas Totales
												elseif ($variable=="1QR"){
												        														$valor = $valor * $monto;
														//echo $valor."-";
														//echo $monto."-";
														
														$var_comisiones_ventas_totales = buscar_ventastotales($codigoempleado,$codigomes,$codigosemana);

														$sql = "update 
																	mno_concepto_empleados 
																set 
																	resultado='$var_comisiones_ventas_totales'
																where 
																	codigoempleado='$codigoempleado' and 
																	codigomes='$codigomes' and 
																	codigosemana='$codigosemana' and
																	codigoconcepto='$codigoconcepto'";
																//echo $sql;
																//exit;
															mysql_query($sql) or die(mysql_error()); 
															
														$var_total_comisiones= $var_total_comisiones + $var_comisiones_ventas_totales;
													
												} 
												// Comision por Ventas a credito
												elseif ($variable=="1QS"){
												        														$valor = $valor * $monto;
														//echo $valor."-";
														//echo $monto."-";
														
														$var_comisiones_ventas_credito = buscar_ventas_credito($codigoempleado,$codigomes,$codigosemana);

														$sql = "update 
																	mno_concepto_empleados 
																set 
																	resultado='$var_comisiones_ventas_credito'
																where 
																	codigoempleado='$codigoempleado' and 
																	codigomes='$codigomes' and 
																	codigosemana='$codigosemana' and
																	codigoconcepto='$codigoconcepto'";
																//echo $sql;
																//exit;
															mysql_query($sql) or die(mysql_error()); 
															
														$var_total_comisiones= $var_total_comisiones + $var_comisiones_ventas_credito;
													
												}
												// Comision por Ventas de contado
												elseif ($variable=="1QT"){
												        														$valor = $valor * $monto;
														//echo $valor."-";
														//echo $monto."-";
														
														$var_comisiones_ventas_contado = buscar_ventas_contado($codigoempleado,$codigomes,$codigosemana);

														$sql = "update 
																	mno_concepto_empleados 
																set 
																	resultado='$var_comisiones_ventas_contado'
																where 
																	codigoempleado='$codigoempleado' and 
																	codigomes='$codigomes' and 
																	codigosemana='$codigosemana' and
																	codigoconcepto='$codigoconcepto'";
																//echo $sql;
																//exit;
															mysql_query($sql) or die(mysql_error()); 
															
														$var_total_comisiones= $var_total_comisiones + $var_comisiones_ventas_contado;
													
												}   
												// Comisiones por Ventas Totales a Colectivos
												elseif ($variable=="1QU"){
												        														$valor = $valor * $monto;
														//echo $valor."-";
														//echo $monto."-";
														
														$var_comisiones_colectivos_totales = buscar_colectivo_totales($codigoempleado,$codigomes,$codigosemana);

														$sql = "update 
																	mno_concepto_empleados 
																set 
																	resultado='$var_comisiones_colectivos_totales'
																where 
																	codigoempleado='$codigoempleado' and 
																	codigomes='$codigomes' and 
																	codigosemana='$codigosemana' and
																	codigoconcepto='$codigoconcepto'";
																//echo $sql;
																//exit;
															mysql_query($sql) or die(mysql_error()); 
															
														$var_total_comisiones= $var_total_comisiones + $var_comisiones_colectivos_totales;
													
												}   
												// Comision por Ventas Creditos a Colectivos
												elseif ($variable=="1QV"){
												        														$valor = $valor * $monto;
														//echo $valor."-";
														//echo $monto."-";
														
														$var_comisiones_colectivos_credito = buscar_colectivo_credito($codigoempleado,$codigomes,$codigosemana);

														$sql = "update 
																	mno_concepto_empleados 
																set 
																	resultado='$var_comisiones_colectivos_credito'
																where 
																	codigoempleado='$codigoempleado' and 
																	codigomes='$codigomes' and 
																	codigosemana='$codigosemana' and
																	codigoconcepto='$codigoconcepto'";
																//echo $sql;
																//exit;
															mysql_query($sql) or die(mysql_error()); 
															
														$var_total_comisiones= $var_total_comisiones + $var_comisiones_colectivos_credito;
													
												}
												
												// Comision por Ventas de Contado a Colectivos
												elseif ($variable=="1QW"){
												        														$valor = $valor * $monto;
														//echo $valor."-";
														//echo $monto."-";
														
														$var_comisiones_colectivos_contado = buscar_colectivo_contado($codigoempleado,$codigomes,$codigosemana);

														$sql = "update 
																	mno_concepto_empleados 
																set 
																	resultado='$var_comisiones_colectivos_contado'
																where 
																	codigoempleado='$codigoempleado' and 
																	codigomes='$codigomes' and 
																	codigosemana='$codigosemana' and
																	codigoconcepto='$codigoconcepto'";
																//echo $sql;
																//exit;
															mysql_query($sql) or die(mysql_error()); 
															
														$var_total_comisiones= $var_total_comisiones + $var_comisiones_ventas_contado;
													
												}
												// Comision de Cobranzas
												elseif ($variable=="1QX"){
												        														$valor = $valor * $monto;
														//echo $valor."-";
														//echo $monto."-";
														
														$var_comisiones_cobranza = buscar_comisiones_cobranza($codigoempleado,$codigomes,$codigosemana);

														$sql = "update 
																	mno_concepto_empleados 
																set 
																	resultado='$var_comisiones_cobranza'
																where 
																	codigoempleado='$codigoempleado' and 
																	codigomes='$codigomes' and 
																	codigosemana='$codigosemana' and
																	codigoconcepto='$codigoconcepto'";
																//echo $sql;
																//exit;
															mysql_query($sql) or die(mysql_error()); 
															
														$var_total_comisiones= $var_total_comisiones + $var_comisiones_cobranza;
													
												}
												// Calculo de Complemento al compensatorio
												elseif ($variable=="1RQ"){
												        														$valor = $valor * $monto;
														//echo $valor."-";
														//echo $monto."-";
														
														
														$var_comisiones_compensatorio = buscar_comisiones($codigoempleado,$codigomes,$codigosemana);
														
														$var_complemento_compensatorio = ((($var_salario_normal + $var_comisiones_compensatorio)/5)*2 - ($var_salario_normal/7)*2);
														

														$sql = "update 
																	mno_concepto_empleados 
																set 
																	resultado='$var_complemento_compensatorio'
																where 
																	codigoempleado='$codigoempleado' and 
																	codigomes='$codigomes' and 
																	codigosemana='$codigosemana' and
																	codigoconcepto='$codigoconcepto'";
																//echo $sql;
																//exit;
															mysql_query($sql) or die(mysql_error()); 
															
														$var_total_complemento_compensatorio= $var_total_complemento_compensatorio + $var_complemento_compensatorio;
													
												}

												
												// Calculo de salario integral
												elseif ($variable=="1RR"){
														//echo "**".$valor."**";
														//echo $monto."//";	
														
														
														$var_total_bono_otros = sumar_bonos_feriado($codigoempleado,$codigomes,$codigosemana);
														
														$var_total_comisiones = buscar_comisiones($codigoempleado,$codigomes,$codigosemana);
														
														$var_salario_integral = 
														$var_total_comisiones+
														$var_total_bono_otros+
														$var_salario_normal+
														$var_bono_extras_nocturno+
														$var_diferencia_sueldo+
														$var_horas_extras_diurnas+
														$var_horas_extras_nocturnas+
														$var_complemento_compensatorio+
														$var_utilidades+
														$var_aguinaldos+
														$var_bono_vacacional;														;
														
							
														
														
														$sql = "update 
																	mno_concepto_empleados 
																set 
																	resultado='$var_salario_integral'
																where 
																	codigoempleado='$codigoempleado' and 
																	codigomes='$codigomes' and 
																	codigosemana='$codigosemana' and
																	codigoconcepto='$codigoconcepto'";
																//echo $sql;
																//exit;
															mysql_query($sql) or die(mysql_error()); 
																				
														//echo "-".$var_salario_integral;
														$var_total_salario_integral = $var_total_salario_integral + $var_salario_integral;
														$var_total_bono_no_fijos = $var_total_bono_no_fijos + $var_total_bono_otros;
														$var_total_comisiones_total = $var_total_comisiones_total + $var_total_comisiones;
												}
												elseif($variable == "1RS"){
														//echo "**".$valor."**";
														//echo $monto."//";	
														
													    $var_salario_integral_diario = $var_salario_integral * $monto * $valor;
													    //echo "-".$var_salario_integral_diario."-";
												}
												
												elseif ($variable=="1TA"){
												        $valor = $valor * $monto;
														//echo $valor."-";
														//echo $monto."-";
														//$var_multiplo = calcular_lunes($codigomes);
														//$valor = $valor * $var_multiplo;
														
										
														
														$var_bono_post_vacacional = ($var_salario_normal * $monto ) / 360;
														
														
														$sql = "update 
																	mno_concepto_empleados 
																set 
																	resultado='$var_bono_post_vacacional'
																where 
																	codigoempleado='$codigoempleado' and 
																	codigomes='$codigomes' and 
																	codigosemana='$codigosemana' and
																	codigoconcepto='$codigoconcepto'";
																//echo $sql;
																//exit;
															mysql_query($sql) or die(mysql_error()); 
														
												}
												elseif ($variable=="1UA"){
												        //echo "**".$valor."**";
														//echo $monto."//";		
														$var_multiplo = calcular_lunes($codigomes);
														

														$var_prestaciones_sociales = ($var_salario_integral/$var_multiplo)*$monto;
														$sql = "update 
																	mno_concepto_empleados 
																set 
																	resultado='$var_prestaciones_sociales'
																where 
																	codigoempleado='$codigoempleado' and 
																	codigomes='$codigomes' and 
																	codigosemana='$codigosemana' and
																	codigoconcepto='$codigoconcepto'";
																//echo $sql;
																//exit;
															mysql_query($sql) or die(mysql_error()); 
															
														//echo "-".$var_dias_prestaciones;
														
														
												}
												elseif ($variable=="1UB"){
												        //echo "**".$valor."**";
														//echo $monto."//";		
														

														$var_interes_prestaciones = $var_prestaciones_sociales*$monto;
														$sql = "update 
																	mno_concepto_empleados 
																set 
																	resultado='$var_interes_prestaciones'
																where 
																	codigoempleado='$codigoempleado' and 
																	codigomes='$codigomes' and 
																	codigosemana='$codigosemana' and
																	codigoconcepto='$codigoconcepto'";
																//echo $sql;
																//exit;
															mysql_query($sql) or die(mysql_error()); 
														
														
														//echo "-".$var_interes_prestaciones;
											
														
												} // Calculo de Seguro Social
												elseif ($variable=="1VA"){
												        //echo "**".$valor."**";
													    //echo $monto."//";		
														
														$variable = 'c$1AFsmi';
														$var_salario_sso = buscar_constante($variable);
														//echo "#####".$var_salario_sso."#####";
														//exit;
														$var_salario_sso = $var_salario_sso * 5;
														$var_salario_sso = $var_salario_sso * (12/52);
														//echo "#####".$var_salario_sso."#####";
														
														if ($var_salario_normal>$var_salario_sso){
															$var_seguro_social = $var_salario_sso*$monto;	
														}
														else{
															$var_seguro_social = $var_salario_normal*$monto;	
														}
														
														
														
														
														
															$sql = "update 
																	mno_concepto_empleados 
																set 
																	resultado='$var_seguro_social'
																where 
																	codigoempleado='$codigoempleado' and 
																	codigomes='$codigomes' and 
																	codigosemana='$codigosemana' and
																	codigoconcepto='$codigoconcepto'";
																//echo $sql;
																//exit;
															mysql_query($sql) or die(mysql_error()); 
														
														
														//7echo "-".$var_seguro_social;
														
														
												} // Calculo de PIE
												elseif ($variable=="1VB"){
												        //echo "**".$valor."**";
														//echo $monto."//";		
														
														$variable = 'c$1AFsmi';
														$var_salario_pie = buscar_constante($variable);
														//echo "#####".$var_salario_sso."#####";
														//exit;
														$var_salario_pie = $var_salario_pie * 10;
														$var_salario_pie = $var_salario_pie * (12/52);
														//echo "#####".$var_salario_sso."#####";
														
														if ($var_salario_normal>$var_salario_pie){
															$var_pie = $var_salario_pie*$monto;	
														}
														else{
															$var_pie = $var_salario_normal*$monto;
														}
														
														
														
														$sql = "update 
																	mno_concepto_empleados 
																set 
																	resultado='$var_pie'
																where 
																	codigoempleado='$codigoempleado' and 
																	codigomes='$codigomes' and 
																	codigosemana='$codigosemana' and
																	codigoconcepto='$codigoconcepto'";
																//echo $sql;
																//exit;
															mysql_query($sql) or die(mysql_error()); 
														
														//echo "-".$var_pie;
														
												}
												// calculo de Banavih
												elseif ($variable=="1VC"){
												        //echo "**".$valor."**";
														//echo $monto."//";		
														
												     	$var_banavih = $var_salario_integral*$monto;
												     	
												     	$sql = "update 
																	mno_concepto_empleados 
																set 
																	resultado='$var_banavih'
																where 
																	codigoempleado='$codigoempleado' and 
																	codigomes='$codigomes' and 
																	codigosemana='$codigosemana' and
																	codigoconcepto='$codigoconcepto'";
																//echo $sql;
																//exit;
															mysql_query($sql) or die(mysql_error()); 
													    //echo "-".$var_banavih;
													    
														
												}
												// calculo de inces
												elseif ($variable=="1VD"){
												        //echo "**".$valor."**";
														//echo $monto."//";		
														
												       $var_inces = (($var_salario_normal + $var_bono_vacacional+$var_monto_feriado)*$monto );
													   $sql = "update 
																	mno_concepto_empleados 
																set 
																	resultado='$var_inces'
																where 
																	codigoempleado='$codigoempleado' and 
																	codigomes='$codigomes' and 
																	codigosemana='$codigosemana' and
																	codigoconcepto='$codigoconcepto'";
																//echo $sql;
																//exit;
															mysql_query($sql) or die(mysql_error()); 
													   
													   
													    //echo "-".$var_inces;
													    
													    
													    
														
												}
												// Cuota Sindical
												elseif ($variable=="1VE"){
												        //echo "**".$valor."**";
														//echo $monto."//";		
														
												     	$var_sindical = $monto * $valor;
												     	
												     	
												     	
													   $sql = "update 
																	mno_concepto_empleados 
																set 
																	resultado='$var_sindical'
																where 
																	codigoempleado='$codigoempleado' and 
																	codigomes='$codigomes' and 
																	codigosemana='$codigosemana' and
																	codigoconcepto='$codigoconcepto'";
																//echo $sql;
																//exit;
															mysql_query($sql) or die(mysql_error()); 
													    //echo "-".$var_sindical;
													    
													    
													   
														
												} 
												
												// Caja de Ahorro Salario Base
												elseif ($variable=="1WA"){
												        //echo "**".$valor."**";
														//echo $monto."//";		
														
												     	$var_caja_ahorro = $var_sueldobase*$monto * $valor;
												     	
												     	$sql = "update 
																	mno_concepto_empleados 
																set 
																	resultado='$var_caja_ahorro'
																where 
																	codigoempleado='$codigoempleado' and 
																	codigomes='$codigomes' and 
																	codigosemana='$codigosemana' and
																	codigoconcepto='$codigoconcepto'";
																//echo $sql;
																//exit;
															mysql_query($sql) or die(mysql_error()); 
												
													    //echo "-".$var_caja_ahorro;
														
												} 
												// Caja de Ahorro Salario Normal
												elseif ($variable=="1WB"){
												        //echo "**".$valor."**";
														//echo $monto."//";		
														
												     	$var_caja_ahorro = $var_salario_normal*$monto * $valor;
												     	
												     													     	$sql = "update 
																	mno_concepto_empleados 
																set 
																	resultado='$var_caja_ahorro'
																where 
																	codigoempleado='$codigoempleado' and 
																	codigomes='$codigomes' and 
																	codigosemana='$codigosemana' and
																	codigoconcepto='$codigoconcepto'";
																//echo $sql;
																//exit;
															mysql_query($sql) or die(mysql_error()); 
													    //echo "-".$var_caja_ahorro;
														
												} 
												// Caja de Ahorro Salario Integral
												elseif ($variable=="1WC"){
												        //echo "**".$valor."**";
														//echo $monto."//";		
														
												     	$var_caja_ahorro = $var_salario_integral*$monto * $valor;
												     	
												     			$sql = "update 
																	mno_concepto_empleados 
																set 
																	resultado='$var_caja_ahorro'
																where 
																	codigoempleado='$codigoempleado' and 
																	codigomes='$codigomes' and 
																	codigosemana='$codigosemana' and
																	codigoconcepto='$codigoconcepto'";
																//echo $sql;
																//exit;
															mysql_query($sql) or die(mysql_error()); 
													    //echo "-".$var_caja_ahorro;
												} 
												// Otros Beneficios Laborales
												elseif ($variable=="1XA"){
												        //echo "**".$valor."**";
														//echo $monto."//";		
														
														$var_otros_beneficios_laborales  = $monto * $valor;
														
														$sql = "update 
																	mno_concepto_empleados 
																set 
																	resultado='$var_otros_beneficios_laborales'
																where 
																	codigoempleado='$codigoempleado' and 
																	codigomes='$codigomes' and 
																	codigosemana='$codigosemana' and
																	codigoconcepto='$codigoconcepto'";
																//echo $sql;
																//exit;
															mysql_query($sql) or die(mysql_error()); 
														//echo "-".$var_otros_beneficios_laborales;
															
														$var_total_obl = $var_total_obl + $var_otros_beneficios_laborales;

														
														//echo "-".$var_total_obl;
												}
												elseif ($variable=="1XB"){
												        //echo "**".$valor."**";
														//echo $monto."//";		

														$var_otros_beneficios_laborales = $var_salario_normal * $monto;
														
														$sql = "update 
																	mno_concepto_empleados 
																set 
																	resultado='$var_otros_beneficios_laborales'
																where 
																	codigoempleado='$codigoempleado' and 
																	codigomes='$codigomes' and 
																	codigosemana='$codigosemana' and
																	codigoconcepto='$codigoconcepto'";
																//echo $sql;
																//exit;
															mysql_query($sql) or die(mysql_error()); 
														//echo "-".$var_otros_beneficios_laborales;
															
														$var_total_obl = $var_total_obl + $var_otros_beneficios_laborales;

														
														//echo "-".$var_total_obl;
												}
												elseif ($variable=="1XC"){
												        //echo "**".$valor."**";
														//echo $monto."//";		

														$var_otros_beneficios_laborales = $var_sueldobase * $monto;
														
														$sql = "update 
																	mno_concepto_empleados 
																set 
																	resultado='$var_otros_beneficios_laborales'
																where 
																	codigoempleado='$codigoempleado' and 
																	codigomes='$codigomes' and 
																	codigosemana='$codigosemana' and
																	codigoconcepto='$codigoconcepto'";
																//echo $sql;
																//exit;
															mysql_query($sql) or die(mysql_error()); 
														//echo "-".$var_otros_beneficios_laborales;
															
														$var_total_obl = $var_total_obl + $var_otros_beneficios_laborales;

														
														//echo "-".$var_total_obl;
												}
												elseif ($variable=="1XD"){
												        //echo "**".$valor."**";
														//echo $monto."//";		

														$var_otros_beneficios_laborales = $var_salario_integral * $monto;
														
														$sql = "update 
																	mno_concepto_empleados 
																set 
																	resultado='$var_otros_beneficios_laborales'
																where 
																	codigoempleado='$codigoempleado' and 
																	codigomes='$codigomes' and 
																	codigosemana='$codigosemana' and
																	codigoconcepto='$codigoconcepto'";
																//echo $sql;
																//exit;
															mysql_query($sql) or die(mysql_error()); 
														//echo "-".$var_otros_beneficios_laborales;
															
														$var_total_obl = $var_total_obl + $var_otros_beneficios_laborales;

														
														//echo "-".$var_total_obl;
												}
												// Beneficios que dependen del numero de hijos
												elseif ($variable=="1XE"){
												        //echo "**".$valor."**";
														//echo $monto."//";		

														$var_cantidad_hijos = buscar_hijos($codigoempleado);
														$var_otros_beneficios_laborales =  ($var_cantidad_hijos * $monto)*$valor;
														
														$sql = "update 
																	mno_concepto_empleados 
																set 
																	resultado='$var_otros_beneficios_laborales'
																where 
																	codigoempleado='$codigoempleado' and 
																	codigomes='$codigomes' and 
																	codigosemana='$codigosemana' and
																	codigoconcepto='$codigoconcepto'";
																//echo $sql;
																//exit;
															mysql_query($sql) or die(mysql_error()); 
														//echo "-".$var_otros_beneficios_laborales;
															
														$var_total_obl = $var_total_obl + $var_otros_beneficios_laborales;

														
														//echo "-".$var_total_obl;
												}
												// Guarderia
												elseif ($variable=="1XF"){
												        //echo "**".$valor."**";
														//echo $monto."//";		

														$var_cantidad_hijos = buscar_hijos_guarderia($codigoempleado);
														$var_otros_beneficios_laborales =  ($var_cantidad_hijos * $monto)*$valor;
														
														$sql = "update 
																	mno_concepto_empleados 
																set 
																	resultado='$var_otros_beneficios_laborales'
																where 
																	codigoempleado='$codigoempleado' and 
																	codigomes='$codigomes' and 
																	codigosemana='$codigosemana' and
																	codigoconcepto='$codigoconcepto'";
																//echo $sql;
																//exit;
															mysql_query($sql) or die(mysql_error()); 
														//echo "-".$var_otros_beneficios_laborales;
															
														$var_total_obl = $var_total_obl + $var_otros_beneficios_laborales;

														
														//echo "-".$var_total_obl;
												}
												
												
												
												
											}
					 
									}
                    }
            }


$var_total_bono_no_fijos = $var_total_bono_no_fijos - $var_total_monto_feriado;
echo "</br>";            
echo "var_sueldobase"."-".$var_sueldobase ."</br>";
echo "var_total_bono"."-".$var_total_bono ."</br>";
echo "var_total_asignacion"."-".$var_total_asignacion."</br>";
echo "var_total_salario_normal"."-".$var_total_salario_normal."</br>";
echo "var_total_diferencia_salario"."-".$var_total_diferencia_salario ."</br>";
echo "var_total_horas_extras_diurnas"."-".$var_total_horas_extras_diurnas  ."</br>";
echo "var_total_horas_extras_nocturnas"."-".$var_total_horas_extras_nocturnas ."</br>";
echo "var_total_bono_extras_nocturno"."-".$var_total_bono_extras_nocturno ."</br>";
echo "var_total_cesta_ticket"."-".$var_total_cesta_ticket ."</br>";
echo "var_total_cestaticket_adicional"."-".$var_total_cesta_ticket_adicional ."</br>";
echo "var_total_monto_feriado"."-".$var_total_monto_feriado ."</br>"; 
echo "var_total_bono_no_fijos"."-".$var_total_bono_no_fijos ."</br>"; 
echo "var_total_primas"."-".$var_total_primas ."</br>";
echo "var_total_comisiones_total"."-".$var_total_comisiones_total ."</br>";
echo "var_total_complemento_compensatorio"."-".$var_total_complemento_compensatorio ."</br>";
echo "var_bono_vacacional"."-".$var_bono_vacacional ."</br>";
echo "var_total_salario_integral"."-".$var_total_salario_integral ."</br>";


/*echo "var_utilidades"."-".$var_utilidades ."</br>";
echo "var_aguinaldos"."-".$var_aguinaldos ."</br>";
echo "var_comisiones"."-".$var_comisiones ."</br>";
echo "var_bono_post_vacacional"."-".$var_bono_post_vacacional ."</br>";
echo "var_dias_prestaciones"."-".$var_dias_prestaciones ."</br>";
echo "var_interes_prestaciones"."-".$var_interes_prestaciones ."</br>";
echo "var_seguro_social"."-".$var_seguro_social ."</br>";
echo "var_pie"."-".$var_pie ."</br>";
echo "var_banavih"."-".$var_banavih ."</br>";
echo "var_inces"."-".$var_inces ."</br>";
echo "var_sindical"."-".$var_sindical ."</br>";
echo "var_deporte"."-".$var_deporte ."</br>";
echo "var_caja_ahorro"."-".$var_caja_ahorro ."</br>";
echo "var_total_obl"."-".$var_total_obl."</br>";*/



                
 /*           
// Mostrar el calculo en pantalla            
echo "<table border=1 class='tablas-nuevas'>";
echo "<tr>";
echo "<th align = 'center'>Empleado</th>";
echo "<th align = 'center'>Mes</th>";
echo "<th align = 'center'>Semana</th>";
echo "<th align = 'center'>Valor</th>";
echo "<th align = 'center'>Formula</th>";
echo "</tr>";
      
        
        //$codigoconcepto = $_POST['concepto']; 
        //$valor = $_POST['valor']; 
        $sql = "select * from mrh_semana where codigomes=$codigomes";
        $consulta = mysql_query($sql);
            while($test = mysql_fetch_array($consulta)){
                $codigosemana = $test['codigosemana'];
                    $sql = "select * from mno_concepto_empleados  where codigoempleado=$codigoempleado and codigomes=$codigomes and codigosemana=$codigosemana";    
                    $result = mysql_query($sql);
                    while($registro = mysql_fetch_array($result)){
                    $valor =$registro['valor'];
                    $codigoconcepto=$registro['codigoconcepto'];

                          $sql = "select * from mco_formulaconcepto where codigoconcepto = $codigoconcepto";
                          $resultado = mysql_query($sql);
                          while($campos = mysql_fetch_array($resultado)){
                              echo "<tr align='center'>";
                              echo"<td><font color='black'>". $codigoempleado."</font></td>";
                              echo"<td><font color='black'>". $codigomes."</font></td>";
                              echo"<td><font color='black'>". $codigosemana."</font></td>";
                              echo"<td><font color='black'>". $registro['valor']. "</font></td>";	
                              echo"<td><font color='black'>". $campos['formula']. "</font></td>";
                          }
                        
                        
                    }
        }    
echo "</table>";  
 
*/            
            
            echo "<script type='text/javascript'>";
            echo "    alert('Datos Procesado');";
            echo "</script>";    
            
            
        
	mysql_close($conn);
        }
   }        

function buscar_constante($variable){
	include("../../db.php");	
		$sql = "select 
					*
				from 
					mco_view_montoconstante
				where 
					codigoproceso='$variable'";
        //echo $sql;
        $resultin = mysql_query($sql);
        $field = mysql_fetch_array($resultin);
        if (!$resultin){die("Error: 2141..");}
        $resultado= $field['monto'];
	//echo $resultado;
	return $resultado;		
}

function sumar_bonos_feriado($empleado,$mes,$semana){
	include("../../db.php");	
		$strsql = "select 
				sum(resultado) as resultado_total
     		from 
				mno_view_concepto_empleados
			where 
				codigoempleado = '$empleado' and
			    codigomes = '$mes' and
			    codigosemana='$semana' and
			    substring(codigoproceso,1,4) = 'p$1M'";
			//echo $strsql;
			//exit;    
			$loop = mysql_query($strsql);
			while($fieldes = mysql_fetch_array($loop)){
				$valor=$fieldes['resultado_total'];
				$resultado = $valor;
			}
	//echo $resultado;
	return $resultado;		
}


function  buscar_comisiones($empleado,$mes,$semana){
	include("../../db.php");	
		$strsql = "select 
				sum(resultado) as resultado_total
     		from 
				mno_view_concepto_empleados
			where 
				codigoempleado = '$empleado' and
			    codigomes = '$mes' and
			    codigosemana='$semana' and
			    substring(codigoproceso,1,4) = 'p$1Q'";
			//echo $strsql;
			//exit;    
			$loop = mysql_query($strsql);
			while($fieldes = mysql_fetch_array($loop)){
				$valor=$fieldes['resultado_total'];
				$resultado = $valor;
			}
	//echo $resultado;
	return $resultado;	
	
}
function  buscar_comisiones_cobranza($empleado,$mes,$semana){
	include("../../db.php");	
		$strsql = "select 
				sum(monto) as monto_total
     		from 
				cob_comisiones
				where 
				codigo_empleado = '$empleado' and
			    codigo_mes = '$mes' and
			    codigo_semana='$semana'";
			//echo $strsql;
			//exit;    
			$loop = mysql_query($strsql);
			while($fieldes = mysql_fetch_array($loop)){
				$valor=$fieldes['monto_total'];
				$resultado = $valor;
			}
	//echo $resultado;
	return $resultado;	
	
}

function buscar_colectivo_contado($empleado,$mes,$semana){
	include("../../db.php");	
		$strsql = "select 
				sum(monto) as monto_total
     		from 
				ven_comisiones
				where 
				codigo_empleado = '$empleado' and
			    codigo_mes = '$mes' and
			    codigo_semana='$semana' and
			    codigo_tipo_comision='6'";
			//echo $strsql;
			//exit;    
			$loop = mysql_query($strsql);
			while($fieldes = mysql_fetch_array($loop)){
				$valor=$fieldes['monto_total'];
				$resultado = $valor;
			}
	//echo $resultado;
	return $resultado;	
	
}

function buscar_colectivo_credito($empleado,$mes,$semana){
	include("../../db.php");	
		$strsql = "select 
				sum(monto) as monto_total
     		from 
				ven_comisiones
				where 
				codigo_empleado = '$empleado' and
			    codigo_mes = '$mes' and
			    codigo_semana='$semana' and
			    codigo_tipo_comision='5'";
			//echo $strsql;
			//exit;    
			$loop = mysql_query($strsql);
			while($fieldes = mysql_fetch_array($loop)){
				$valor=$fieldes['monto_total'];
				$resultado = $valor;
			}
	//echo $resultado;
	return $resultado;	
	
}

function buscar_colectivo_totales($empleado,$mes,$semana){
	include("../../db.php");	
		$strsql = "select 
				sum(monto) as monto_total
     		from 
				ven_comisiones
				where 
				codigo_empleado = '$empleado' and
			    codigo_mes = '$mes' and
			    codigo_semana='$semana' and
			    codigo_tipo_comision='4'";
			//echo $strsql;
			//exit;    
			$loop = mysql_query($strsql);
			while($fieldes = mysql_fetch_array($loop)){
				$valor=$fieldes['monto_total'];
				$resultado = $valor;
			}
	//echo $resultado;
	return $resultado;	
	
}


function buscar_ventas_contado($empleado,$mes,$semana){
	include("../../db.php");	
		$strsql = "select 
				sum(monto) as monto_total
     		from 
				ven_comisiones
				where 
				codigo_empleado = '$empleado' and
			    codigo_mes = '$mes' and
			    codigo_semana='$semana' and
			    codigo_tipo_comision='3'";
			//echo $strsql;
			//exit;    
			$loop = mysql_query($strsql);
			while($fieldes = mysql_fetch_array($loop)){
				$valor=$fieldes['monto_total'];
				$resultado = $valor;
			}
	//echo $resultado;
	return $resultado;	
	
}

function buscar_ventas_credito($empleado,$mes,$semana){
	include("../../db.php");	
		$strsql = "select 
				sum(monto) as monto_total
     		from 
				ven_comisiones
				where 
				codigo_empleado = '$empleado' and
			    codigo_mes = '$mes' and
			    codigo_semana='$semana' and
			    codigo_tipo_comision='2'";
			//echo $strsql;
			//exit;    
			$loop = mysql_query($strsql);
			while($fieldes = mysql_fetch_array($loop)){
				$valor=$fieldes['monto_total'];
				$resultado = $valor;
			}
	//echo $resultado;
	return $resultado;	
	
}

function buscar_ventastotales($empleado,$mes,$semana){
	include("../../db.php");	
		$strsql = "select 
				sum(monto) as monto_total
     		from 
				ven_comisiones
				where 
				codigo_empleado = '$empleado' and
			    codigo_mes = '$mes' and
			    codigo_semana='$semana' and
			    codigo_tipo_comision='1'";
			//echo $strsql;
			//exit;    
			$loop = mysql_query($strsql);
			while($fieldes = mysql_fetch_array($loop)){
				$valor=$fieldes['monto_total'];
				$resultado = $valor;
			}
	//echo $resultado;
	return $resultado;	
	
}

function buscar_hijos_guarderia($empleado){
	//echo $variable;
	//echo "-".$empleado."-";
	$resultado  = 0;
	include("../../db.php");
	
	//echo $empleado;
        $sql = "select cedula from mrh_empleado where codigo=$empleado";
        $resultin = mysql_query($sql);
        $field = mysql_fetch_array($resultin);
        if (!$resultin){die("Error: 2363..");}
        $cedula= $field['cedula'];
	
	//echo "-".$cedula."-"
	;
	$strsql = "select 
				count(cedulaempleado) as cantidad 
     		from 
				mrh_carga
				where 
			    cedulaempleado = '$cedula'";
			$loop = mysql_query($strsql);
			while($fieldes = mysql_fetch_array($loop)){
				$valor=$fieldes['cantidad'];
				$resultado = $valor;
			}
	//echo $resultado;
	return $resultado;	
}

function buscar_hijos($empleado){
	//echo $variable;
	//echo "-".$empleado."-";
	$resultado  = 0;
	include("../../db.php");
	
	//echo $empleado;
        $sql = "select cedula from mrh_empleado where codigo=$empleado";
        $resultin = mysql_query($sql);
        $field = mysql_fetch_array($resultin);
        if (!$resultin){die("Error: 2393..");}
        $cedula= $field['cedula'];
	
	//echo "-".$cedula."-"
	;
	$strsql = "select 
				count(cedulaempleado) as cantidad 
     		from 
				mrh_carga
				where 
			    cedulaempleado = '$cedula'";
			$loop = mysql_query($strsql);
			while($fieldes = mysql_fetch_array($loop)){
				$valor=$fieldes['cantidad'];
				$resultado = $valor;
			}
	//echo $resultado;
	return $resultado;	
}


function buscar_unidades_producidas($empleado,$mes,$semana){
	//echo $variable;
	echo "-".$empleado."-".$mes."-".$semana."-";
	$resultado  = 0;
	include("../../db.php");
	$strsql = "select 
				* 
     		from 
				prc_produccion
				where 
			    codigomes='$mes' and 
				codigosemana='$semana'";
			$loop = mysql_query($strsql);
			while($fieldes = mysql_fetch_array($loop)){
				$valor=$fieldes['unidadesproducidas'];
				$resultado = $valor;
			}
	//echo $resultado;
	return $resultado;
	
}	
function buscar_valor_concepto($variable,$empleado,$mes,$semana,$concepto){
	//echo $variable;
	//echo "-".$mes."-".$semana."-".$concepto."-";
	$resultado  = 0;
	include("../../db.php");
	$strsql = "select 
				* 
     		from 
				mno_view_concepto_empleados 
				where 
				substring(codigoproceso,1,5) = '$variable' and 
				codigoempleado='$empleado' and 
			    codigomes='$mes' and 
				codigosemana='$semana'";
			$loop = mysql_query($strsql);
			while($fieldes = mysql_fetch_array($loop)){
				$valor=$fieldes['valor'];
				$resultado = $valor;
				
				
	}
	//echo $resultado;
	return $resultado;
	
}

function buscar_resultado($variable,$empleado,$mes,$semana,$concepto){
	//echo $variable;
	//echo "-".$mes."-".$semana."-".$concepto."-";
	$resultado  = 0;
	include("../../db.php");
	$strsql = "select 
				* 
     		from 
				mno_view_concepto_empleados 
				where 
				substring(codigoproceso,1,5) = '$variable' and 
				codigoempleado='$empleado' and 
			    codigomes='$mes' and 
				codigosemana='$semana'";
			$loop = mysql_query($strsql);
			while($fieldes = mysql_fetch_array($loop)){
				$valor=$fieldes['resultado'];
				$resultado = $resultado + $valor;
				
				
	}
	//echo $resultado;
	return $resultado;
	
}


function calcular_lunes($mes){
		include("../../db.php");
		$sql = "select count(codigomes) as nro_lunes from mrh_semana where codigomes=$mes";
        $resultin = mysql_query($sql);
        $field = mysql_fetch_array($resultin);
        if (!$resultin){die("Error: 2493..");}
        $nro_lunes= $field['nro_lunes'];
        return $nro_lunes;
}

function calcular_anos_servicio($empleado){
		include("../../db.php");
        //echo $empleado;
        $sql = "select fechaingreso from mrh_empleado where codigo=$empleado";
        $resultin = mysql_query($sql);
        $field = mysql_fetch_array($resultin);
        if (!$resultin){die("Error: 2504..");}
        $fecha= $field['fechaingreso'];
        //echo $fecha;
        $var_antiguedad = antiguedad($fecha);
        
        $sql = "select * from mrh_tabulador_ano where anos=$var_antiguedad";
        $resultin = mysql_query($sql);
        $field = mysql_fetch_array($resultin);
        if (!$resultin){die("Error: 2512..");}
       
        $diasbono= $field['valor_anoservicio'];
        
        $resultado = $diasbono;
        
        return $resultado;
	
}

function calcular_antiguedad_nomina($empleado){
		include("../../db.php");
        //echo $empleado;
        $sql = "select fechaingreso from mrh_empleado where codigo=$empleado";
        $resultin = mysql_query($sql);
        $field = mysql_fetch_array($resultin);
        if (!$resultin){die("Error: 2528..");}
        $fecha= $field['fechaingreso'];
        //echo $fecha;
        $var_antiguedad = antiguedad($fecha);
        
        $sql = "select * from mno_antiguedad where anos=$var_antiguedad";
        $resultin = mysql_query($sql);
        $field = mysql_fetch_array($resultin);
        if (!$resultin){die("Error: 2536..");}
       
        $diasbono= $field['diasbono'];
        echo "&&&&&&".$diasbono."&&&&&&";
        
        $resultado = $diasbono;
        
        return $resultado;
	
}

function calcular_antiguedad($empleado){
		include("../../db.php");
        //echo $empleado;
        $sql = "select fechaingreso from mrh_empleado where codigo=$empleado";
        $resultin = mysql_query($sql);
        $field = mysql_fetch_array($resultin);
        if (!$resultin){die("Error: 2553..");}
        $fecha= $field['fechaingreso'];
        //echo $fecha;
        $var_antiguedad = antiguedad($fecha);
        
        $sql = "select * from mrh_tabulador_ano where anos=$var_antiguedad";
        $resultin = mysql_query($sql);
        $field = mysql_fetch_array($resultin);
        if (!$resultin){die("Error: 2561..");}
       
        $diasbono= $field['valor_antiguedad'];
        echo "&&&&&&".$diasbono."&&&&&&";
        
        $resultado = $diasbono;
        
        return $resultado;
	
}

function calcular_bonovacacional($empleado,$salario){
	    include("../../db.php");
        
        //echo $empleado;
        $sql = "select fechaingreso from mrh_empleado where codigo=$empleado";
        $resultin = mysql_query($sql);
        $field = mysql_fetch_array($resultin);
        if (!$resultin){die("Error: 2579..");}
        $fecha= $field['fechaingreso'];
        //echo $fecha;
        $var_antiguedad = antiguedad($fecha);
        
        $sql = "select * from mno_antiguedad where anos=$var_antiguedad";
        $resultin = mysql_query($sql);
        $field = mysql_fetch_array($resultin);
        if (!$resultin){die("Error: 2587..");}
       
        $diasbono= $field['diasbono'];
        
        $resultado = $salario*$diasbono;
        
        return $resultado;
        
    
}
        
function antiguedad ($fecha_ingreso) {
    list($y, $m, $d) = explode("-", $fecha_ingreso);
    $y_dif = date("Y") - $y;
    $m_dif = date("m") - $m;
    $d_dif = date("d") - $d;
    if ((($d_dif < 0) && ($m_dif == 0)) || ($m_dif < 0))
        $y_dif--;
    return $y_dif;
}


function calcular_cesta($variable){
			  include("../../db.php");
			  $var_var='c$UTC';
			  
			  $sql = "select monto from mco_view_montoconstante where codigoproceso='$var_var'";
			  $result = mysql_query($sql);
              $test = mysql_fetch_array($result);
              if (!$result){die("Error: 2616..");}
              $unidad_cesta = $test['monto'];  

			  $var_var='c$UTR';
			  
		      $sql = "select monto from mco_view_montoconstante where codigoproceso='$var_var'";
			  $result = mysql_query($sql);
              $test = mysql_fetch_array($result);
              if (!$result){die("Error: 2624..");}
              $unidad_tribu = $test['monto'];  	
	
			  $resultado = $unidad_cesta * $unidad_tribu * $variable;
			  return $resultado;
}
function calcular_nocturno($empleado,$mes,$semana){
			  include("../../db.php");
			  $sql = "select cedula from mrh_empleado where codigo='$empleado'";
			  $result = mysql_query($sql);
              $test = mysql_fetch_array($result);
              if (!$result){die("Error: 2635..");}
              $ced_empleado = $test['cedula'];  
			  //echo $ced_empleado;
			  
              $sql = "select * from mrh_view_turnos_empleados where cedulaempleado='$ced_empleado' and codigomes='$mes' and codigosemana='$semana'";
              //echo $sql;
              //exit;
              $result = mysql_query($sql);
              $test = mysql_fetch_array($result);
              if (!$result){die("Error: 2644..");}
              $resultado = $test['horaextranocturno'];   
              //echo $resultado;
              
              return $resultado;   	
}

function calcular_diurno($empleado,$mes,$semana){
			  include("../../db.php");
			  $sql = "select cedula from mrh_empleado where codigo='$empleado'";
			  $result = mysql_query($sql);
              $test = mysql_fetch_array($result);
              if (!$result){die("Error: 2656..");}
              $ced_empleado = $test['cedula'];  
			  //echo $ced_empleado;
			  
              $sql = "select * from mrh_view_turnos_empleados where cedulaempleado='$ced_empleado' and codigomes='$mes' and codigosemana='$semana'";
              //echo $sql;
              //exit;
              $result = mysql_query($sql);
              $test = mysql_fetch_array($result);
              if (!$result){die("Error: 2665..");}
              $resultado = $test['horaextradiurno'];   
              //echo $resultado;
              
              return $resultado;   	
}

function calcular_horas_semanales($empleado,$mes,$semana){
			  //echo "--------".$empleado."--".$mes."--".$semana."-------";
			  include("../../db.php");
			  $sql = "select cedula from mrh_empleado where codigo='$empleado'";
			  $result = mysql_query($sql);
              $test = mysql_fetch_array($result);
              if (!$result){die("Error: 2678..");}
              $ced_empleado = $test['cedula'];  
			  //echo $ced_empleado;
			  
              $sql = "select * from mrh_view_analisisxempleado where cedulaempleado='$ced_empleado' and codigomes='$mes' and codigosemana='$semana'";
              echo $sql;
              //exit;
              $result = mysql_query($sql);
              $test = mysql_fetch_array($result);
              if (!$result){die("Error: 2687..");}
              $resultado = $test['hrsnocsemanal'];   
              //echo $resultado;
              
              return $resultado;   	
}

function calcular_turno($empleado,$mes,$semana){
			  include("../../db.php");
			  $sql = "select cedula from mrh_empleado where codigo='$empleado'";
			  $result = mysql_query($sql);
              $test = mysql_fetch_array($result);
              if (!$result){die("Error: 2699..");}
              $ced_empleado = $test['cedula'];  
			  //echo $ced_empleado;
			  
              $sql = "select * from mrh_view_turnos_empleados where cedulaempleado='$ced_empleado' and codigomes='$mes' and codigosemana='$semana'";
              //echo $sql;
              //exit;
              $result = mysql_query($sql);
              $test = mysql_fetch_array($result);
              if (!$result){die("Error: 2708..");}
              $resultado = $test['descripciontipoturno'];   
              //echo $resultado;
              
              return $resultado;   	
}

function formula_completa($variable){

	$bd_concepto = 0;

    while($bd_concepto==0){
		$bd_concepto = 1;
		$resultado = "";
		$concepto = "";
		
		$arreglo = explode(" ",$variable);	
		for ($i = 0; $i <= count($arreglo)-1; $i++){
			//echo $arreglo[$i];
			$cadena = $arreglo[$i];
			if (substr($arreglo[$i],0,1)=="p"){
				$concepto = buscar_concepto($arreglo[$i]);
				$cadena = $concepto;
				$bd_concepto = 0;
			}
			
			$resultado = $resultado . " " . $cadena;
		}
		$variable = $resultado;
	}
	return $resultado;
}


function buscar_concepto($variable){
			  include("../../db.php");
              $sql = "select * from mco_view_formulaconcepto where codigoproceso='$variable'";
              //echo $sql;
              //exit;
              $result = mysql_query($sql);
              $test = mysql_fetch_array($result);
              if (!$result){die("Error: 2749..");}
              $resultado = $test['formula'];   
              return $resultado;   	

}

function calcular_formula($variable){

$cont = 0;
$op = 0;
$j = 0;
$k = 0;
$p[$k] = 0;
$a[$j] = "&";
$acumulador = 0;
$var1="&";
$var2="&";
$bd=0;

    $arreglo = explode(" ",$variable);
    for ($i = 0; $i <= count($arreglo)-1; $i++){
		//echo $arreglo[$i];
		if ($arreglo[$i]=="("){
			//echo $arreglo[$i];
			$cont = 0;
			if ($bd==0){
				
			}
			elseif($bd==1){
				$k = $k + 1;
				$p[$k] = $op;
			}
			
			

		}
		elseif ($arreglo[$i]==")"){
			//echo $arreglo[$i];
			$cont = 1;
			if(($var1<>"&")and($var2<>"&")){
				$acumulador = calcular($var1,$var2,$op);
				$j = $j + 1;
				$a[$j] = $acumulador;
				//echo $a[$j];
			}
			elseif(($var1=="&")and($var2=="&")){
				$acumulador = calcular($a[$j-1],$a[$j],$p[$k]);
				$j = $j - 1;
				$a[$j] = $acumulador;
				//echo $a[$j];
				$k = $k - 1;
			}
			elseif(($var1=="&")and($var2<>"&")){
				$acumulador=calcular($a[$j],$var2,$op);
				$a[$j] = $acumulador;
			}
			elseif(($var1<>"&")and($var2=="&")){
				$acumulador=$var1;
				$j = $j + 1;
				$a[$j] = $acumulador;
				
			
			}


			$op = 0;
			$var1 = "&";
			$var2 = "&";
			


	
		}
		elseif (substr($arreglo[$i],0,1)=="c"){
			//echo $arreglo[$i];
			$cont = $cont + 1;
			if($cont == 1){
				$var1 = $arreglo[$i];
				//echo $var1;
				$var1 = buscar_valor($var1);
				//echo $var1;
				if ($bd==0){
					$bd=1;
				}
				
			}
			elseif ($cont == 3){
				$var2 = $arreglo[$i];
				//echo $var2;
				$var2 = buscar_valor($var2);
				//echo $var2;
			}
			
		}
		elseif (($arreglo[$i]=="+")OR($arreglo[$i]=="-")OR($arreglo[$i]=="*")OR($arreglo[$i]=="/")){    
			//echo $arreglo[$i];
			$cont = $cont + 1;
			if($cont == 2){
				$op = $arreglo[$i];
				//echo $op;
			}
		}
	}
 
    return $a[1]; 
}

function buscar_valor($variable){
			  include("../../db.php");
              $sql = "select * from mco_view_montoconstante where codigoproceso='$variable'";
              //echo $sql;
              //exit;
              $result = mysql_query($sql);
              $test = mysql_fetch_array($result);
              if (!$result){die("Error: 2863..");}
              $resultado = $test['monto'];   
              return $resultado;   	
}

function calcular($variable1,$variable2,$operador){
	     	  if($operador=="+"){
                $resultado = $variable1 + $variable2;
              }
              elseif($operador=="*"){
                $resultado = $variable1 * $variable2;
               }
              elseif($operador=="-"){
               $resultado = $variable1 - $variable2;
              }
              elseif($operador=="/"){
                $resultado = $variable1 / $variable2;
              }
              return $resultado;   	
}



?>
