<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 10/12/14
 * Time: 09:33 AM
 */

ini_set('display_errors', 'On');
ini_set('display_errors', 1);

include_once('../../clases/Seguridad.php');

$a = new Seguridad();

$a->chekear_session();

?>

<?php


$error =  true;


require_once ('../../db.php');

if (isset($_POST['submit'])){



    require_once('../../clases/Validate.php');

    $nombre = $_POST['nombre'];


    $validations = array(
        array('nombre' => 'nombre',
            'requerida' => true),

    );

    $validated = new Validate($validations,$_POST);
    $validated->validate();

    if(!$validated->getIsError()){

        $nombre = $_POST['nombre'];
        $sigla = $_POST['sigla'];

        $codigo_hi = $_POST['codigo_hi'];


        $sql = "UPDATE  mco_unidad_erogacion SET nombre='$nombre',
            sigla='$sigla' WHERE codigo='$codigo_hi'";

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




if(isset($_GET['codigo'])){

    $id = $_GET['codigo'];

    $sql = "SELECT * FROM mco_unidad_erogacion WHERE codigo = '$id'";

    $result = mysql_query($sql);

    $test = mysql_fetch_array($result);

    $nombre = $test['nombre'];
    $sigla = $test['sigla'];

}
?>


<!DOCTYPE html>
<html>
<head lang="es">
    <title>SICAP | Sistema Integral de Costos</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="../../css/helper.css" media="screen" rel="stylesheet" type="text/css" />
    <script src="../../js/htmlDatePicker.js" type="text/javascript"></script>
    <link href="../../css/htmlDatePicker.css" rel="stylesheet">
    <link href="../../css/stylesheet.css" rel="stylesheet" type="text/css" />
    <link href="../../css/ui-lightness/jquery-ui-1.10.4.custom.css" rel="stylesheet">
    <script src="../../js/jquery-1.10.2.js"></script>
    <script src="../../js/jquery-ui-1.10.4.custom.js"></script>

    <!-- Beginning of compulsory code below -->
    <link href="/sicap/css/dropdown/dropdown.css" media="screen" rel="stylesheet" type="text/css" />
    <link href="/sicap/css/dropdown/themes/flickr.com/default.ultimate.css" media="screen" rel="stylesheet" type="text/css" />
    <!-- / END -->

    <script>

        function resetForms() {
            for (var i = 0; i < document.forms.length; i++) {
                document.forms[i].reset();
            }
        }

        $(function(){
            resetForms();
        });
    </script>

</head>
<body class="flickr-com">

<form method="post" name="nueva_erogacion" enctype="multipart/form-data">
    <div id="body_bottom_bgd">
        <div id="">
            <div align="justify" id="right_col" >



                <div id="header">
                </div>
                <div id="">
                    <div id="firefoxbug"><!-- firefoxbug -->
                        <!-- <div id="blue_line"></div>-->
                        <div class="dynamicContent" align="left">
                            <!-- <h1>Inicio</h1>-->
                            <!--<p><a href="seleccion_sicap.html" class="main-site">Principal</a></p>-->
                            <h1><img src="../../images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong> Módulo Costos y Gastos | Agregar Erogacion</strong></h1>

                            <!-- Beginning of compulsory code below -->
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
                                    <TD><label>Nombre</label></TD>
                                    <TD><p><input type="text" name="nombre" size="20" value="<?php echo($nombre); ?>"></p></TD>
                                </TR>

                                <TR>
                                    <TD><label>Sigla(Opcional)</label></TD>
                                    <TD><p><input type="text" name="sigla" size="20" value="<?php echo($sigla); ?>"></p></TD>
                                </TR>

                                <input type="hidden" name="codigo_hi" value="<?php echo($id); ?>"/>
                            </TABLE>
                            <br/>

                            <table>
                                <tr>
                                    <td>
                                        <input type="submit" value="Guardar datos" name="submit">
                                    </td>
                                    <td>
                                        <a href="unidades_erogacion_ver.php"><input type="button" value="Ver Datos"></a>
                                    </td>


                                    <td>
                                        <a href="../../mco_menu.php"><input type="button" value="Atras"></a>
                                    </td>
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
