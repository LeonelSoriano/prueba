<?php

header("Content-Type: text/html;charset=utf-8");
ini_set('display_errors', 'On');
ini_set('display_errors', 1);

require_once ('../../db.php');

?>

<?php


$id =$_REQUEST['codigo'];

$result = mysql_query("SELECT * FROM min_empresa WHERE codigo  = '$id'");

$test = mysql_fetch_array($result);
if (!$result)
{
    die("Error: Data not found..");
}

$codigoalias = $test['codigo_alias'];
$descripcion = $test['descripcion'];
$correo = $test['correo'];
$direccion = $test['direccion'];
$telefono = $test['telefono'];
$rif = $test['rif'];

?>




<?php


if (isset($_POST['submit'])){

    $codigoalias = $_POST['codigoalias'];
    $rif = $_POST['rif'];/*codigo*/
    $descripcion = $_POST['descripcion'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];


    $sql = "UPDATE min_empresa SET codigo_alias='$codigoalias',descripcion='$descripcion',correo='$correo',direccion='$direccion',telefono='$telefono',rif='$rif'  WHERE codigo ='$id'";


    mysql_query($sql) or die('No se pudo guardar la información. '.mysql_error());

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

<form method="post" accept-charset="UTF-8">

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
                            <h1><img src="../../images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong>                Módulo de Inventario | Empresa</strong></h1>

                            <TABLE BORDER="0" CELLSPACING="4" WIDTH="380">
                                <tr>
                                    <td><label>Nombre</label></td>
                                    <TD><p><input type="text" name="codigoalias"  size="20" value="<?php echo($codigoalias) ?>"/></p></TD>
                                </tr>

                                <tr>
                                    <td><label>Código</label></td>
                                    <TD><p><input type="text" name="rif"  size="20"  value="<?php echo($rif) ?>"/></p></TD>
                                </tr>


                                <TR>
                                    <td><label>Descripción</label></td>
                                    <td><p><textarea rows="4" cols="18" name="descripcion" ><?php echo($descripcion) ?></textarea></p></td>
                                </TR>

                                <tr>
                                    <td><label >Correo Eectrónico</label></td>
                                    <td><p><input type="text" name="correo"  size="20"  value="<?php echo($correo) ?>"/></p></td>
                                </tr>
                                <br/>
                                <tr>
                                    <td><label >Dirección</label></td>
                                    <td><p><input type="text" name="direccion"  value="<?php echo($direccion) ?>"/></p></td>
                                </tr>

                                <tr>
                                    <td><label >Teléfono</label></td>
                                    <td><p><input type="text" name="telefono"  value="<?php echo($telefono) ?>"/></p></td>
                                </tr>
                            </TABLE>

                            <br/>
                            <table>
                                <tr>
                                    <td><input type="submit" value="Guardar datos" name="submit"></td>
                                    <td><a href="empresa_ver.php"><input type="button" value="Ver datos"></a> </td>
                                    <td><a href="empresa_ver.php"><input type="button" value="Atras"></a> </td>

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



<!--  guardado este codigo q lo colocare en configuracino -->
<?php

/*<label>Tipo de Empresa</label><br/>
    <div style="margin-left: 135px">


       <?php
       $result = mysql_query("SET NAMES utf8");
        $result=mysql_query("SELECT tipo FROM min_tipo_empresa");
        while($test = mysql_fetch_array($result)){

            echo "<p><input type='checkbox' name='tipo[]' value='". utf8_encode($test['tipo']) . "'/>&nbsp;&nbsp;&nbsp;&nbsp;" .utf8_encode($test['tipo']) ."</p>";

        }

*/
?>

