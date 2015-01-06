<?php 
/* INCLUDES*/
//echo  substr( "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ" ,mt_rand( 0 ,50 ) ,1 ) .substr( md5( time() ), 1);
header("Content-Type: text/html;charset=utf-8");
require_once ('../../db.php');
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
<script src="../../js/htmlDatePicker.js" type="text/javascript"></script>
<link href="../../css/htmlDatePicker.css" rel="stylesheet">
<!-- Beginning of compulsory code below -->
<link href="/sicap/css/dropdown/dropdown.css" media="screen" rel="stylesheet" type="text/css" />
<link href="/sicap/css/dropdown/themes/flickr.com/default.ultimate.css" media="screen" rel="stylesheet" type="text/css" />

 <script>
    $(function() {
        $( "#datepicker1" ).datepicker({ dateFormat: 'yy-mm-dd' });
        $( "#datepicker2" ).datepicker({ dateFormat: 'yy-mm-dd' });
        $( "#datepicker3" ).datepicker({ dateFormat: 'yy-mm-dd' });
    });
</script>   
<link href="../../css/stylesheet.css" rel="stylesheet" type="text/css" />

 
<!-- Beginning of compulsory code below -->

</head>


<body class="flickr-com">
<!--<p><a href="mrh_menu.html" class="main-site">Principal</a></p>-->
<!--<h1><img src="images/seleccion_sicap_archivos/image002.jpg" alt="flickr" />Módulo de Recursos Humanos | Cargo</h1>-->
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
    <h1><img src="../../images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong>                Módulo de Inventario | Articulo</strong></h1>

<TABLE BORDER="0" CELLSPACING="4" WIDTH="500">
     <TR>
          <TD><label>Código</label></TD>
          <TD><p><input type="text" name="codigoalias" id="codigoalias" size="20"></p></TD>
     </TR> 
     <TR>
          <TD><label>Descripción</label></TD>
          <TD><p><input type="text" name="descripcion" id="descripcion" size="20"></p></TD>
     </TR>
     <TR>
        <td><label>Serial del Artículo</label></td>
        <td><p><input type="text" name="serial" id="serial" size="20"></p></td>
     </TR>
    
    <tr>
        <td><label>Unidad de Medida</label></td>
        <td>
            
    <select name="title" style="width:144px">
      <?php 
      	$result=mysql_query("SELECT descripcion,sigla FROM mco_unidad");
        while($test = mysql_fetch_array($result)){
            $id = $test['codigo'];
            echo"<option>".$test['descripcion']."  (". $test['sigla'].")". "</option>";
            
        }        
        
      ?>  
      
    
    </select>
 
            
            
        </td>
    </tr>
    
     <TR>
        <td><label>Precio A del Artículo</label></td>
        <td><p><input type="text" name="precio_a" id="descripcion" size="20"></p></td>
    </TR>
     <TR>
        <td><label>Precio B del Artículo</label></td>
        <td><p><input type="text" name="precio_b" id="descripcion" size="20"></p></td>
    </TR>
    <TR>
        <td><label>Precio C del Artículo</label></td>
        <td><p><input type="text" name="precio_c" id="descripcion" size="20"></p></td>
    </TR>
    <TR>
        <td><label>Precio D del Artículo</label></td>
        <td><p><input type="text" name="precio_d" id="descripcion" size="20"></p></td>
    </TR>
    <tr>
        <td><label>Existencia Inicial del Artículo</label></td>
        <td><p><input type="text" name="existencia_inicial" id="descripcion" size="20"></p></td>
    
    <tr>
    
    <tr>
        <td><label>Existencia Máxima del Artículo</label></td>
        <td><p><input type="text" name="existencia_maxima" id="descripcion" size="20"></p></td>
    
    <tr>    
        
        <td><label>Foto del Artículo</label></td>
        <td><input type="file" name="foto_articulo" size="19"></td>
    </tr>
    <tr>
        <td><label>Ubicación del Artículo</label></td>
        <td><p><input type="text" name="ubicacion" id="descripcion" size="20"></p></td>
    
    <tr>
    <td><label>Peso del Artículo</label></td>
        <td><p><input type="text" name="peso" id="descripcion" size="20"></p></td>
    </tr>
    
    <tr>
    <td><label>Profundidad del Artículo</label></td>
        <td><p><input type="text" name="profundidad" id="descripcion" size="20"></p></td>
    </tr>    
        
    <tr>
    <td><label>Ancho del Artículo</label></td>
        <td><p><input type="text" name="ancho" id="descripcion" size="20"></p></td>
    </tr>      
        
    <tr>
    <td><label>Fabricante</label></td>
        <td><p><input type="text" name="fabricante" id="descripcion" size="20"></p></td>
    </tr>    
        
    <tr>
        <TD class="firefox"><label>Fecha de Vencimiento</label></TD>
	   <TD><p><input type="text" id="datepicker3" name="fecha_vencimiento"></p></TD>
	 
    </tr><!-- voy aca -->
    <TR>
        <td><label>Observación del Artículo</label></td>
        <td><p><textarea rows="4" cols="18" name="observacion"></textarea></p></td>
    </TR>
    
</TABLE>

<table>
        <tr>
        <td><input type="submit" value="Guardar datos" name="submit"></td>
        <td><a href="articulo_ver.php"><input type="button" value="Ver datos"></a> </td>
        <td><a href="../../min_menu.php"><input type="button" value="Atras"></a> </td>
        
        </tr>
</table>
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

        
        
<?php
if (isset($_POST['submit']))
	{	   
	
        
        $codigoalias = $_POST['codigoalias'];
        $descripcion = $_POST['descripcion'];
        $serial = $_POST['serial'];
        $precio_a = $_POST['precio_a'];
        $precio_b = $_POST['precio_b'];
        $precio_c = $_POST['precio_c'];
        $precio_d = $_POST['precio_d'];
        $existencia_inicial = $_POST['existencia_inicial'];
        $existencia_maxima = $_POST['existencia_maxima'];
        $foto_articulo = $_POST['foto_articulo'];
        $ubicacion = $_POST['ubicacion'];
        $peso = $_POST['peso'];
        $profundidad = $_POST['profundidad'];
        $ancho = $_POST['ancho'];
        $fabricante = $_POST['fabricante'];
        $fecha_vencimiento = $_POST['fecha_vencimiento'];
        $observacion = $_POST['observacion'];
        
           /* OJO: falta la unidad de medida*/
        $sql = "insert into min_articulos (codigo_alias,descripcion,serial,
                precio_a,precio_b,precio_c,precio_d,existencia_inicial,
                existencia_maxima,foto_articulo,ubicacion,peso,profundidad,
                ancho,fabricante,fecha_vencimiento,observacion)
                    values('$codigoalias','$descripcion','$serial','$precio_a',
                    '$precio_b','$precio_c','$precio_d','$existencia_inicial',
                    '$existencia_maxima','$foto_articulo','$ubicacion','$peso',
                    '$profundidad','$ancho','$fabricante','$fecha_vencimiento',
                    '$observacion');";
                    
                        
	//echo $sql;
        //exit;
        
	mysql_query($sql) or die('No se pudo guardar la información. '.mysql_error());			
	echo "Registro Almacenado";			
	        }
?>
</form>
</body>
</html>
