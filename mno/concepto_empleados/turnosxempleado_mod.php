<?php
       
require("db.php");
$id =$_REQUEST['codigo'];
$result = mysql_query("SELECT * FROM mrh_turnoxempleado WHERE codigo  = '$id'");
$test = mysql_fetch_array($result);
if (!$result) 
		{
		die("Error: Data not found..");
		}
        
        $cedulaempleado=$test['cedulaempleado'];
        $codigomes=$test['codigomes'];    
        $codigosemana=$test['codigosemana'];
        $codigoturno=$test['codigoturno'];
        $sql = "SELECT descripcion FROM mrh_turnos WHERE codigo =$codigoturno";
        //echo $sql;
        //exit;
        $consulta = mysql_query($sql);
        while($testeo = mysql_fetch_array($consulta)){
            $descripcionturno = $testeo['descripcion'];
        }

//echo ($cedulaempleado);
//exit;

$result = mysql_query("SELECT * FROM mrh_empleado WHERE cedula  = '$cedulaempleado'");
//echo $result;
//exit;
$test = mysql_fetch_array($result);
if (!$result) 
		{
		die("Error: Data not found..");
		}
        
        $nombre=$test['primernombre'];
        $apellido=$test['primerapellido'];    
       

        
if(isset($_POST['submit']))
{	
        
        $cedulaempleado=$_POST['cedulaempleado'];
        $codigomes=$_POST['codigomes'];    
        $codigosemana=$_POST['codigosemana'];
        $codigoturno=$_POST['codigoturno'];

        $sql = "update mrh_turnoxempleado set cedulaempleado='$cedulaempleado',codigomes='$codigomes',codigosemana='$codigosemana',
            codigoturno ='$codigoturno'
                 where codigo = '$id'";
       //echo $sql;
       //exit;
	mysql_query($sql) or die(mysql_error()); 
        
	echo "<script language='JavaScript' type='text/javascript'>";
        echo "alert('El Registro se ha Modificado');";		
        echo "</script>";
	
	header ("Location: turnosxempleado_ver.php?cedulaempleado=$cedulaempleado");			
}
mysql_close($conn);
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

<script src="jquery171.js" type="text/javascript"></script>
<script src="jquery.validate.js" type="text/javascript"></script>
<script type="text/javascript" src="jquery.alerts.js"></script>
<link href="jquery.alerts.css" rel="stylesheet" type="text/css" />

<!-- / END -->

</head>


<body class="flickr-com">
<!--<p><a href="mrh_menu.html" class="main-site">Principal</a></p>-->
<!--<h1><img src="images/seleccion_sicap_archivos/image002.jpg" alt="flickr" />Módulo de Recursos Humanos | Cargo</h1>-->
<!-- Beginning of compulsory code below -->

<form method="post"  name="turnoxempleado">
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

<TABLE BORDER="0" CELLSPACING="4" WIDTH="500">

    <TR>
        <TD width="173"><label>Cédula de Empleado</label></TD>
        <TD width="94">
            <input type="text" name="cedulaempleado" id="cedulaempleado" size="20" value=<?php echo $cedulaempleado ?>></TD>
        <TD>
            <!--<input type="submit" value="Buscar" name="submit">-->
            <input type="button" onClick="javascript: buscar_empleado()" name="buscar" value="Buscar" >
        </TD>
    </TR> 
    <TR>
        <TD><label>Nombre</label></TD>
        <TD><input type="text" name="nombre" id="nombre" size="20" value=<?php echo strtoupper($nombre) ?>></TD>
        <TD width="107"><label>Apellido</label></TD>
        <TD width="98"><input type="text" name="apellido" id="apellido" size="20" value=<?php echo strtoupper($apellido) ?>></TD>
    </TR>
    <TR>
        <TD><label>Mes</label></TD>
        <TD>
            <select name='codigomes' id='codigomes' onChange='cargasemana(this.value)' value="<?php echo $codigomes ?>">
                <option value="0">------</option>
                <option value="1">Enero</option>
                <option value="2">Febrero</option>
                <option value="3">Marzo</option>
                <option value="4">Abril</option>
                <option value="5">Mayo</option>
                <option value="6">Junio</option>
                <option value="7">Julio</option>
                <option value="8">Agosto</option>
                <option value="9">Septiembre</option>
                <option value="10">Octubre</option>
                <option value="11">Noviembre</option>
                <option value="12">Diciembre</option>
           </select>
        </TD>
        
        <TD>- Mes Actual: <?php echo $codigomes ?></TD>
        
        <TD><label>Semana</label></TD>
        <TD>
           <select name='codigosemana' id='codigosemana' value="<?php echo $codigosemana ?>"></select>
        </TD>

        <TD>- Semana Actual: <?php echo $codigosemana ?></TD>
    </TR>

    <table border="1" width="100">
    <TR>
          <TD><label>Seleccione Turno</label></TD>
            <?php // consulta de los meses
             // Consultar la base de datos
                include("db.php");
                $consulta_mysql='select * from mrh_turnos';
                $resultado_consulta_mysql=mysql_query($consulta_mysql);
                echo "<TD>";
                echo "<select name='codigoturno' id='codigoturno' size='10' value=$codigoturno>";
                    while($fila=mysql_fetch_array($resultado_consulta_mysql)){
                        echo "<option value='".$fila['codigo']."'>".$fila['descripcion'].'-'.$fila['horaentrada'].'-'.$fila['horasalida']."</option>";
                    }
                echo "</select>";
                echo "</TD>";
             ?>   
          <TD>- Turno Actual: <?php echo $descripcionturno ?></TD>
    </TR>
    </table>
    
</TABLE>

<TABLE>
<TR>
    <TD>
        <a><input type="Submit" name="ver_turnos" value="Ver Datos"></a> 
    </TD>
    <TD>
        <!--<input type="button" onClick="javascript: insertar()" name="asignar" value="Asignar Turno" >-->
        <a><input type="Submit" name="submit" value="Modificar Turno"></a> 
    </TD>    
    <TD>
        <a href="turnosxempleado_ver.php?cedulaempleado=<?php $cedulaempleado ?>"><input type="button" value="Atras"></a> 
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
    popupempleados = window.open("turnosxempleados_buscarempleado.php", "nuevo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=400, height=400");
    popupempleados.focus(); 
}


function cargasemana(str)
	{
		if (str=="")
		{
			document.getElementById("codigomes").innerHTML="";
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
		xmlhttp.open("GET","semana.php?codigomes="+str,true);
		
		xmlhttp.send();
	}
</script>