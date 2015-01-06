<?php
header("Content-Type: text/html;charset=utf-8");


include("../../db.php");
require_once("../../clases/funciones.php");

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

            $('#buscar').click(function(){


                var mes = $( "#mes option:selected" ).val();
                var ano = $( "#ano option:selected" ).val();


                var parametros = { mes : mes, ano : ano };
                $.ajax({
                    data:  parametros,
                    url:   'ajax_erogacion_ver.php',
                    type:  'post',
                    beforeSend: function () {
                        $("#tabla_nueva").html('<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' +
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
                            <h1><img src="../../images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong>                Módulo Costos y Gastos | Ver erogaciones</strong></h1>


                            <br/><br/>
                            <p style="margin-left: 40px">
                                <label>Año</label>


                                    <select name='ano' id="ano"  tyle="margin-right: 25px">

                                        <?php $anhio = date('Y');
                                        echo('<option value="'.($anhio -6).'">'.($anhio -6).'</option>');
                                        echo('<option value="'.($anhio -5).'">'.($anhio -5).'</option>');
                                        echo('<option value="'.($anhio -4).'">'.($anhio -4).'</option>');
                                        echo('<option value="'.($anhio -3).'">'.($anhio -3).'</option>');
                                        echo('<option value="'.($anhio -2).'">'.($anhio -2).'</option>');
                                        echo('<option value="'.($anhio -1).'">'.($anhio -1).'</option>');
                                        echo('<option value="'.($anhio).'"selected>'.($anhio).'</option>');
                                        echo('<option value="'.($anhio + 1).'">'.($anhio + 1).'</option>');
                                        ?>
                                    </select>


                                <label>Mes  </label>

                                <select id="mes" style="margin-right: 18px">
                                    <option value="01">Enero</option>
                                    <option value="02">Febrero</option>
                                    <option value="03">Marzo</option>
                                    <option value="04">Abril</option>
                                    <option value="05">Mayo</option>
                                    <option value="06">Junio</option>
                                    <option value="07">Julio</option>
                                    <option value="08">Agosto</option>
                                    <option value="09">Septiembre</option>
                                    <option value="10">Octubre</option>
                                    <option value="11">Noviembre</option>
                                    <option value="12">Diciembre</option>
                                </select>

                                <input type="button" value="Buscar" id="buscar"/>
                            </p>



                            <br/>
                            <table border=none class="tablas-nuevas" id="tabla_nueva">


                            </table>
                            <br/><br/><br/>
                            <a href="detalle_derogacion.php"><input type="button" value="Atras"></a>
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