<?php
       
require("../../db.php");
$id =$_REQUEST['codigo'];

$result = mysql_query("SELECT * FROM mno_constante WHERE codigo  = '$id'");
//echo $result;
//exit;
$test = mysql_fetch_array($result);
if (!$result) 
    {
        die("Error: Data not found..");
    }
             
        $codigoproceso=$test['codigoproceso'];
        $descripcion=$test['descripcion'];
        $asignacion=$test['asignacion'];
            
                
if(isset($_POST['submit']))
{	
        
        $codigoproceso=$_POST['codigoproceso'];
        $descripcion=$_POST['descripcion'];

         $sql = "update mno_constante set codigoproceso='$codigoproceso',descripcion='$descripcion',asignacion='$asignacion'
                 where codigo = '$id'";
       //echo $sql;
       //exit;
	mysql_query($sql)or die(mysql_error()); 
	
        echo "<script type='text/javascript'>";
        echo "    alert('Registro Guardado');";
        echo "</script>";
	
	header("Location: constante_ver.php");			
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
<link href="../../css/helper.css" media="screen" rel="stylesheet" type="text/css" />
<link href="../../css/ui-lightness/jquery-ui-1.10.4.custom.css" rel="stylesheet">
<script src="../../js/jquery-1.10.2.js"></script>
<script src="../../js/jquery-ui-1.10.4.custom.js"></script>
<link rel="stylesheet" href="/resources/demos/style.css">
<link href="../../css/stylesheet.css" rel="stylesheet" type="text/css" />

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

<!--<p><a href="mrh_menu.html" class="main-site">Principal</a></p>

<h1><img src="images/flickr.com/icon.png" alt="flickr" />Módulo de Recursos Humanos | Empleados</h1>-->

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
    <h1><img src="/sicap/images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong>                Módulo de Recursos Humanos | Otros Beneficios Laborales</strong></h1>

<TABLE BORDER="0" CELLSPACING="4" WIDTH="500">

     <TR>
          <TD><label>Código</label></TD>
          <TD><p><input type="text" name="codigoproceso" id="codigoproceso" size="20" value="<?php echo $codigoproceso?>"></p></TD>
     </TR> 
    <TR>
          <TD><label>Descripción</label></TD>
          <TD><p><input type="text" name="descripcion" id="descripcion" size="20" value="<?php echo $descripcion?>"></p></TD>
     </TR> 
     

</TABLE>

<table>
    <tr>    
        <td><input type="submit" name="submit" value="Guardar datos" ></td>
        <td><a href="otros_ben_ver.php"><input type="button" value="Atras"></a></td> 
    </tr>
</table>
<!-- / END -->
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



</form>
</body>
</html>
