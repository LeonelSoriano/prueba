<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 02/10/14
 * Time: 01:19 PM
 */

include("../../db.php");
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html >
<head>
    <title>SICAP | Sistema Integral de Costos</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="author" content="Leonel Soriano leonelsoriano3@gmail.com" />
    <link href="../../css/helper.css" media="screen" rel="stylesheet" type="text/css" />
    <script src="../../js/htmlDatePicker.js" type="text/javascript"></script>

    <link href="../../css/stylesheet.css" rel="stylesheet" type="text/css" />

    <!-- / END -->

</head>
<body class="flickr-com">

<!--<p><a href="mrh_menu.html" class="main-site">Principal</a></p>-->

<!--<h1><img src="images/flickr.com/icon.png" alt="flickr" />Módulo de Recursos Humanos | Listado de Turnos</h1>-->

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
                            <h1><img src="../../images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong>                Módulo de Configuración | Variables Ver</strong></h1>
                            <br/>

                            <div >
                                <h1 >
                                <?php
                                $result=mysql_query("SELECT * FROM mno_new_variables_tipo WHERE codigo = 1;");
                                $test = mysql_fetch_array($result);
                                echo($test['nombre']);
                                echo('   ');
                                echo($test['sub_nombre']);
                                ?>
                                </h1>
                                <br/>

                            </div>


                            <table border=none class="tablas-nuevas" >

                                <tr style="text-align: center">
                                    <th>Nombre</th>
                                    <th>Valor</th>

                                </tr>
                                <tr  >
                                    <?php


                                    $result=mysql_query("SELECT * FROM mno_new_variables WHERE tipo = 1;");
                                    while($test = mysql_fetch_array($result)){

                                        $id = $test['codigo'];


                                        echo "<tr align='center'>";
                                        echo"<td style='text-align: left'>". $test['nombre'] . "</td>";
                                        echo"<td ><font color='black'>". $test['valor'] . "</font></td>";


                                        echo "</tr>";
                                    }

                                    ?>
                                </tr>

                            </table>

                            <br/>



                            <div>
                                <h1>
                                    <?php
                                    $result=mysql_query("SELECT * FROM mno_new_variables_tipo WHERE codigo = 2;");
                                    $test = mysql_fetch_array($result);
                                    echo($test['nombre']);
                                    echo('   ');
                                    echo($test['sub_nombre']);
                                    ?>
                                </h1>
                                <br/>

                            </div>


                            <table border=none class="tablas-nuevas">

                                <tr style="text-align: center">
                                    <th>Nombre</th>
                                    <th>Valor</th>

                                </tr>
                                <tr>
                                    <?php


                                    $result=mysql_query("SELECT * FROM mno_new_variables WHERE tipo = 2;");
                                    while($test = mysql_fetch_array($result)){

                                        $id = $test['codigo'];


                                        echo "<tr align='center'>";
                                        echo"<td style='text-align: left'><font color='black'>". $test['nombre'] . "</font></td>";
                                        echo"<td><font color='black'>". $test['valor'] . "</font></td>";


                                        echo "</tr>";
                                    }

                                    ?>
                                </tr>

                            </table>

                            <br/>




                            <div>
                                <h1>
                                    <?php
                                    $result=mysql_query("SELECT * FROM mno_new_variables_tipo WHERE codigo = 3;");
                                    $test = mysql_fetch_array($result);
                                    echo($test['nombre']);
                                    echo('   ');
                                    echo($test['sub_nombre']);
                                    ?>
                                </h1>
                                <br/>

                            </div>


                            <table border=none class="tablas-nuevas">

                                <tr style="text-align: center">
                                    <th>Nombre</th>
                                    <th>Valor</th>

                                </tr>
                                <tr>
                                    <?php


                                    $result=mysql_query("SELECT * FROM mno_new_variables WHERE tipo = 3;");
                                    while($test = mysql_fetch_array($result)){

                                        $id = $test['codigo'];


                                        echo "<tr align='center'>";
                                        echo"<td style='text-align: left'><font color='black'>". $test['nombre'] . "</font></td>";
                                        echo"<td><font color='black'>". $test['valor'] . "</font></td>";


                                        echo "</tr>";
                                    }

                                    ?>
                                </tr>

                            </table>

                            <br/>



                            <div>
                                <h1>
                                    <?php
                                    $result=mysql_query("SELECT * FROM mno_new_variables_tipo WHERE codigo = 4;");
                                    $test = mysql_fetch_array($result);
                                    echo($test['nombre']);
                                    echo('   ');
                                    echo($test['sub_nombre']);
                                    ?>
                                </h1>
                                <br/>

                            </div>


                            <table border=none class="tablas-nuevas">

                                <tr style="text-align: center">
                                    <th>Nombre</th>
                                    <th>Valor</th>

                                </tr>
                                <tr>
                                    <?php


                                    $result=mysql_query("SELECT * FROM mno_new_variables WHERE tipo = 4;");
                                    while($test = mysql_fetch_array($result)){

                                        $id = $test['codigo'];


                                        echo "<tr align='center'>";
                                        echo"<td style='text-align: left'><font color='black'>". $test['nombre'] . "</font></td>";
                                        echo"<td><font color='black'>". $test['valor'] . "</font></td>";


                                        echo "</tr>";
                                    }

                                    ?>
                                </tr>

                            </table>

                            <br/>





                            <div>
                                <h1>
                                    <?php
                                    $result=mysql_query("SELECT * FROM mno_new_variables_tipo WHERE codigo = 5;");
                                    $test = mysql_fetch_array($result);
                                    echo($test['nombre']);
                                    echo('   ');
                                    echo($test['sub_nombre']);
                                    ?>
                                </h1>
                                <br/>

                            </div>


                            <table border=none class="tablas-nuevas">

                                <tr style="text-align: center">
                                    <th>Nombre</th>
                                    <th>Valor</th>

                                </tr>
                                <tr>
                                    <?php


                                    $result=mysql_query("SELECT * FROM mno_new_variables WHERE tipo = 5;");
                                    while($test = mysql_fetch_array($result)){

                                        $id = $test['codigo'];


                                        echo "<tr align='center'>";
                                        echo"<td style='text-align: left'><font color='black'>". $test['nombre'] . "</font></td>";
                                        echo"<td><font color='black'>". $test['valor'] . "</font></td>";


                                        echo "</tr>";
                                    }

                                    ?>
                                </tr>

                            </table>

                            <br/>


                            <br/>
                            <a href="variables.php"><input type="button" value="Atras"></a>
                            <p></p>
                        </div>
                    </div><!--end firefoxbug-->
                </div><!--end left_bgd-->

            </div>
            <p>
                <!--end right_col-->
            </p>
            <p>&nbsp; </p>
            <div class="clearboth"></div>
        </div>
        <div align="center" class="pie">SICAP 2014</div>
    </div>

    <!-- / END -->

</form>

</body>
</html>