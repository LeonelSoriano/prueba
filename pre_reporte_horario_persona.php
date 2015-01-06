<?php

include_once('clases/Seguridad.php');

$a = new Seguridad();

$a->chekear_session();

?>

<?php

header("Content-Type: text/html;charset=utf-8");
ini_set('display_errors', 'On');
ini_set('display_errors', 1);

require_once('./db.php');





?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <title>SICAP | Sistema Integral de Costos</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="author" content="Leonel Soriano leonelsoriano3@gmail.com" />
    <link href="./css/helper.css" media="screen" rel="stylesheet" type="text/css" />
    <link href="./css/stylesheet.css" rel="stylesheet" type="text/css" />
    <script src="./js/jquery-1.10.2.js"></script>

    <script type="text/javascript">

        $(function() {

            $("#buscar_empleado").click(function() {
                var win = window.open("buscar_emplado_reporte_horario.php", "nuevo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=900, height=600,left=200,top=90 ");
                win.focus();
            });

        });

    </script>

</head>


<body class="flickr-com">


<form method="post" accept-charset="UTF-8" name="formulario" action="./reporte_horario_persona.php">

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
                            <h1><img src="./images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong>                Módulo de Inventario | Empresa</strong></h1>
                            <br/>
                            <TABLE BORDER="0" CELLSPACING="10" >

                                <tr>
                                    <td><label>Buscar Empleado</label></td>
                                    <td>
                                        <input type="text" name="cedula_empleado"  disabled>
                                        <input type="text" name="nombre_empleado"  disabled >
                                        <input type="button" name="buscar_empleado" id="buscar_empleado" value="Buscar"/>

                                    </td>
                                    <input type="hidden" name="codigo_empleado_hi" id="codigo_empleado"/>
                                </tr>

                                <TR>
                                    <TD><label>Año</label></TD>
                                    <TD>
                                        <select name='anhio' id='codigomes' >

                                            <?php $anhio = date('Y');
                                            $anhio_presente = $anhio;
                                            $anhio = $anhio - 10;

                                            for($i = $anhio ; $i < $anhio+20 ;$i++){

                                                if($i == $anhio_presente){
                                                    echo('<option value="'.($i).'"selected>'.($i).'</option>');

                                                }else{
                                                    echo('<option value="'.($i).'">'.($i).'</option>');

                                                }
                                            }

                                            ?>
                                        </select>
                                    </TD>
                                <TR>

                                <tr>
                                    <td><label >Mes</label></td>
                                    <td><select name="mes" id="">
                                        <?php
                                        $sql = "SELECT * FROM mrh_mes";

                                        $result=mysql_query($sql);
                                        echo('<option value="'.'-'.'">'.'-----------'.'</option>');

                                        while($test = mysql_fetch_array($result)){
                                            echo('<option value="'.$test['codigo'].'">'.$test['descripcion'].'</option>');
                                        }

                                        ?></td>
                                    </select>
                                </tr>


                                <!-- leonel -->


                            </TABLE>

                            <br/>
                            <table>
                                <tr>
                                    <td><input type="submit" value="Generar Reporte" name="submit"></td>
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