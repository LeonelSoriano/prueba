<?php

include_once('clases/Seguridad.php');

$a = new Seguridad();

$a->chekear_session();

?>

<?php
header("Content-Type: text/html;charset=utf-8");
ini_set('display_errors', 'On');
ini_set('display_errors', 1);
include_once('./clases/funciones.php');
require("db.php");

        //$codigodepartamento=$test['codigodepartamento'];
        //$codigogerencia=$test['codigogerencia'];

/*$result = mysql_query("SELECT * FROM mrh_departamento WHERE codigo  = '$codigodepartamento'");
//echo $result;
//exit;
$test = mysql_fetch_array($result);
if (!$result) 
		{
		die("Error: Data not found..");
		}        
$descripciondepartamento = $test['descripcion'];        
        
$result = mysql_query("SELECT * FROM mrh_gerencia WHERE codigo  = '$codigogerencia'");
//echo $result;
//exit;
$test = mysql_fetch_array($result);
if (!$result) 
		{
		die("Error: Data not found..");
		}        
$descripciongerencia = $test['descripcion'];*/



if (isset($_POST['submit']))
{
    header("Content-Type: text/html;charset=utf-8");
    ini_set('display_errors', 'On');
    ini_set('display_errors', 1);
    include('./clases/funciones.php');
    include('./clases/Validate.php');
    require_once('./min/until/SubirFoto.php');


    include 'db.php';

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
        ),

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
        $direccionhabitacion=$_POST['direccionhabitacion'];

        $nacionalidad = $_POST['nacionalidad'];

        $departamento=$_POST['departamento'];

        $vehiculo = $_POST['vehiculo'];

        $tipo_trabajador = $_POST['tipo_trabajador'];



        /*iMAGEN*/
        $imagen = $_POST['imagen'];





//        $subirFoto = new SubirFoto($_FILES['imagen'],'./img_empleados/');
//        $subirFoto->cargarFoto();
//        $imagen = $subirFoto->getNombreSubir();


        $id = $_POST['id'];


        $sql = '';
        if($imagen == ''  ){
            $sql = "UPDATE mrh_empleado SET  cedula='$cedula',
            ficha='$ficha',primernombre='$primernombre',segundonombre='$segundonombre',
            primerapellido='$primerapellido',segundoapellido='$segundoapellido',
            fechanacimiento='$fechanacimiento',telefono='$telefono',celular='$celular',
             estadocivil='$estadocivil',becado='$becado',sexo='$sexo',fechaingreso='$fechaingreso',
             fechaegreso='$fechaegreso',codigocargo='$codigocargo',estatus='$estatus',
             condicion='$condicion',codigoperioricidad='$codigoperioricidad',direccionhabitacion='$direccionhabitacion',
             codigo_departamento='$departamento',vehiculo='$vehiculo',nacionalidad='$nacionalidad',tipo_trabajador='$tipo_trabajador'
             WHERE codigo='$id'";
        }else{

            $subirFoto = new SubirFoto($_FILES['imagen'],'./img_empleados/');
            $subirFoto->cargarFoto();
            $imagen = $subirFoto->getNombreSubir();


            $sql = "UPDATE mrh_empleado SET  cedula='$cedula',
            ficha='$ficha',primernombre='$primernombre',segundonombre='$segundonombre',
            primerapellido='$primerapellido',segundoapellido='$segundoapellido',
            fechanacimiento='$fechanacimiento',telefono='$telefono',celular='$celular',
             estadocivil='$estadocivil',becado='$becado',sexo='$sexo',fechaingreso='$fechaingreso',
             fechaegreso='$fechaegreso',codigocargo='$codigocargo',estatus='$estatus',
             condicion='$condicion',codigoperioricidad='$codigoperioricidad',direccionhabitacion='$direccionhabitacion',
             codigo_departamento='$departamento',vehiculo='$vehiculo',nacionalidad='$nacionalidad',tipo_trabajador='$tipo_trabajador',foto='$imagen'
             WHERE codigo='$id'";
        }




        mysql_query($sql) or die('No se pudo guardar la información. '.mysql_error());

        $current_url = explode("?", $_SERVER['REQUEST_URI']);

        $primer_parametro = explode("&",$current_url[1]);
        header('Location: '.$current_url[0].'?'.$primer_parametro[0].'&error=false&msg=Datos Guardados Exitosamente');

        die;
    }else if($validated->getIsError()){

        $current_url = explode("?", $_SERVER['REQUEST_URI']);

        $primer_parametro = explode("&",$current_url[1]);

        header('Location: '.$current_url[0].'?'.$primer_parametro[0].'&error=true&msg=Hay Errores en la Información del formulario');
        die;

    }




}



$id =$_REQUEST['codigo'];

$result = mysql_query("SELECT * FROM mrh_empleado WHERE codigo  = '$id'");
//echo $result;
//exit;
$test = mysql_fetch_array($result);
if (!$result)
{
    die("Error: Data not found..");
}

$cedula=$test['cedula'];
$ficha=$test['ficha'];
$primernombre=$test['primernombre'];
$segundonombre=$test['segundonombre'];
$primerapellido=$test['primerapellido'];
$segundoapellido=$test['segundoapellido'];
$fechanacimiento=$test['fechanacimiento'];
$telefono=$test['telefono'];
$celular=$test['celular'];
$estadocivil=$test['estadocivil'];
$becado=$test['becado'];
$sexo=$test['sexo'];
$fechaingreso=$test['fechaingreso'];
$fechaegreso=$test['fechaegreso'];
$codigocargo=$test['codigocargo'];
$estatus=$test['estatus'];
$condicion=$test['condicion'];
$codigoperioricidad=$test['codigoperioricidad'];
$direccionhabitacion=$test['direccionhabitacion'];
$departamento = $test['codigo_departamento'];
$vehiculo = $test['vehiculo'];
$nacionalidad = $test['nacionalidad'];
$tipo_trabajador = $test['tipo_trabajador'];


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
<TABLE BORDER="0" CELLSPACING="4" WIDTH="500">

     <TR>
         
         
          <TD><label>Cédula</label></TD>
          <TD><p><input type="text" name="cedula" id="cedula" size="20" value="<?php echo $cedula?>"></p></TD>


         <TD width="107" class="firefox"><label>Nacionalidad</label></TD>
         <TD width="136">
             <select id="nacionalidad" name="nacionalidad">
                  <option value='V'>Venezolano</option>
                 <option value='E' <?php if($nacionalidad == 'E'){echo('selected');}?> >Extranjero</option>
             </select>
         </TD>


          
     </TR>


     <tr>
         <TD><label>Becado</label></TD>
         <TD>
             <select id="becado" name="becado" value="<?php echo $becado?>">
                 <option value="1">Sí</option>
                 <option value="0" <?php if($becado == '0'){echo('selected');}?> >No</option>
             </select>
         </TD>

     </tr>

     <TR>
          <TD><label>Ficha</label></TD>
          <TD><p><input type="text" name="ficha" id="ficha" size="20" value="<?php echo $ficha?>" ></p></TD>
          
          <TD><label>Sexo</label></TD>
          <TD>
			<select id="genero" name="sexo" ">
                <option value="M">Masculino</option>
				<option value="F" <?php if($sexo == 'F'){echo('selected');}?>>Femenino</option>
			</select> 
		  </TD>
		  
     </TR> 
     <TR>
          <TD><label>Primer Nombre</label></TD>
          <TD><p><input type="text" name="primernombre" id="primernombre" size="20" value="<?php echo $primernombre?>"></p> </TD>
	
	      <TD><label>Fecha de Ingreso</label></TD>
              <TD><p><input type="text" id="datepicker1" name="fechaingreso" value="<?php echo $fechaingreso?>"></p></TD>
	 
	 
	 </TR>
	 <TR>
          <TD><label>Segundo Nombre</label></TD>
          <TD><p><input type="text" name="segundonombre" id="segundonombre" size="20" value="<?php echo $segundonombre?>"></p> </TD>
	 
		  <TD><label>Fecha de Egreso</label></TD>
		  <TD><p><input type="text" id="datepicker2" name="fechaegreso" value="<?php echo $fechaegreso?>"></p></TD>
	 </TR>
	 <TR>
          <TD><label>Primer Apellido</label></TD>
          <TD><p><input type="text" name="primerapellido" id="primerapellido" size="20" value="<?php echo $primerapellido?>"></p> </TD>
	 
	  <TD><label>Cargo</label></TD>    

            <?php // consulta de los meses
        // Consultar la base de datos
                include("db.php");

                $consulta_mysql='select * from mrh_cargo';
                $resultado_consulta_mysql=mysql_query($consulta_mysql);



                echo "<TD>";
                echo "<select name='codigocargo' id='mes' >";
                    while($fila=mysql_fetch_array($resultado_consulta_mysql)){
                        if($fila['codigo'] == $codigocargo){

                            echo "<option value='".$fila['codigo']."'selected>".utf8_multiplataforma( $fila['descripcion'])."</option>";
                        }else{
                            echo "<option value='".$fila['codigo']."'>".utf8_multiplataforma( $fila['descripcion'])."</option>";
                        }
                    }
                echo "</select>";
                echo "</TD>";
             ?>   
	 
	 </TR>



    <tr>
        <td><label >Departamento</label></td>
        <td>
            <select name="departamento" >

                <?php
                include("db.php");
                $sql = "SELECT mno_gerencia.codigo,mno_gerencia.descripcion FROM mno_gerencia";
                $test = mysql_query($sql);

                while($fila=mysql_fetch_array($test)){
                    if($departamento == $fila['codigo']){
                    echo "<option value='".utf8_multiplataforma($fila['codigo'])."'selected>".$fila['descripcion']."</option>";
                    }else{
                        echo "<option value='".utf8_multiplataforma($fila['codigo'])."'>".$fila['descripcion']."</option>";

                    }
                }

                ?>

            </select>
        </td>
    </tr>



	 <TR>
          <TD><label>Segundo Apellido</label></TD>
          <TD><p><input type="text" name="segundoapellido" id="segundoapellido" size="20" value="<?php echo $segundoapellido?>"></p> </TD>
	 	  
	 	  <TD><label>Estatus</label></TD>
          <TD>
			<select id="estatus" name="estatus" ">
				<option value="1">Activo</option>
				<option value="0" <?php if($estatus == '0'){echo('selected');}?>>Inactivo</option>
			</select> 
		  </TD>
	 
	 </TR>
	 <TR>
		  <TD><label>Fecha de Nacimiento</label></TD>
		  <TD><p><input type="text" id="datepicker3" name="fechanacimiento" value="<?php echo $fechanacimiento?>"></p></TD>
	 
	 	   <TD><label>Condición</label></TD>
          <TD>
			<select id="condicion" name="condicion" ">
				<option value="N" <?php if($condicion == 'N'){echo('selected');}?>>Normal</option>
				<option value="J" <?php if($condicion == 'J'){echo('selected');}?>>Jubilad@s</option>
                <option value="D" <?php if($condicion == 'D'){echo('selected');}?>>Discapacitad@s</option>
			</select> 
		  </TD>
	 
	 </TR>
	 <TR>
          <TD><label>Telefono</label></TD>
          <TD><p><input type="text" name="telefono" id="telefono" size="20" value="<?php echo $telefono?>"></p> </TD>

         <TD><label> 	Tipo de Trabajador</label></TD>
         <TD>
             <select id="tipo_trabajador" name="tipo_trabajador" ">
             <option value="OBR" <?php if($tipo_trabajador == 'OBR'){echo('selected');}?>>Obrero</option>
             <option value="EMP" <?php if($tipo_trabajador == 'EMP'){echo('selected');}?>>Empleado</option>
             </select>
         </TD>
	 </TR>
	 <TR>
          <TD><label>Celular</label></TD>
          <TD><p><input type="text" name="celular" id="celular" size="20" value="<?php echo $celular?>"></p> </TD>
          
         <!--<TD><label>Gerencia</label></TD>-->    

            <?php // consulta de los meses
        // Consultar la base de datos
                /*include("db.php");
                $consulta_mysql='select * from mrh_gerencia';
                $resultado_consulta_mysql=mysql_query($consulta_mysql);
                echo "<TD>";
                echo "<select name='mes' id='mes' value='".$descripciongerencia."'>";
                    while($fila=mysql_fetch_array($resultado_consulta_mysql)){
                        echo "<option value='".$fila['codigoalias']."'>".$fila['descripcion']."</option>";
                    }
                echo "</select>";
                echo "</TD>";*/
             ?> 
	 </TR>
	 <TR>
		  <TD><label>Estado Civil</label></TD>
		  <TD>
			<select id="estadocivil" name="estadocivil" value="<?php echo $estadocivil?>">
                                <option value="0" <?php if($estadocivil == '0'){echo('selected');}?>>--------</option>
				<option value="C" <?php if($estadocivil == 'C'){echo('selected');}?>>Casado(a)</option>
				<option value="S" <?php if($estadocivil == 'S'){echo('selected');}?>>Soltero(a)</option>
				<option value="D" <?php if($estadocivil == 'D'){echo('selected');}?>>Divorciado(a)</option>
				<option value="V" <?php if($estadocivil == 'V'){echo('selected');}?>>Viudo(a)</option>
			</select> 
		  </TD>
                  <TD><label>Perioricidad</label></TD>
          <TD>
			<select id="perioricidad" name="codigoperioricidad" ">
				<option value="0" <?php if($codigoperioricidad == '0'){echo('selected');}?>>---------</option>
				<option value="H" <?php if($codigoperioricidad == 'H'){echo('selected');}?>>Horaria</option>
				<option value="S" <?php if($codigoperioricidad == 'S'){echo('selected');}?>>Semanal</option>
                                <option value="Q" <?php if($codigoperioricidad == 'Q'){echo('selected');}?>>Quincenal</option>
                                <option value="M" <?php if($codigoperioricidad == 'M'){echo('selected');}?>>Mensual</option>
			</select> 
        </TD>
	 </TR>
        <TR>
            <TD><label>Dirección de Habitación</label></TD>
            <TD><p><input type="text" name="direccionhabitacion" id="direccion" size="40" value="<?php echo $direccionhabitacion?>"></p> </TD>
        </TR>



     <tr>

         <td><label >Vehiculo</label></td>
         <td>
             <select name="vehiculo" id="">
                 <option value="si" <?php if($vehiculo == 'si'){echo("selected");} ?>>si</option>
                 <option value="no" <?php if($vehiculo == 'no'){echo("selected");} ?>>no</option>
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

    <input type="hidden" value="<?php echo($id); ?>" name="id"/>

</TABLE>

<TABLE style="">
    <TR>
        <TD>
           <input type="submit" name="submit" value="Guardar datos" >
        </TD>
        <TD>
            <a href="empleados_ver.php"><input type="button" value="Atras"></a> 
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
