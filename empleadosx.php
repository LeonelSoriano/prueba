<?php

include_once('clases/Seguridad.php');

$a = new Seguridad();

$a->chekear_session();

?>


<?php
    include("db.php");
?>

<?php
if (isset($_POST['submit']))
{


    header("Content-Type: text/html;charset=utf-8");
    ini_set('display_errors', 'On');
    ini_set('display_errors', 1);
    include('./clases/funciones.php');
    require_once('./min/until/SubirFoto.php');
    include('./clases/Validate.php');



    $validation = array(

        array('nombre' => 'primernombre',
            'requerida' => true,
            'regla' => 'letter'),

        array('nombre' => 'segundonombre',
            'requerida' => false,
            'regla' => 'letter'),

        array('nombre' => 'primerapellido',
            'requerida' => true,
            'regla' => 'letter'),

        array('nombre' => 'segundoapellido',
            'requerida' => false,
            'regla' => 'letter'),

        array('nombre' => 'fechaingreso',
            'requerida' => true),

        array('nombre' => 'cedula',
            'requerida' => true,
            'regla' => 'number'),

        array('nombre' => 'fechanacimiento',
            'requerida' => true
            )

    );

    $validated = new Validate($validation,$_POST);
    $validated->validate();



    if(!$validated->getIsError()){
        $cedula=$_POST['cedula'];
        $ficha=$_POST['ficha'];
        $primernombre=  cadena_estetica($_POST['primernombre']);
        $segundonombre= cadena_estetica($_POST['segundonombre']);
        $primerapellido= cadena_estetica($_POST['primerapellido']);
        $segundoapellido= cadena_estetica($_POST['segundoapellido']);
        $fechanacimiento= $_POST['fechanacimiento'];
        $telefono=$_POST['telefono'];
        $celular=$_POST['celular'];
        $estadocivil=$_POST['estadocivil'];
        $becado=$_POST['becado'];
        $sexo=$_POST['sexo'];
        $fechaingreso=$_POST['fechaingreso'];
        $fechaegreso=$_POST['fechaegreso'];
        $codigocargo=$_POST['codigocargo'];
        $estatus=$_POST['estatus'];
        $condicion=$_POST['condicion'];
        $codigoperioricidad=$_POST['codigoperioricidad'];
        $direccionhabitacion=$_POST['direccion'];

        $tipo_trabajador = $_POST['tipo_trabajador'];


        $nacionalidad = $_POST['nacionalidad'];

        $departamento=$_POST['departamento'];

        $vehiculo = $_POST['vehiculo'];


        $subirFoto = new SubirFoto($_FILES['imagen'],'./img_empleados/');
        $subirFoto->cargarFoto();
        $imagen = $subirFoto->getNombreSubir();


        $sql = "SELECT count(*) as total FROM mrh_empleado WHERE  mrh_empleado.cedula = '$cedula' AND mrh_empleado.nacionalidad = '$nacionalidad'";


        $result = mysql_query($sql);

        $test = mysql_fetch_array($result);

        if( strcmp($test['total'],'0')  ){
            $a = $test['total'];
            send_error_redirect(true, "El Empleado ya Existe");
            die;
        }


        $sql = "insert into mrh_empleado(cedula,ficha,primernombre,segundonombre,primerapellido,segundoapellido,
					fechanacimiento,telefono,celular,estadocivil,becado,sexo,fechaingreso,fechaegreso,
						codigocargo,estatus,condicion,codigoperioricidad,direccionhabitacion,codigo_departamento,vehiculo,nacionalidad,tipo_trabajador,foto)
                                                      values('$cedula','$ficha','$primernombre','$segundonombre','$primerapellido','$segundoapellido','$fechanacimiento',
							'$telefono','$celular','$estadocivil','$becado','$sexo','$fechaingreso','$fechaegreso','$codigocargo','$estatus','$condicion',
								'$codigoperioricidad','$direccionhabitacion','$departamento','$vehiculo','$nacionalidad','$tipo_trabajador','$imagen')";
        //echo $sql;
        //exit;
        mysql_query($sql) or die('No se pudo guardar la información. '.mysql_error());

        send_error_redirect(false,'Datos Guardados Exitosamente');
        die;

    }else if($validated->getIsError()){

        send_error_redirect(true,"Hay Errores en la Información del formulario");die;
    }


}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
<title>SICAP | Sistema Integral de Costos</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="css/helper.css" media="screen" rel="stylesheet" type="text/css" />
<link href="css/ui-lightness/jquery-ui-1.10.4.custom.css" rel="stylesheet">
<script src="js/jquery-1.10.2.js"></script>
<script src="js/jquery-ui-1.10.4.custom.js"></script>
<link href="./css/stylesheet.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" href="/resources/demos/style.css">

 <script>
    $(function() {
        $( "#datepicker1" ).datepicker({ dateFormat: 'yy-mm-dd',changeYear: true, yearRange: "-100:+0"});
        $( "#datepicker2" ).datepicker({ dateFormat: 'yy-mm-dd',changeYear: true, yearRange: "-100:+0"  });
        $( "#datepicker3" ).datepicker({ dateFormat: 'yy-mm-dd',changeYear: true, yearRange: "-100:+0" });
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
<form method="post" enctype="multipart/form-data">
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

 <h1><img src="images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong>                Módulo de Recursos Humanos | Empleado</strong></h1>
  <br/>

  <?php

      if(isset($_GET['msg'])){
          $error =  $_GET['error'];

          $msg = $_GET['msg'];

          if($error == 'true'){
            echo('<div id="error_app"><marquee scrolldelay="100">'.$msg.'</marquee></div>');
          }else if($error == 'false'){
              echo('<div id="done_app"><marquee scrolldelay="100">'.$msg.'</marquee></div>');

          }

      }

  ?>
      <br/>
<TABLE BORDER="0" CELLSPACING="4" WIDTH="581">

     <TR>
         
          <TD width="143" class="firefox"><label>Cédula (*)</label></TD>
          <TD width="167"><p><input type="text" name="cedula" id="cedula" size="20"></p></TD>
	
          <TD width="107" class="firefox"><label>Nacionalidad</label></TD>
          <TD width="136">
			<select id="nacionalidad" name="nacionalidad">
				<option value="V">Venezolano</option>
				<option value="E">Extranjero</option>
			</select> 
		  </TD>
          
     </TR>


    <tr>
        <TD width="143" class="firefox"><label>Becado</label></TD>
         <td><select id="becado" name="becado">
             <option value="1">Sí</option>
             <option value="0">No</option>
         </select>
         </td>

    </tr>



     <TR>
          <TD class="firefox"><label>Ficha</label></TD>
          <TD><p><input type="text" name="ficha" id="ficha" size="20"></p></TD>
          
          <TD class="firefox"><label>Sexo</label></TD>
          <TD>
			<select id="genero" name="sexo">
				<option value="M">Masculino</option>
				<option value="F">Femenino</option>
			</select> 
		  </TD>
		  
     </TR> 
     <TR>
          <TD class="firefox"><label>Primer Nombre(*)</label></TD>
          <TD><p><input type="text" name="primernombre" id="primernombre" size="20"></p> </TD>
	
	  <TD class="firefox"><label>Fec. de Ingr.(*)</label></TD>
          <TD><p><input type="text" id="datepicker1" name="fechaingreso"></p></TD>
	 
	 
	 </TR>
	 <TR>
          <TD class="firefox"><label>Segundo Nombre(*)</label></TD>
       <TD><p><input type="text" name="segundonombre" id="segundonombre" size="20"></p> </TD>
	 
		  <TD class="firefox"><label>Fec. de Egreso</label></TD>
		  <TD><p><input type="text" id="datepicker2" name="fechaegreso"></p></TD>
	 </TR>
	 <TR>
          <TD width="143" class="firefox"><label>Primer Apellido(*)</label></TD>
       <TD><p><input type="text" name="primerapellido" id="primerapellido" size="20"></p> </TD>
	 
	  <TD><label>Cargo</label></TD>    

            <?php // consulta de los meses
        // Consultar la base de datos

                include_once("./clases/funciones.php");
                $consulta_mysql='select * from mrh_cargo ORDER BY descripcion';
                $resultado_consulta_mysql=mysql_query($consulta_mysql);
                echo "<TD>";
                echo "<select name='codigocargo' id='codigocargo' >";
                    while($fila=mysql_fetch_array($resultado_consulta_mysql)){
                        echo "<option value='".$fila['codigo']."'>".utf8_multiplataforma($fila['descripcion'])."</option>";
                    }
                echo "</select>";
                echo "</TD>";
             ?>   
	 
	 </TR>

    <tr><td></td><td></td>
        <td><label >Departamento</label></td>
        <td>
            <select name="departamento" >

            <?php
            $sql = "SELECT mno_gerencia.codigo,mno_gerencia.descripcion FROM mno_gerencia ORDER BY descripcion";
            $test = mysql_query($sql);

            while($fila=mysql_fetch_array($test)){
                echo "<option value='".utf8_multiplataforma($fila['codigo'])."'>".$fila['descripcion']."</option>";

            }

            ?>

            </select>
        </td>
    </tr>


	 <TR>
          <TD width="143" class="firefox"><label>Segundo Apellido(*)</label></TD>
       <TD><p><input type="text" name="segundoapellido" id="segundoapellido" size="20"></p> </TD>
	 	  
	 	  <TD class="firefox"><label>Estatus</label></TD>
          <TD>
			<select id="estatus" name="estatus">
				<option value="1">Activo</option>
				<option value="0">Inactivo</option>
			</select> 
		  </TD>
	 
	 </TR>
	 <TR>
		  <TD class="firefox"><label>Fecha de Nacimiento(*)</label></TD>
	   <TD><p><input type="text" id="datepicker3" name="fechanacimiento"></p></TD>
	 
	 	   <TD class="firefox"><label>Condición</label></TD>
          <TD>
			<select id="condicion" name="condicion">
				<option value="N">Normal</option>
				<option value="J">Jubilad@s</option>
                                <option value="D">Discapacitad@s</option>
			</select> 
		  </TD>
	 
	 </TR>
	 <TR>
         <TD class="firefox"><label>Telefono</label></TD>
        <TD><p><input type="text" name="telefono" id="telefono" size="20"></p> </TD>



         <TD class="firefox"><label>Tipo de Trabajador</label></TD>
         <TD>
             <select id="tipo_trabajador" name="tipo_trabajador">
                 <option value="EMP">Empleado</option>
                 <option value="OBR">Obrero</option>

             </select>
         </TD>
	 <TR>
        <TD class="firefox"><label>Celular</label></TD>
        <TD><p><input type="text" name="celular" id="celular" size="20"></p> </TD>
          
        <!--<TD><label>Gerencia</label></TD>-->    

            <?php // consulta de los meses
        // Consultar la base de datos
            /*    include("db.php");
                $consulta_mysql='select * from mrh_gerencia';
                $resultado_consulta_mysql=mysql_query($consulta_mysql);
                echo "<TD>";
                echo "<select name='mes' id='mes' >";
                    while($fila=mysql_fetch_array($resultado_consulta_mysql)){
                        echo "<option value='".$fila['codigoalias']."'>".$fila['descripcion']."</option>";
                    }
                echo "</select>";
                echo "</TD>";*/
             ?> 
	 </TR>
	 <TR>
		  <TD class="firefox">Estado Civil</TD>
		  <TD>
			<select id="estadocivil" name="estadocivil">
                                <option value="0">--------</option>
				<option value="C">Casado(a)</option>
				<option value="S">Soltero(a)</option>
				<option value="D">Divorciado(a)</option>
				<option value="V">Viudo(a)</option>
				<option value="O">Concubino(a)</option>
			</select> 
		  </TD>
                  <TD class="firefox"><label>Perioricidad</label></TD>
          <TD>
			<select id="perioricidad" name="codigoperioricidad">
				<option value="0">---------</option>
				<option value="H">Horaria</option>
				<option value="S">Semanal</option>
                <option value="Q">Quincenal</option>
                <option value="M">Mensual</option>
			</select> 
        </TD>
	 </TR>
        <TR>
            <TD class="firefox"><label>Dirección de Habitación</label></TD>
          <TD><p><input type="text" name="direccion" id="direccion" size="15"></p> </TD>
          <td class="firefox">&nbsp;</td>
          <td>&nbsp;</td>
        </TR>

<tr></tr><tr></tr>

        <tr>

            <td>
                <label >Vehiculo</label></td>
                <td><select name="vehiculo" id="">
                    <option value="si" >si</option>
                    <option value="no" selected>no</option>
                </select>
            </td>



         <td>
             <label>Foto de Empleado </label>

         <td>
             <p>
                 <input type="file" name="imagen" >
             </p>
         </td>




        </tr>

</TABLE>
                                  <br/>
 <TABLE>
    <TR>
        <TD>
           <input type="submit" name="submit" value="Guardar datos" >
        </TD>
        <TD>
            <a href="empleados_ver.php"><input type="button" value="Ver datos"></a> 
        </TD>
        <TD>
            <a href="mrh_menu.php"><input type="button" value="Atras"></a>
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

<!-- / END -->




</form>
</body>
</html>
