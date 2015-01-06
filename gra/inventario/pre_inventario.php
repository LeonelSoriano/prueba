<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 18/12/14
 * Time: 03:34 PM
 */
?>


<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 16/12/14
 * Time: 11:44 AM
 */


header("Content-Type: text/html;charset=utf-8");
ini_set('display_errors', 'On');
ini_set('display_errors', 1);

include_once('../../clases/Seguridad.php');

$a = new Seguridad();

$a->chekear_session();


require_once('../../db.php');


?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
    <title>SICAP | Sistema Integral de Costos</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="author" content="Leonel Soriano leonelsoriano3@gmail.com" />
    <link href="../../css/helper.css" media="screen" rel="stylesheet" type="text/css" />
    <link href="../../css/stylesheet.css" rel="stylesheet" type="text/css" />
    <script src="../../js/jquery-1.10.2.js"></script>

    <script type="text/javascript">

        $(function() {

            $("#buscar_departamento").click(function() {
                var win = window.open("buscar_departamento.php", "nuevo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=900, height=600,left=200,top=90 ");
                win.focus();
            });

        });



    </script>


</head>


<body class="flickr-com">


<form method="post" accept-charset="UTF-8" name="formulario" action="inventario.php">

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


                            <h1><img src="../../images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong>                Módulo de Gráficos | Grafico de Inventarios</strong></h1>
                            <br/>


                            <br/>
                            <TABLE BORDER="0" CELLSPACING="10" >

                            <tr>
                                <td>


                                    <label for="">Torta 2D</label>  <input type="radio" name="chart" value="pie2d" checked/><br/><br/>
                                    <label for="">Torta 3D</label> <input type="radio" name="chart" value="pie3d" /><br/><br/>
                                    <label for="">Barra Valores</label> <input type="radio" name="chart" value="bar_value" /><br/><br/>
                                    <label for="">Barra Porcentaje</label> <input type="radio" name="chart" value="bar_porcent" />

<!--                                    <input type="hidden" name="pie2d" value="off"/>-->

                                </td>
                            </tr>



                            </TABLE>

                            <table>

                                <tr>
                                    <td><input type="submit" value="Generar Reporte" name="submit" ></td>
                                    <td><a href="../../gra_menu.php"><input type="button" value="Atras"></a> </td>

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


<?php

mysql_close($conn);

?>
