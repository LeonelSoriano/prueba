<?php

include_once('clases/Seguridad.php');

$a = new Seguridad();

$a->chekear_session();

?>


<?php

header("Content-Type: text/html;charset=utf-8");
ini_set('display_errors', 'On');
ini_set('display_errors', 1);
include_once('db.php');

if (isset($_POST['submit']))
{



    include_once('./clases/funciones.php');
    include_once('./clases/Validate.php');
   // $cedulaempleado=$_POST['cedulaempleado'];
    $cedula=$_POST['cedula'];
    $id = $_POST['id'];
    $primernombre=$_POST['primernombre'];
    $segundonombre=$_POST['segundonombre'];
    $primerapellido=$_POST['primerapellido'];
    $segundoapellido=$_POST['segundoapellido'];
    $fechanacimiento=$_POST['fechanacimiento'];
    $parentesco=$_POST['parentesco'];
    $estudios=$_POST['estudios'];

    $validation = array(

        array('nombre' => 'cedula',
            'requerida' => true,
            'regla' => 'number'),

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


        array('nombre' => 'fechanacimiento',
            'requerida' => true
        )

    );

    $validated = new Validate($validation,$_POST);
    $validated->validate();

    if(!$validated->getIsError()){


        $sql = "insert into mrh_carga(cedulaempleado,cedula,primernombre,segundonombre,primerapellido,
                            segundoapellido,fechanacimiento,parentesco,estudios)
                values ('$id','$cedula','$primernombre','$segundonombre','$primerapellido',
                        '$segundoapellido','$fechanacimiento','$parentesco','$estudios')";

        mysql_query($sql) or die('No se pudo guardar la información. '.mysql_error());

        $current_url = explode("?", $_SERVER['REQUEST_URI']);

        $primer_parametro = explode("&",$current_url[1]);
        header('Location: '.$current_url[0].'?'.$primer_parametro[0].'&error=false&msg=Datos Guardados Exitosamente');
        mysql_close($conn);

        die;

    }else if($validated->getIsError()){

        mysql_close($conn);
        $current_url = explode("?", $_SERVER['REQUEST_URI']);

        $primer_parametro = explode("&",$current_url[1]);

        header('Location: '.$current_url[0].'?'.$primer_parametro[0].'&error=true&msg=Hay Errores en la Información del formulario');
        die;
    }


}
?>

<?php


    $id =$_GET['codigo'];
    $result = mysql_query("SELECT cedula,primernombre,primerapellido FROM mrh_empleado WHERE codigo  = '$id'");
    $test = mysql_fetch_array($result);
    if (!$result)
    {
        die("Error: Data not found..");
    }
    $cedulaempleado = $test['cedula'];
    $primernombre = $test['primernombre'];
    $primerapellido = $test['primerapellido'];


?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
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
        $( "#datepicker2" ).datepicker({ dateFormat: 'yy-mm-dd',changeYear: true, yearRange: "-100:+0"});
        $( "#datepicker3" ).datepicker({ dateFormat: 'yy-mm-dd',changeYear: true, yearRange: "-100:+0"});
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


 <TABLE BORDER="0" >

    <TR>
          <TD><label>Cédula de Empleado</label></TD>
          <TD><p><input type="text" name="cedulaempleado" id="cedulaempleado" size="20"  value = <?php echo($cedulaempleado) ?> disabled></p></TD>
          <TD><p><input type="text" name="primernombre" id="primernombre" size="20"  value = <?php echo($primernombre) ?> disabled></p></TD>
          <TD><p><input type="text" name="primerapellido" id="primerapellido" size="20"  value = <?php echo($primerapellido) ?> disabled></p></TD>
        <input type="hidden" name="id" value="<?php echo($_GET['codigo']); ?>"/>

    </TR> 
    <TR>
          <TD><label>Cédula</label></TD>
          <TD><p><input type="text" name="cedula" id="cedula" size="20" ></p></TD>
    </TR> 
    <TR>
          <TD><label>Primer Nombre</label></TD>
          <TD><p><input type="text" name="primernombre" id="primernombre" size="20"></p> </TD>

          <TD><label>Segundo Nombre</label></TD>
          <TD><p><input type="text" name="segundonombre" id="segundonombre" size="20"></p> </TD>
    </TR>
	 <TR>
          <TD><label>Primer Apellido</label></TD>
          <TD><p><input type="text" name="primerapellido" id="primerapellido" size="20"></p> </TD>

          
          <TD><label>Segundo Apellido</label></TD>
          <TD><p><input type="text" name="segundoapellido" id="segundoapellido" size="20"></p> </TD>
    </TR>
    <TR>
          <TD class="firefox"><label>Fec. de Nacimiento</label></TD>
	  <TD><p><input type="text" id="datepicker2" name="fechanacimiento"></p></TD>

          <TD><label>Parentesco</label></TD>
          <TD>
			<select id="parentesco" name="parentesco">
				<option value="0">---------</option>
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
			<select id="estudios" name="estudios">
                                <option value="0">--------</option>
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
            <td><input type="submit" value="Agregar Cargar" name="submit"></td>
            
            <td><a href ="carga_ver.php?codigo=<?php echo($_GET['codigo']); ?>"><input type="button" value="Ver Carga"></a></td>

            <td><a href="empleados_ver.php"><input type="button" value="Atras"></a></td>
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

<?php

mysql_close($conn);

?>