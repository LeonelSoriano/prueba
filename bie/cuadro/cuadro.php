<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 18/09/14
 * Time: 11:56 PM
 */


// TODO haces q busqe los kilometros y las unidades para q el cuadro calcule  los proximos matenimentos

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html >
<head>
    <title>SICAP | Sistema Integral de Costos</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <link href="../../css/helper.css" media="screen" rel="stylesheet" type="text/css" />
    <script src="../../js/htmlDatePicker.js" type="text/javascript"></script>

    <link href="../../css/stylesheet.css" rel="stylesheet" type="text/css" />

    <script src="../../js/jquery-1.10.2.js"></script>
    <!-- / END -->

    <script>

        $(function(){


            $("#buscar_bien").click(function() {
                codigo_tipo = $("#codigo_bien_tipo_hi").val();
                var win = window.open("buscar_bien.php", "nuevo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=900, height=600,left=200,top=90 ");
                win.focus();

                win.onbeforeunload = function(){



                    var tipo = $("#tipo_hi").val();

                    var codigo = $("#codigo_hi").val();

                    var parametros = { codigo : codigo,
                                       tipo: tipo};

                    $.ajax({
                        data:  parametros,
                        url:   'ajax_cuadro.php',
                        type:  'post',
                        beforeSend: function () {
                            $("#resultado").html('<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' +
                            '<img src="../../images/ajax-loader.gif" alt="Ajax Cargando" height="42" width="42">');
                        },
                        success:  function (response) {
                            $("#tabla_nueva").html(response);
                        }
                    });



                }

            });



        });

    </script>

</head>
<body class="flickr-com">


<form method="post" name="formulario">

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
                <h1><img src="../../images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong>                Módulo de Bienes | Ver Informaciones</strong></h1>
                <br/><br/>

                <table >
                    <tr><input type="text" placeholder="Bien" name="nombre_bien" disabled/> <input type="button" value="Buscar" id="buscar_bien"/></tr>
                    <input type="hidden" id="codigo_hi" name="codigo_hi"/>
                    <input type="hidden" id="tipo_hi" name="tipo_hi"/>
                </table>
                <br/>
<!---->
                <table border=none class="tablas-nuevas" style="text-align: center" id="tabla_nueva">
<!---->
<!--                    <tr id="tmp">-->
<!--                        <th>Nombre de Origen</th>-->
<!--                        <th>Nombre de Llegada</th>-->
<!--                        <th>Distancia (Km.)</th>-->
<!---->
<!--                        <th></th>-->
<!---->
<!---->
<!--                    </tr>-->
<!--                    <tr>-->
<!--                        --><?php
//                        include("../../db.php");
//                        $result=mysql_query("SELECT * FROM bie_rutas WHERE eliminado = 'n'");
//                        while($test = mysql_fetch_array($result)){
//
//                            $id = $test['codigo'];
//                            $origen_codigo_google = $test['origen_codigo_google'];
//                            $distancia = $test['distancia'];
//                            $llegada_codigo_google = $test['llegada_codigo_google'];
//
//                            $nombre_completo = $primer_nombre . ' ' . $segundo_nombre . ' ' . $apellido;
//
//                            echo "<tr align='center'>";
//                            echo"<td><font color='black'>". $origen_codigo_google . "</font></td>";
//                            echo"<td><font color='black'>". $llegada_codigo_google. "</font></td>";
//                            echo"<td><font color='black'>". $distancia. "</font></td>";
//
//                            echo"<td> <a href ='ruta_del.php?id=$id'>Borrar</a></td>";
//                            echo "</tr>";
//                        }
//                        mysql_close($conn);
//                        ?>
<!--                    </tr>-->

                </table>
                <br/>
                <a href="../../bie_menu.php"><input type="button" value="Atras"></a>
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