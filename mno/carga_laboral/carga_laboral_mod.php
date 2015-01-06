<?php
    $cedulaempleado ="";
    $nombre="";
    $apellido="";

if (isset($_POST['ver_turnos']))
	{	
            $bd_mostrar = 1;
            $cedulaempleado = $_POST['cedulaempleado'];    
            if($cedulaempleado==""){
                echo "<script type='text/javascript'>";
                echo "    alert('Debe seleccionar la cedula');";
                echo "</script>";  
                $bd_mostrar=0;
            }
            
            if ($bd_mostrar==1){
                header ("Location: /sicap/mno/carga_laboral/carga_laboral_ver.php?cedulaempleado=$cedulaempleado");  
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
    win = window.open("carga_laboral_buscarempleado.php", "nuevo", "directories=no, location=no, menubar=no, scrollbars=no, statusbar=no, tittlebar=no, width=400, height=400");
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
    if (!$result){die("Error: Data not found..");}

    $nombre = $test['primernombre'];
    $apellido = $test['primerapellido'];
}
        

if (isset($_POST['submit']))
	{	   
        $var_acumulador_carga=0;
	include("../../db.php");
        $bd_guardar=1;
        $var_salario_normal = 0;
        $var_total_horas_extras = 0;
        $var_total_devengado = 0;
        $var_calculo_vacaciones = 0;
        $var_calculo_utilidades = 0;
        $var_salario_integral = 0;
        $var_sso = 0;
        
        
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
                
                $sql = "select * from mno_concepto_empleados  where codigoempleado=$codigoempleado and codigomes=$codigomes and codigosemana=$codigosemana";    
                    $result = mysql_query($sql);
                    while($registro = mysql_fetch_array($result)){
                        $codigoconcepto=$registro['codigoconcepto'];
                        $valor =$registro['valor'];
                        //echo $codigoconcepto;
                            $sql = "select * from mco_formulaconcepto where codigoconcepto=$codigoconcepto";    
                                   $resultado = mysql_query($sql);
                                   while($campos = mysql_fetch_array($resultado)){
                                       $formula=$campos['formula'];
                                       
                                       echo $formula;
                                           $arreglo = explode(" ",$formula);    
                                                for ($i = 0; $i <= count($arreglo)-1; $i++){
                                                    if (substr($arreglo[$i],0,3)=="asi"){//Calculo de Bonos de Asignacion Fija
                                                        $var_acumulador_carga = $var_acumulador_carga + $valor;
                                                        echo $var_acumulador_carga;
                                                        $var_salario_normal =$var_salario_normal + $var_acumulador_carga;
                                                        
                                                        $sql = "insert into mno_carga_laboral(codigoempleado,codigomes,codigosemana,salarionormal)
                                                        values('$codigoempleado','$codigomes','$codigosemana','$var_salario_normal')";
                                                            //echo $sql;
                                                             //exit;
                                                        mysql_query($sql) or die('No se pudo guardar la información. '.mysql_error());			
	
                                                        
                                                        //echo "//".$var_salario_normal."//";
                                                    }
                                                    elseif (substr($arreglo[$i],0,3)=="hed"){//Calculo de Horas Extra Diurnas
                                                        $var_acumulador_carga = $var_acumulador_carga + (((($var_salario_normal/30)/8)*1.5)*$valor);
                                                        echo $var_acumulador_carga;
                                                        
                                                    }
                                                    elseif (substr($arreglo[$i],0,3)=="hen"){//Calculo de Horas Extra Diurnas
                                                        $var_acumulador_carga = $var_acumulador_carga + ((((($var_salario_normal/30)/8)*1.5)*1.3)*$valor);
                                                        echo $var_acumulador_carga;
                                                        
                                                    }                 
                                                    elseif (substr($arreglo[$i],0,3)=="the"){//total de Horas Extras
                                                        $var_total_horas_extras = $var_acumulador_carga;
                                                        echo $var_acumulador_carga;
                                                         $sql = "update mno_carga_laboral set totalhorasextras='$var_total_horas_extras'
                                                            where codigoempleado='$codigoempleado' and codigomes='$codigomes' and codigosemana='$codigosemana'";
                                                        //echo $sql;
                                                        //exit;
                                                        mysql_query($sql) or die(mysql_error());
                                                        
                                                    }        
                                                    elseif (substr($arreglo[$i],0,3)=="com"){//Comisiones
                                                        $var_acumulador_carga = $var_acumulador_carga + $valor;
                                                        echo $var_acumulador_carga;
                                                        $var_total_devengado = $var_acumulador_carga;
                                                        $sql = "update mno_carga_laboral set totaldevengado='$var_total_devengado'
                                                            where codigoempleado='$codigoempleado' and codigomes='$codigomes' and codigosemana='$codigosemana'";
                                                        //echo $sql;
                                                        //exit;
                                                        mysql_query($sql) or die(mysql_error());

                                                    }
                                                    elseif (substr($arreglo[$i],0,3)=="vac"){//Vacaciones
                                                        $var_acumulador_carga = $var_acumulador_carga * $valor;
                                                        $var_calculo_vacaciones = calculo_vacaciones($fechaingreso,$var_salario_normal);
                                                        echo $var_calculo_vacaciones;
                                                        $sql = "update mno_carga_laboral set totalvacacion='$var_calculo_vacaciones'
                                                            where codigoempleado='$codigoempleado' and codigomes='$codigomes' and codigosemana='$codigosemana'";
                                                        //echo $sql;
                                                        //exit;
                                                        mysql_query($sql) or die(mysql_error());
                                                        $var_acumulador_carga = $var_acumulador_carga +$var_calculo_vacaciones;
                                                    }
                                                    elseif (substr($arreglo[$i],0,3)=="uti"){//Utilidades
                                                        $var_acumulador_carga = $var_acumulador_carga * $valor;
                                                        $var_calculo_utilidades = calculo_utilidades($var_total_devengado);
                                                        echo $var_calculo_utilidades;
                                                        $sql = "update mno_carga_laboral set totalutilidad='$var_calculo_utilidades'
                                                            where codigoempleado='$codigoempleado' and codigomes='$codigomes' and codigosemana='$codigosemana'";
                                                        //echo $sql;
                                                        //exit;
                                                        mysql_query($sql) or die(mysql_error());
                                                        $var_acumulador_carga = $var_acumulador_carga +$var_calculo_utilidades;
                                                    }
                                                    elseif (substr($arreglo[$i],0,3)=="sal"){//Salario Integral
                                                        $var_acumulador_carga = $var_acumulador_carga * $valor;
                                                        $var_salario_integral = $var_calculo_utilidades + $var_calculo_vacaciones +$var_total_devengado;
                                                        $sql = "update mno_carga_laboral set salariointegral='$var_salario_integral'
                                                            where codigoempleado='$codigoempleado' and codigomes='$codigomes' and codigosemana='$codigosemana'";
                                                        //echo $sql;
                                                        //exit;
                                                        mysql_query($sql) or die(mysql_error());
                                                        echo $var_salario_integral;
                                                    }
                                                    elseif (substr($arreglo[$i],0,3)=="pri"){//Primas
                                                        $var_acumulador_carga = $var_acumulador_carga + $valor;
                                                        echo $var_acumulador_carga;
                                                    }
                                                    elseif (substr($arreglo[$i],0,3)=="otr"){//Otros Beneficios
                                                        $var_acumulador_carga = $var_acumulador_carga + $valor;
                                                        echo $var_acumulador_carga;
                                                        $sql = "update mno_carga_laboral set totalotrosbeneficios='$var_acumulador_carga'
                                                            where codigoempleado='$codigoempleado' and codigomes='$codigomes' and codigosemana='$codigosemana'";
                                                        //echo $sql;
                                                        //exit;
                                                        mysql_query($sql) or die(mysql_error());
                                                    }
                                                    elseif (substr($arreglo[$i],0,3)=="sso"){//Seguro Social Obligatorio
                                                        $var_acumulador_carga = $var_acumulador_carga * $valor;
                                                        $var_sso = calcular_sso($var_salario_normal,$codigomes);
                                                        echo $var_sso;
                                                        $var_acumulador_carga = $var_acumulador_carga + $var_sso;
                                                        //echo $var_acumulador_carga;
                                                    }
                                                    elseif (substr($arreglo[$i],0,3)=="fao"){//Seguro Social Obligatorio
                                                        $var_acumulador_carga = $var_acumulador_carga * $valor;
                                                        $var_faov = calcular_faov($var_salario_integral);
                                                        echo $var_faov;
                                                        $var_acumulador_carga = $var_acumulador_carga + $var_faov;
                                                        //echo $var_acumulador_carga;
                                                    }
                                                    elseif (substr($arreglo[$i],0,3)=="spf"){//Seguro Social Obligatorio
                                                        $var_acumulador_carga = $var_acumulador_carga * $valor;
                                                        $var_spf = calcular_spf($var_salario_normal,$codigomes);
                                                        echo $var_spf;
                                                         $sql = "update mno_carga_laboral set totalaportes='$var_acumulador_carga'
                                                            where codigoempleado='$codigoempleado' and codigomes='$codigomes' and codigosemana='$codigosemana'";
                                                        //echo $sql;
                                                        //exit;
                                                        mysql_query($sql) or die(mysql_error());
                                                        $var_acumulador_carga = $var_acumulador_carga + $var_spf;
                                                        echo "??".$var_acumulador_carga;
                                                         $sql = "update mno_carga_laboral set costototal='$var_acumulador_carga'
                                                            where codigoempleado='$codigoempleado' and codigomes='$codigomes' and codigosemana='$codigosemana'";
                                                        //echo $sql;
                                                        //exit;
                                                        mysql_query($sql) or die(mysql_error());
                                                    }
                                                    elseif (substr($arreglo[$i],0,3)=="car"){//Carga LAboral
                                                        $var_acumulador_carga = (($var_acumulador_carga - $var_sueldobase) / ($var_sueldobase));
                                                        echo "**".$var_acumulador_carga;
                                                         $sql = "update mno_carga_laboral set cargalaboral='$var_acumulador_carga'
                                                            where codigoempleado='$codigoempleado' and codigomes='$codigomes' and codigosemana='$codigosemana'";
                                                        //echo $sql;
                                                        //exit;
                                                        mysql_query($sql) or die(mysql_error());
                                                        
                                                    }
                                                    
                                                }
                           }
                    }
            }
                
        
// Calculo de Salario Normal

            
// Mostrar el calculo en pantalla            
echo "<table border=1 class='tablas-nuevas'>";
echo "<tr>";
echo "<th align = 'center'>Empleado</th>";
echo "<th align = 'center'>Mes</th>";
echo "<th align = 'center'>Semana</th>";
echo "<th align = 'center'>Salario Base</th>";
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
            
            
            echo "<script type='text/javascript'>";
            echo "    alert('Datos Procesado');";
            echo "</script>";    
            
            
        
	mysql_close($conn);
        }
        
        }			



function calcular_spf($salario,$mes){
	include("../../db.php");
        $var_10veces = 10*$salario;
        if($salario>$var_10veces){
            $resultado = 0;
        }
        else{
        $sql = "select * from mno_constante where codigoproceso='spf'";
        $resultin = mysql_query($sql);
        $field = mysql_fetch_array($resultin);
        if (!$resultin){die("Error: Data not found..");}
            $codigo= $field['codigo'];
        $sql = "select * from mco_montoconstante where codigoconstante=$codigo";
        $resultin = mysql_query($sql);
        $field = mysql_fetch_array($resultin);
        if (!$resultin){die("Error: Data not found..");}
            $monto= $field['monto'];
            //echo "(".$monto.")";
        $sql = "select count(codigomes) as nro_lunes from mrh_semana where codigomes=$mes";
        $resultin = mysql_query($sql);
        $field = mysql_fetch_array($resultin);
        if (!$resultin){die("Error: Data not found..");}
            $nro_lunes= $field['nro_lunes'];
           // echo "(".$nro_lunes.")";
        //$resultado = (($salario*12)/52);
        $resultado = (((($salario*12)/52)*$monto)*$nro_lunes);
        }
        
        return $resultado;
} 

function calcular_faov($salario){
	include("../../db.php");
        $sql = "select * from mno_constante where codigoproceso='fao'";
        $resultin = mysql_query($sql);
        $field = mysql_fetch_array($resultin);
        if (!$resultin){die("Error: Data not found..");}
            $codigo= $field['codigo'];
        $sql = "select * from mco_montoconstante where codigoconstante=$codigo";
        $resultin = mysql_query($sql);
        $field = mysql_fetch_array($resultin);
        if (!$resultin){die("Error: Data not found..");}
            $monto= $field['monto'];
            //echo "(".$monto.")";
           // echo "(".$nro_lunes.")";
        //$resultado = (($salario*12)/52);
        $resultado = ($salario*$monto);
        
        return $resultado;
} 

function calcular_sso($salario,$mes){
	include("../../db.php");
        $sql = "select * from mno_constante where codigoproceso='sso'";
        $resultin = mysql_query($sql);
        $field = mysql_fetch_array($resultin);
        if (!$resultin){die("Error: Data not found..");}
            $codigo= $field['codigo'];
        $sql = "select * from mco_montoconstante where codigoconstante=$codigo";
        $resultin = mysql_query($sql);
        $field = mysql_fetch_array($resultin);
        if (!$resultin){die("Error: Data not found..");}
            $monto= $field['monto'];
            //echo "(".$monto.")";
        $sql = "select count(codigomes) as nro_lunes from mrh_semana where codigomes=$mes";
        $resultin = mysql_query($sql);
        $field = mysql_fetch_array($resultin);
        if (!$resultin){die("Error: Data not found..");}
            $nro_lunes= $field['nro_lunes'];
           // echo "(".$nro_lunes.")";
        //$resultado = (($salario*12)/52);
        $resultado = (((($salario*12)/52)*$monto)*$nro_lunes);
        
        return $resultado;
}    

function calculo_utilidades($devengado){
	include("../../db.php");
        $sql = "select * from mno_constante where codigoproceso='uti'";
        $resultin = mysql_query($sql);
        $field = mysql_fetch_array($resultin);
        if (!$resultin){die("Error: Data not found..");}
        $codigo= $field['codigo'];
        $sql = "select * from mco_montoconstante where codigoconstante=$codigo";
        $resultin = mysql_query($sql);
        $field = mysql_fetch_array($resultin);
        if (!$resultin){die("Error: Data not found..");}
        $monto= $field['monto'];
        $resultado = (($devengado*$monto)/360);
        return $resultado;
        
    
}        
        
function calculo_vacaciones($fecha,$var_salario){
	include("../../db.php");
        
        $var_antiguedad = antiguedad($fecha);
        
        $sql = "select * from mno_antiguedad where anos=$var_antiguedad";
        $resultin = mysql_query($sql);
        $field = mysql_fetch_array($resultin);
        if (!$resultin){die("Error: Data not found..");}
       
        $diasbono= $field['diasbono'];
        
        $resultado = (($var_salario/30)*($diasbono/12));
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
?>