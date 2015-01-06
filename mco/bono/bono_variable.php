<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 16/10/14
 * Time: 10:33 AM
 */
?>

<?php

header("Content-Type: text/html;charset=utf-8");
ini_set('display_errors', 'On');
ini_set('display_errors', 1);

require_once('../../db.php');



if(isset($_POST['submit'])){



    require_once('../../clases/Validate.php');
    require_once('../../clases/funciones.php');

    $validation = array(

        array('nombre' => 'codigo_empleado_hi',
            'requerida' => true,
        ),

        array('nombre' => 'valor',
            'requerida' => false,
            'regla' => 'number'),



    );



    $validated = new Validate($validation,$_POST);
    $validated->validate();



    if(!$validated->getIsError()){

        $codigo = $_POST['codigo_empleado_hi'];
        $valor = $_POST['valor'];
        $periocidad = $_POST['periocidad'];

        $sql = "SELECT count(*)  total FROM mno_new_bono_variable WHERE codigo_empleado = '$codigo'";

        $result = mysql_query($sql);

        $test = mysql_fetch_array($result);

        $total =  $test['total'];

        if($total == '0'){
            $sql = "INSERT INTO mno_new_bono_variable(valor,codigo_empleado,periocidad) VALUES ('$valor','$codigo','$periocidad')";

            mysql_query($sql) or die('insert '.mysql_error());
        }else{
            $sql = "UPDATE mno_new_bono_variable SET valor = '$valor',periocidad = '$periocidad' WHERE codigo_empleado = '$codigo'";
            mysql_query($sql) or die('update '.mysql_error());
        }


        send_error_redirect(false,'Datos Guardados Exitosamente');
        die;

    }else if($validated->getIsError()){

        send_error_redirect(true,"Hay Errores en la Información del formulario");die;
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

            $("#buscar_empleado").click(function() {
                var win = window.open("buscar_empleado.php", "nuevo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=900, height=600,left=200,top=90 ");
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
                                    <td><label>Empleado (*)</label></td>
                                    <td>
                                        <input type="text" name="cedula"  disabled>
                                        <input type="button" name="buscar_empleado" id="buscar_empleado" value="Buscar"/>

                                    </td>
                                    <input type="hidden" name="codigo_empleado_hi" id="codigo_empleado_hi"/>
                                </tr>


                                <tr>
                                    <td>
                                        <label>Periocidad</label>
                                    </td>
                                    <td>
                                        <select name="periocidad" id="periocidad">
                                            <option value="7" >Semanal</option>
                                            <option value="0" >Quinceal</option>
                                            <option value="1" >Mensual</option>
                                            <option value="2">Bimestral</option>
                                            <option value="3">Trimestral</option>
                                            <option value="4">Cuatrmestral</option>
                                            <option value="5">Semestral</option>
                                            <option value="6">Anual</option>
                                        </select>
                                    </td>
                                </tr>



                                <tr>
                                    <td><label > Valor </label></td>
                                    <td>
                                        <input type="text" name="valor"/>


                                    </td>
                                </tr>


                                <!-- leonel -->


                            </TABLE>

                            <br/>
                            <table>
                                <tr>
                                    <td><input type="submit" value="Guardar datos" name="submit"></td>
                                    <td><a href="../../mco_menu.php"><input type="button" value="Atras"></a> </td>

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