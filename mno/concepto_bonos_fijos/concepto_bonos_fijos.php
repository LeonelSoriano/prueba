<?php
$cedulaempleado ="";
$nombre="";
$apellido="";

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
	include("../../db.php");
        $bd_guardar=1;
        $codigosemana = $_POST['semana']; 
        //echo $codigosemana;
		//exit;
        
        
        if($bd_guardar==1){
        
        $cedulaempleado = $_POST['cedulaempleado'];
        
        $sql = "select * from mrh_empleado where cedula='$cedulaempleado'";
        $result = mysql_query($sql);
        $test = mysql_fetch_array($result);
        if (!$result){die("Error: Data not found..");}
        $codigoempleado = $test['codigo'];
        $nombre = $test['primernombre']; 
        $apellido=$test['primerapellido'];
        
           
            $codigomes = $_POST['mes']; 
            //$codigosemana = $_POST['codigosemana']; 
            //echo $codigosemana;
            
            $codigoconcepto = $_POST['concepto']; 
            $valor = $_POST['valor']; 
            
            
            if ($codigosemana==0){
            $sql = "select * from mrh_semana where codigomes=$codigomes";
            $consulta = mysql_query($sql);
            $divisor_semanas = calcular_lunes($codigomes);
			$valor = $valor / $divisor_semanas;
            while($test = mysql_fetch_array($consulta)){
                        $codigosemana = $test['codigosemana'];
                        //echo $codigosemana;
                        
                        
 
                        
                        
                        $sql2 = "insert into mno_concepto_empleados(codigoempleado,codigomes,codigosemana,
                                                        codigoconcepto,valor) 
                                 VALUES ('$codigoempleado','$codigomes','$codigosemana','$codigoconcepto','$valor')";
                        //echo $sql;
                        mysql_query($sql2); 
                }
            }
            elseif ($codigosemana<>0){
                        $sql2 = "insert into mno_concepto_empleados(codigoempleado,codigomes,codigosemana,
                                                        codigoconcepto,valor) 
                                 VALUES ('$codigoempleado','$codigomes','$codigosemana','$codigoconcepto','$valor')";
                        //echo $sql;
                        mysql_query($sql2);
                
            }

            
            
            echo "<script type='text/javascript'>";
            echo "    alert('Datos Procesado');";
            echo "</script>";    
            
            
        
	mysql_close($conn);
        }
        
        }			

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
                header ("Location: concepto_empleados_ver.php?cedulaempleado=$cedulaempleado");  
            }
                
	}
	
	

function calcular_lunes($mes){
		include("../../db.php");
		$sql = "select count(codigomes) as nro_lunes from mrh_semana where codigomes=$mes";
        $resultin = mysql_query($sql);
        $field = mysql_fetch_array($resultin);
        if (!$resultin){die("Error: Data not found..");}
        $nro_lunes= $field['nro_lunes'];
        return $nro_lunes;
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
  
 <h1><img src="/sicap/images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong>                Módulo de Nómina | -Conceptos por Empleado</strong></h1>
<form method="post" name="concepto_empleados">
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
           <select name='semana' id='semana'></select>
        </TD>
    </TR>
    <TR>
        <TD><label>Concepto</label></TD>
        <?php // consulta de los meses
        // Consultar la base de datos
                include("../../db.php");
                $consulta_mysql="select * from mno_concepto where asignacion = 'S' order by codigoproceso";
                $resultado_consulta_mysql=mysql_query($consulta_mysql);
                echo "<TD>";
                echo "<select name='concepto' id='concepto' >";
                    echo "<option value='0'>------</option>";
                    while($fila=mysql_fetch_array($resultado_consulta_mysql)){
                        echo "<option value='".$fila['codigo']."'>".$fila['codigoproceso']." | ".$fila['descripcion']."</option>";
                    }
                echo "</select>";
                echo "</TD>";
        ?>  
    </TR>
    <TR>
        <TD width="107"><label>Valor</label></TD>
        <TD width="98"><input type="text" name="valor" id="valor" size="20"></TD>
    </TR>

    
</TABLE>

<TABLE>
<TR>
    <TD>
        <a><input type="Submit" name="ver_turnos" value="Ver Datos"></a> 
    </TD>
    <TD>
        <!--<input type="button" onClick="javascript: insertar()" name="asignar" value="Asignar Turno" >-->
        <a><input type="Submit" name="submit" value="Asignar Concepto"></a> 
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
    win = window.open("concepto_bonos_fijos_buscarempleado.php", "nuevo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=400, height=400");
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
				document.getElementById("semana").innerHTML=xmlhttp.responseText;
				
				}
				
			}
		xmlhttp.open("GET","/sicap/semana.php?codigomes="+str,true);
		
		xmlhttp.send();
	}
</script>
