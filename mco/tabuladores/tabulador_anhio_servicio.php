<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 01/10/14
 * Time: 02:09 AM
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

        array('nombre' => 'valor',
            'requerida' => true,
            'regla' => 'float',
            'tipo' => ','),

        array('nombre' => 'paso',
            'requerida' => true,
            'regla' => 'number'),


        array('nombre' => 'hasta',
            'requerida' => true,
            'regla' => 'number'),

    );



    $validated = new Validate($validation,$_POST);
    $validated->validate();



    if(!$validated->getIsError()){

        $valor = $_POST['valor'];
        $paso = $_POST['paso'];
        $hasta = $_POST['hasta'];


        $sql = "INSERT INTO  mco_tabulador_anhio_servicio(paso,valor,referencia) VALUES
        ('$paso','$valor','$hasta')";

        mysql_query($sql) or die('error agregar revicion de vehiculo'.mysql_error());


        send_error_redirect(false);
        die;

    }else if($validated->getIsError()){

        send_error_redirect(true);
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
    <link href="../../js/jquery-ui-1.11.0.custom/jquery-ui.css" rel="stylesheet">
    <script src="../../js/jquery-ui-1.11.0.custom/external/jquery/jquery.js"></script>
    <script src="../../js/jquery-ui-1.11.0.custom/jquery-ui.js"></script>


    <script type="text/javascript">
        $(function () {



            $("#reiniciar").click(function() {

                $("#dialog").dialog({
                    modal: true,
                    title: 'Reinicar Tabulador',
                    resizable: true,
                    autoOpen: true,
                    width: 'auto',

                    buttons: {
                        Yes: function () {
                            // $(obj).removeAttr('onclick');
                            // $(obj).parents('.Parent').remove();

                            $(this).dialog("close");

                            var parametros = { codigo : 'yes' };

                            $.ajax({
                                data:  parametros,
                                url:   'reiniciar_tabulador_anhio_servicio.php',
                                type:  'post',
                                beforeSend: function () {

                                },
                                success:  function (response) {
                                    location.reload();
                                }
                            });
                        },
                        No: function () {
                            $(this).dialog("close");

                        }
                    }

                });

            });//end  dalogo
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
                <div id="dialog" style="display: none"><p>Esta Seguro de Reinicar el Tabulador</p></div>

                <div id="">
                    <div id="firefoxbug"><!-- firefoxbug -->
                        <!-- <div id="blue_line"></div>-->
                        <div class="dynamicContent" align="left">
                            <!--  <h1>Inicio</h1>-->
                            <!--<p><a href="seleccion_sicap.html" class="main-site">Principal</a></p>-->
                            <h1><img src="../../images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong>                Módulo de Configuración | Tabulador de Años de Servicio</strong></h1>
                            <br/>

                            <TABLE BORDER="0" CELLSPACING="10" >

                                <tr>
                                    <td><label > Condición </label></td>

                                </tr>

                                <tr>
                                    <td><label > Desde </label></td>
                                    <td>
                                        <input type="text" name="paso"/>

                                    </td>
                                </tr>

                                <tr>
                                    <td><label > Hasta </label></td>
                                    <td>
                                        <input type="text" name="hasta"/>

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


                            <table border=none class="tablas-nuevas" style="margin-left:  0px">

                                <tr id="tmp" style="text-align: center">
                                    <th>Condiciones</th>
                                    <th>Valor</th>
                                </tr>


                                <?php

                                $sql = "SELECT COUNT(*) as cuenta FROM mco_tabulador_anhio_servicio";
                                $result=mysql_query($sql);
                                $test = mysql_fetch_array($result);

                                $cuenta =  $test['cuenta'];

                                if($cuenta != 0){

                                }


                                $sql = "SELECT * FROM mco_tabulador_anhio_servicio ORDER BY paso*1 ASC ";

                                $result=mysql_query($sql);
                                while( $test = mysql_fetch_array($result)){

                                    echo("<tr>");

                                    echo("<td>".$test['paso']. "&nbsp;&nbsp;&nbsp;  A &nbsp;&nbsp;&nbsp;"  .$test['referencia']. "</td>");
                                    echo("<td>".$test['valor']."</td>");

                                    echo("</tr>");
                                }

                                ?>

                            </table>


                            <br/>


                            <table>
                                <tr>
                                    <td><input type="submit" value="Agregar Paso" name="submit"></td>
                                    <td><input type="button" value="Reiniciar Tabulador" id="reiniciar"> </td>
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
