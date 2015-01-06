<?php



header("Content-Type: text/html;charset=utf-8");
ini_set('display_errors', 'On');
ini_set('display_errors', 1);


require_once('../../clases/Seguridad.php');



$a = new Seguridad();

$a->chekear_session();

if($_SESSION['usuario'] != 'root'){
    $url = "http" . (($_SERVER['SERVER_PORT']==443) ? "s://" : "://") . $_SERVER['HTTP_HOST'] . '/sicap/seg_menu.php';
    header('Location: ' .$url);
}


require_once('../../db.php');



if(isset($_POST['submit'])){


    require_once('../../clases/Validate.php');
    require_once('../../clases/funciones.php');

    $validation = array(

        array('nombre' => 'nombre_cuenta',
            'requerida' => true
        ),

        array('nombre' => 'permiso_cuenta',
            'requerida' => true
        ),

        array('nombre' => 'clave_cuenta',
            'requerida' => true
        )

    );



    $validated = new Validate($validation,$_POST);
    $validated->validate();



    if(!$validated->getIsError()){

        $nombre_cuenta = $_POST['nombre_cuenta'];
        $permiso_cuenta = $_POST['permiso_cuenta'];
        $clave_cuenta = $_POST['clave_cuenta'];

        $sql = "INSERT INTO seg_usuario
          (nombre,clave,permiso)
          VALUES
          ('$nombre_cuenta','$permiso_cuenta','$clave_cuenta')";

        mysql_query($sql) or die('error agregar revicion de vehiculo'.mysql_error());

        send_error_redirect(false,'Usuario Creado con Exito');
    }else if($validated->getIsError()){

        send_error_redirect(true,'Error en Guardar Infromación');
    }
}



?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <title>SICAP | Sistema Integral de Costos</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="author" content="Leonel Soriano leonelsoriano3@gmail.com" />
    <link href="../../css/helper.css" media="screen" rel="stylesheet" type="text/css" />
    <link href="../../css/stylesheet.css" rel="stylesheet" type="text/css" />
    <script src="../../js/jquery-1.10.2.js"></script>

    <script type="text/javascript">

        $(function() {

            $("#buscar_vehiculo").click(function() {
                var win = window.open("buscar_vehiculo.php", "nuevo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=900, height=600,left=200,top=90 ");
                win.focus();
            });

        });

    </script>

</head>


<body class="flickr-com">


<form method="post" accept-charset="UTF-8" name="formulario">

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
                            <TABLE BORDER="0" CELLSPACING="10" >

                                <tr>
                                    <td><label>Nombre</label></td>
                                    <td>
                                        <input type="text" name="nombre_cuenta"  >
                                    </td>

                                </tr>

                                <tr>
                                    <td><label > Permiso </label></td>
                                    <td>
                                        <input type="text" name="permiso_cuenta"  >
                                    </td>
                                </tr>


                                <tr>
                                    <td><label > Clave </label></td>
                                    <td>
                                        <input type="password" name="clave_cuenta"  >
                                    </td>
                                </tr>

                                <!-- leonel -->


                            </TABLE>

                            <br/>
                            <table>
                                <tr>
                                    <td><input type="submit" value="Guardar datos" name="submit"></td>
                                    <td><a href="./ver_cuentas?paso=0"><input type="button" value="Ver Cuentas"></a> </td>
                                    <td><a href="../../seg_menu.php"><input type="button" value="Atras"></a> </td>

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
