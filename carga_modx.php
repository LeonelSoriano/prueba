<?php

include_once('clases/Seguridad.php');

$a = new Seguridad();

$a->chekear_session();

?>

    <?php
        
        require("db.php");
        $id =$_REQUEST['codigo'];
        $cedulaempleado =$_REQUEST['cedula'];
//        echo $id;
//        echo "-";
//        echo $cedulaempleado;
        
        $result = mysql_query("SELECT * FROM mrh_empleado WHERE cedula  = '$cedulaempleado'");
        $test = mysql_fetch_array($result);
        if (!$result) 
	{
		die("Error: Data not found..");
	}
        
        $primernombreempleado = $test['primernombre'];
        $primerapellidoempleado = $test['primerapellido'];
        
        $result = mysql_query("SELECT * FROM mrh_carga WHERE codigo  = '$id'");
        $test = mysql_fetch_array($result);
        if (!$result) 
	{
		die("Error: Data not found..");
	}

        $cedula = $test['cedula'];
        $primernombre = $test['primernombre'];
        $segundonombre = $test['segundonombre'];
        $primerapellido=$test['primerapellido'];
        $segundoapellido=$test['segundoapellido'];
        $fechanacimiento=$test['fechanacimiento'];
        $parentesco=$test['parentesco'];
        
        switch ($parentesco) {
            case "P":
                $descparentesco = "Padre";
                break;
            case "M":
                $descparentesco = "Madre";
                break;
            case "H":
                $descparentesco = "Hijo(a)";
                break;
            case "C":
                $descparentesco = "Conyugue";
                break;
        }
        
        
        $estudios=$test['estudios'];

        switch ($estudios) {
            case "G":
                $descestudios = "Guarderia";
                break;
            case "P":
                $descestudios = "Primaria";
                break;
            case "S":
                $descestudios = "Secundaria";
                break;
            case "U":
               $descestudios= "Superior";
                break;
        }
        

        
// modificacion de la carga familiar        
if(isset($_POST['submit']))
{	
        include("db.php");
        $cedulaempleado=$_POST['cedulaempleado'];
        $cedula=$_POST['cedula'];
        $primernombre=$_POST['primernombre'];
        $segundonombre=$_POST['segundonombre'];
        $primerapellido=$_POST['primerapellido'];
        $segundoapellido=$_POST['segundoapellido'];
        $fechanacimiento=$_POST['fechanacimiento'];
        $parentesco=$_POST['parentesco'];
        $estudios=$_POST['estudios'];

        $sql = "update mrh_carga set
                    cedula='$cedula',
                        primernombre='$primernombre',
                            segundonombre='$segundonombre',
                                primerapellido='$primerapellido',
                                    segundoapellido='$segundoapellido',
                                        fechanacimiento='$fechanacimiento',
                                            parentesco='$parentesco',
                                                estudios='$estudios'
                                                    where
                                                        codigo  = '$id'";
       //echo $sql;
       //exit;
       mysql_query($sql) or die(mysql_error()); 
	
       echo "<script type='text/javascript'>";
       echo "    alert('Registro Modificado');";
       echo "</script>";  
	
	header ("Location: carga_ver.php?codigo=$cedulaempleado");			
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
<link href="css/ui-lightness/jquery-ui-1.10.4.custom.css" rel="stylesheet">
<script src="js/jquery-1.10.2.js"></script>
<script src="js/jquery-ui-1.10.4.custom.js"></script>   
<link href="./css/stylesheet.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="/resources/demos/style.css">

 <script>
    $(function() {
        $( "#datepicker1" ).datepicker({ dateFormat: 'yy-mm-dd' });
        $( "#datepicker2" ).datepicker({ dateFormat: 'yy-mm-dd' });
        $( "#datepicker3" ).datepicker({ dateFormat: 'yy-mm-dd' });
    });
</script>    
<!-- Beginning of compulsory code below -->

<link href="css/dropdown/dropdown.css" media="screen" rel="stylesheet" type="text/css" />
<link href="css/dropdown/themes/flickr.com/default.ultimate.css" media="screen" rel="stylesheet" type="text/css" />

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
  
 <h1><img src="images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong>                Módulo de Recursos Humanos | Carga Familiar</strong></h1>
                                    <br/>
 <TABLE BORDER="0" CELLSPACING="4" WIDTH="500">

    <TR>
          <TD><label>Cédula de Empleado</label></TD>
          <TD><p><input type="text" name="cedulaempleado" id="cedulaempleado" size="20"  value = <?php echo strtoupper($cedulaempleado) ?> ></p></TD>
          <TD><p><input type="text" name="primernombre" id="primernombre" size="20"  value = <?php echo strtoupper($primernombreempleado) ?> ></p></TD>
          <TD><p><input type="text" name="primerapellido" id="primerapellido" size="20"  value = <?php echo strtoupper( $primerapellidoempleado) ?> ></p></TD>
          
          
    </TR> 
    <TR>
          <TD><label>Cédula</label></TD>
          <TD><p><input type="text" name="cedula" id="cedula" size="20" value = <?php echo strtoupper($cedula) ?>></p></TD>
    </TR> 
    <TR>
          <TD><label>Primer Nombre</label></TD>
          <TD><p><input type="text" name="primernombre" id="primernombre" size="20" value = <?php echo strtoupper($primernombre) ?>></p> </TD>

          <TD><label>Segundo Nombre</label></TD>
          <TD><p><input type="text" name="segundonombre" id="segundonombre" size="20" value = <?php echo strtoupper($segundonombre) ?>></p> </TD>
    </TR>
	 <TR>
          <TD><label>Primer Apellido</label></TD>
          <TD><p><input type="text" name="primerapellido" id="primerapellido" size="20" value = <?php echo strtoupper($primerapellido) ?>></p> </TD>

          
          <TD><label>Segundo Apellido</label></TD>
          <TD><p><input type="text" name="segundoapellido" id="segundoapellido" size="20" value = <?php echo strtoupper($segundoapellido) ?>></p> </TD>
    </TR>
    <TR>
          <TD class="firefox"><label>Fec. de Nacimiento</label></TD>
	  <TD><p><input type="text" id="datepicker2" name="fechanacimiento" value = <?php echo strtoupper($fechanacimiento) ?>></p></TD>

          <TD><label>Parentesco</label></TD>
          <TD>
			<select id="parentesco" name="parentesco" >
				
                            <option value=<?php echo $parentesco?>><?php echo $descparentesco?></option>
				<option value="P">Padre</option>
				<option value="M">Madre</option>
			        <option value="H">Hijo(a)</option>
			        <option value="C">Conyugue</option>
			</select> 
		  </TD>
	 </TR>
         <TR>
		  <TD><label>Estudios</label></TD>
		  <TD>
			<select id="estudios" name="estudios" value = <?php echo $estudios ?>>
                                 <option value=<?php echo $estudios?>><?php echo $estudios?></option>
				<option value="G">Guardería</option>
                                <option value="P">Primaria</option>
				<option value="S">Secundaria</option>
				<option value="U">Superior</option>
			</select> 
		  </TD>
	 </TR>
</TABLE>

<table> 
        <tr>    
            <td><input type="submit" value="Guardar" name="submit"></td>
            
            <td><a href ="carga_ver.php?codigo=<?php echo $_GET['codigo']?>"><input type="button" value="Atras"></a></td>
           
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

<!-- / END -->





</form>    
</body>
</html>

