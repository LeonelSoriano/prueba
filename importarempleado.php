<?php

include_once('clases/Seguridad.php');

$a = new Seguridad();

$a->chekear_session();

?>

<?php


    if (isset($_POST['submit'])){
		

		
		//print_r($_FILES);
		if ($_FILES["file"]["error"] > 0) {
			echo "Error: " . $_FILES["file"]["error"] . "<br>";
		} 
		else 
		{
			/*echo "Upload: " . $_FILES["file"]["name"] . "<br>";
			echo "Type: " . $_FILES["file"]["type"] . "<br>";
			echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
			echo "Stored in: " . $_FILES["file"]["tmp_name"];*/
	        $tmp_name = $_FILES["file"]["tmp_name"];	
			move_uploaded_file($_FILES['file']['tmp_name'], './' . $_FILES['file']['name']);


			$archivo = $_FILES["file"]["name"];

			
			
			$fila = 1;
			if (($gestor = fopen($archivo, "r")) !== FALSE) {
				while (($datos = fgetcsv($gestor, 1000, ",")) !== FALSE) {
					$numero = count($datos);
					if ($numero<>19){
						echo "<p> Archivo Incorrecto en fila </p>".$fila;
						break;
					}
					
					//echo "<p> $numero de campos en la línea $fila: <br /></p>\n";
					$fila++;
						for ($c=0; $c < $numero; $c++) {
							//echo $datos[$c] . "<br />\n";
							
							
							if ($datos[$c]==""){
								
							}
							elseif($datos[$c]<>""){
								//echo $datos[$c]."<br/>";
							}
						}
							$cedula = $datos[0];
							//echo $cedula."<br/>";
							$ficha = $datos[1];
							//echo $ficha."<br/>";
							$primernombre = $datos[2];
							//echo $primernombre."<br/>";
							$segundonombre = $datos[3];
							//echo $segundonombre."<br/>";
							$primerapellido = $datos[4];
							//echo $primerapellido."<br/>";
							$segundoapellido = $datos[5];
							//echo $segundoapellido."<br/>";
							$fechanacimiento = $datos[6];
							//echo $fechanacimiento."<br/>";
							$telefono = $datos[7];
							//echo $telefono."<br/>";
							$celular = $datos[8];
							//echo $celular."<br/>";
							$estadocivil = $datos[9];
							//echo $estadocivil."<br/>";
							$becado = 0;
							//echo $becado."<br/>";
							$sexo = $datos[11];
							//echo $sexo."<br/>";
							$fechaingreso = $datos[12];
							//echo $fechaingreso."<br/>";
							$fechaegreso = $datos[13];
							//echo $fechaegreso."<br/>";
							$codigocargo = $datos[14];
							//echo $codigocargo."<br/>";
							$estatus = 1;
							//echo $estatus."<br/>";
							$condicion = "N";
							//echo $condicion."<br/>";
							$codigoperioricidad = $datos[17];
							//echo $codigoperioricidad."<br/>";
							$direccionhabitacion = $datos[17];
							//echo $direccionhabitacion."<br/>";
							
							include 'db.php';
							$sql = "insert into mrh_empleado(cedula,ficha,primernombre,segundonombre,primerapellido,segundoapellido,
										fechanacimiento,telefono,celular,estadocivil,becado,sexo,fechaingreso,fechaegreso,
											codigocargo,estatus,condicion,codigoperioricidad,direccionhabitacion)
                                    values('$cedula','$ficha','$primernombre','$segundonombre','$primerapellido','$segundoapellido','$fechanacimiento',
												'$telefono','$celular','$estadocivil','$becado','$sexo','$fechaingreso','$fechaegreso','$codigocargo','$estatus','$condicion',
													'$codigoperioricidad','$direccionhabitacion')";
							//echo $sql;
							//exit;
							mysql_query($sql) or die('No se pudo guardar la información. '.mysql_error());			

							
						
						
				}
			fclose($gestor);
			}
			unlink($archivo);
			echo "Registro Almacenado";			
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
<!--<h1><img src="images/seleccion_sicap_archivos/image002.jpg" alt="flickr" />Módulo de Recursos Humanos | Cargo</h1>-->
<!-- Beginning of compulsory code below -->
<form action="importarempleado.php" method="post" enctype="multipart/form-data">
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
    <h1><img src="images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong>                Módulo de Configuración | Importar</strong></h1>

<TABLE BORDER="0" CELLSPACING="4" WIDTH="500">

    <TR>
        <td><label for="file">Seleccione Archivo:</label></td>
		<td><input type="file" name="file" id="file" ><br></td>
		<td><input type="submit" name="submit" value="Enviar"></td>
    </TR> 
</TABLE>

    <table>
        <tr>
        <td><a href="empleados_ver.php"><input type="button" value="Ver datos"></a> </td>
        <td><a href="mrh_menu.php"><input type="button" value="Atras"></a> </td>
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
</form>
</body>
</html>
