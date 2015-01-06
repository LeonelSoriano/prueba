<?php

include_once('../../clases/Seguridad.php');

$a = new Seguridad();

$a->chekear_session();

?>

<?php

ini_set('display_errors', 'On');
ini_set('display_errors', 1);

require_once ('../../db.php');

$nombre = '';
$codigo = '';

if(isset($_GET['codigo']))
{
    $codigo = $_GET['codigo'];

    $sql = "SELECT * FROM cos_erogaciones WHERE codigo='$codigo'";

    $result=mysql_query($sql);
    $test = mysql_fetch_array($result);


    $nombre = $test['nombre'];

}else{

    header('Location: '.$_SERVER['HTTP_REFERER']);
}


$error =  true;



if (isset($_POST['submit'])){



    require_once('../../clases/Validate.php');

    $nombre = $_POST['nombre'];
    $codigo_hi = $codigo['codigo_hi'];


    $validations = array(
        array('nombre' => 'nombre',
            'requerida' => true),

        array('nombre' => 'codigo_hi',
            'requerida' => true),

    );

    $validated = new Validate($validations,$_POST);
    $validated->validate();

    if(!$validated->getIsError()){

        $sql = "UPDATE  cos_erogaciones SET nombre='$nombre' WHERE codigo='$codigo_hi'";

        $result = mysql_query($sql);

        if (!$result){
            die("Error: Data not found.. de agregar erogaciones");
        }

        $current_url = explode("?", $_SERVER['REQUEST_URI']);

        header('Location: '.$current_url[0].'?'.$current_url[1].'&error=false');
        exit();

    }

    $current_url = explode("?", $_SERVER['REQUEST_URI']);

    header('Location: '.$current_url[0].'?'.$current_url[1].'&error=true');
    header('Location: '.' asdsa' );
    exit();

}



?>


<!DOCTYPE html>
<html>
<head lang="es">
    <title>SICAP | Sistema Integral de Costos</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="author" content="Tomas Bagdanavicius, http://www.lwis.net/free-css-drop-down-menu/" />
    <meta name="keywords" content=" css, dropdowns, dropdown menu, drop-down, menu, navigation, nav, horizontal, vertical left-to-right, vertical right-to-left, horizontal linear, horizontal upwards, cross browser, internet explorer, ie, firefox, safari, opera, browser, lwis" />
    <meta name="description" content="Clean, standards-friendly, modular framework for dropdown menus" />
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
<!--<p><a href="mrh_menu.html" class="main-site">Principal</a></p>-->
<!--<h1><img src="images/seleccion_sicap_archivos/image002.jpg" alt="flickr" />Módulo de Recursos Humanos | Cargo</h1>-->
<!-- Beginning of compulsory code below -->
<form method="post" name="nueva_erogacion" enctype="multipart/form-data">
    <div id="body_bottom_bgd">
        <div id=""> <!--<img src="images/Logo_Inventario.png"/>-->
            <!--</div>--> <!-- Menu -->
            <!-- ?php include 'include/nav.php'; ?>-->
            <div align="justify" id="right_col" >

                <?php

                if ( isset($_GET['error'])){

                    if($_GET['error'] == 'false'){
                        echo('<div id="done_app"><marquee scrolldelay="100">Datos Guardados Correctamente</marquee></div>');
                    }else{
                        echo('<div id="error_app"><marquee scrolldelay="120">El Campo Nombre es Requerido</marquee></div>');
                    }
                }

                ?>


                <div id="header">
                </div>
                <div id="">
                    <div id="firefoxbug"><!-- firefoxbug -->
                        <!-- <div id="blue_line"></div>-->
                        <div class="dynamicContent" align="left">
                            <!-- <h1>Inicio</h1>-->
                            <!--<p><a href="seleccion_sicap.html" class="main-site">Principal</a></p>-->
                            <h1><img src="../../images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong> Módulo de Inventario | Costos y Gastos</strong></h1>

                            <!-- Beginning of compulsory code below -->
                            <br/><br/>
                            <TABLE BORDER="0" CELLSPACING="4" WIDTH="500">

                                <TR>
                                    <TD><label>Nombre</label></TD>
                                    <TD><p><input type="text" name="nombre" size="20" value="<?php echo($nombre); ?>"></p></TD>
                                    <input type="hidden" name="codigo_hi" value="<?php echo($codigo); ?>"/>
                                </TR>


                            </TABLE>
                            <br/>

                            <table>
                                <tr>
                                    <td>
                                        <input type="submit" value="Guardar datos" name="submit">
                                    </td>
                                    <td>
                                        <a href="erogacion_ver.php"><input type="button" value="Ver Datos"></a>
                                    </td>


                                    <td>
                                        <a href="../../cos_menu.php"><input type="button" value="Atras"></a>
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
