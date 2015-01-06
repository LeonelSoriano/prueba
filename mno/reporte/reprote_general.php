<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 30/09/14
 * Time: 10:03 AM
 */

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


</head>


<body class="flickr-com">




<form method="get" action="../../mno_sueldo_reprote_general.php" accept-charset="UTF-8" name="formulario">

    <div id="body_bottom_bgd">
        <div id="">

            <div align="justify" id="right_col" >

                <div id="header">
                </div>

                <div id="">
                    <div id="firefoxbug"><!-- firefoxbug -->
                        <!-- <div id="blue_line"></div>-->
                        <div class="dynamicContent" align="left">
                            <!--  <h1>Inicio</h1>-->
                            <!--<p><a href="seleccion_sicap.html" class="main-site">Principal</a></p>-->
                            <h1><img src="../../images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong>                Módulo de Nomina | Reporte General de Sueldo</strong></h1>
                            <br/>
                            <TABLE BORDER="0" CELLSPACING="10" >


                                <TD><label>Año</label></TD>
                                <TD>
                                    <select name='anhio' id="anhio" >

                                        <?php $anhio = date('Y');
                                        echo('<option value="'.($anhio -3).'">'.($anhio -3).'</option>');
                                        echo('<option value="'.($anhio -2).'">'.($anhio -2).'</option>');
                                        echo('<option value="'.($anhio -1).'">'.($anhio -1).'</option>');
                                        echo('<option value="'.($anhio).'"selected>'.($anhio).'</option>');
                                        echo('<option value="'.($anhio + 1).'">'.($anhio + 1).'</option>');
                                        ?>
                                    </select>
                                </TD>



                                <TD><label>Mes</label></TD>
                                <?php // consulta de los meses
                                // Consultar la base de datos
                                include("../../db.php");
                                $consulta_mysql='select * from mrh_mes';
                                $resultado_consulta_mysql=mysql_query($consulta_mysql);
                                echo "<TD>";
                                echo "<select name='mes' id='mes' onChange='cargasemana(this.value)'>";
                                echo "<option value='0'>------</option>";
                                while($fila=mysql_fetch_array($resultado_consulta_mysql)){
                                    echo "<option value='".$fila['codigo']."'>".$fila['descripcion']."</option>";
                                }
                                echo "</select>";
                                echo "</TD>";
                                ?>



                                <!-- leonel -->

                            </TABLE>

                            <br/>
                            <table>
                                <tr>
                                    <td><input type="submit" value="Generar Reporte" name="submit"></td>
                                    <td><a href="../../mno_menu.html"><input type="button" value="Atras"></a> </td>

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

            <p>&nbsp; </p>
            <div class="clearboth"></div>
        </div>
        <div align="center" class="pie">SICAP 2014</div>
    </div>




</form>

</body>
</html>