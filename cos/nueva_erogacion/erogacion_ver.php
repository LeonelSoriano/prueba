<?php

include_once('../../clases/Seguridad.php');

$a = new Seguridad();

$a->chekear_session();

?>

<?php
header("Content-Type: text/html;charset=utf-8");
include("../../db.php");
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html >
<head>
    <title>SICAP | Sistema Integral de Costos</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="author" content="Tomas Bagdanavicius, http://www.lwis.net/free-css-drop-down-menu/" />
    <meta name="keywords" content=" css, dropdowns, dropdown menu, drop-down, menu, navigation, nav, horizontal, vertical left-to-right, vertical right-to-left, horizontal linear, horizontal upwards, cross browser, internet explorer, ie, firefox, safari, opera, browser, lwis" />
    <meta name="description" content="Clean, standards-friendly, modular framework for dropdown menus" />
    <link href="../../css/helper.css" media="screen" rel="stylesheet" type="text/css" />
    <script src="../../js/htmlDatePicker.js" type="text/javascript"></script>

    <link href="../../css/stylesheet.css" rel="stylesheet" type="text/css" />


    <script src="../../js/jquery-1.10.2.js"></script>
    <script src="../../js/jquery-ui-1.10.4.custom.js"></script>


    <!-- / END -->

    <script>

        $(function(){


            var codigo = "";

            $('#inventario').bind('change',function(){
                var optionSelected = $("option:selected", this);
                var valueSelected = this.value;
                codigo = valueSelected;

                var parametros = { codigo : codigo };

                $.ajax({
                    data:  parametros,
                    url:   'ajax_ver_inventarios.php',
                    type:  'post',
                    beforeSend: function () {
                        $("#resultado").html('<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' +
                            '<img src="../../images/ajax-loader.gif" alt="Ajax Cargando" height="42" width="42">');
                    },
                    success:  function (response) {
                        $("#tabla_nueva").html(response);
                    }
                });


            });

        });


    </script>


</head>
<body class="flickr-com">

<form method="post" name="inventario_ver">

    <div id="body_bottom_bgd">
        <div id=""> <!--<img src="images/Logo_Inventario.png"/>-->
            <!--</div>-->                <!-- Menu -->
            <!--  ?php include 'include/nav.php'; ?>-->
            <div align="justify" id="right_col" style="width: 80%">
                <div id="header">
                </div>
                <div id="">
                    <div id="firefoxbug"><!-- firefoxbug -->
                        <!-- <div id="blue_line"></div>-->
                        <div class="dynamicContent" align="left">
                            <!--  <h1>Inicio</h1>-->
                            <!--<p><a href="seleccion_sicap.html" class="main-site">Principal</a></p>-->
                            <h1><img src="../../images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong>                Módulo de Inventario | Productos y servicios</strong></h1>



                            <br/><br/>
                            <table border=none class="tablas-nuevas" id="tabla_nueva">

                                <tr style="text-align: center">

                                    <th>Nombre de Erogación</th>
                                    <th></th>
                                    <th></th>

                                </tr>

                                <tr>
                                    <?php

                                    $sql = "SELECT * FROM cos_erogaciones
GROUP BY nombre
ORDER BY nombre";

                                    $result=mysql_query($sql);
                                    while($test = mysql_fetch_array($result)){

                                        $id = $test['codigo'];
                                        $nombre = $test['nombre'];
                                        echo "<tr>";
                                        echo "<td><font color='black'>". $nombre . "</font></td>";

                                        echo"<td> <a href ='erogacion_mod.php?codigo=$id'>Modificar</a></td>";
                                        echo"<td> <a href ='erogacion_del.php?codigo=$id'>Eliminar</a></td>";
                                        echo "</tr>";
                                    }

                                    echo "</tr>";

                                    ?>
                                </tr>


                            </table>
                            <br/><br/><br/>
                            <a href="nueva_erogacion.php"><input type="button" value="Atras"></a>
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