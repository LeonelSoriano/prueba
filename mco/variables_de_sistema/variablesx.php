<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 02/10/14
 * Time: 12:13 PM
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

        array('nombre' => 'bono_codigo',
            'requerida' => true,
            'regla' => 'number'),


        array('nombre' => 'valor',
            'requerida' => false,
            'regla' => 'float',
            'tipo' => '.')

    );



    $validated = new Validate($validation,$_POST);
    $validated->validate();



    if(!$validated->getIsError()){

        $bono_codigo = $_POST['bono_codigo'];
        $valor = $_POST['valor'];


        $sql = "UPDATE mno_new_variables SET valor = '$valor'
                  WHERE codigo  = '$bono_codigo'";

        mysql_query($sql) or die('error actualizar kilometros  '.mysql_error());

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
    <script src="../../js/jquery-1.10.2.js"></script>

    <script type="text/javascript">

        $(function() {


            $('#bono').bind('change',function() {
                var optionSelected = $("option:selected", this);
                var valueSelected = this.value;
                var codigo = valueSelected;


                var parametros = { codigo : codigo};

                $.ajax({
                    data:  parametros,
                    url:   'ajax_variable.php',
                    type:  'post',
                    dataType: "json",
                    beforeSend: function () {
                        $("#resultado").html('<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' +
                        '<img src="../../images/ajax-loader.gif" alt="Ajax Cargando" height="42" width="42">');
                    },
                    success:  function (response) {
                        //$("#respuesta").html(response);
                        //$("#valor").val(response);
                        //alert(response['valor']);
                        $("#valor").val(response['valor']);


                    }
                });


            });



            var codigo = $("#bono").val();
            var parametros = { codigo : codigo};



            $.ajax({
                data:  parametros,
                url:   'ajax_variable.php',
                type:  'post',
                dataType: "json",
                beforeSend: function () {
                    $("#resultado").html('<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' +
                    '<img src="../../images/ajax-loader.gif" alt="Ajax Cargando" height="42" width="42">');
                },
                success:  function (response) {
                    //$("#respuesta").html(response);
                    $("#valor").val(response['valor']);





                }
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
                            <h1><img src="../../images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong>                Módulo de Configuración | Variables de Sistema</strong></h1>
                            <br/>
                            <TABLE BORDER="0" CELLSPACING="10" >


                                <TD><label>Bono</label></TD>
                                <?php // consulta de los meses
                                // Consultar la base de datos

                                $consulta_mysql="SELECT * FROM mno_new_variables WHERE fijo = 'no'
                                    ORDER BY nombre";
                                $resultado_consulta_mysql=mysql_query($consulta_mysql);
                                echo "<TD>";
                                echo "<select name='bono_codigo' id='bono' >";
                                while($fila=mysql_fetch_array($resultado_consulta_mysql)){
                                    echo "<option value='".$fila['codigo']."'>".$fila['nombre']."</option>";
                                }
                                echo "</select>";
                                echo "</TD>";
                                ?>
                                </tr>
                                <!-- leonel -->


                                <tr>
                                    <td><label >Valor</label></td>
                                    <td><input type="text" name="valor" id="valor" /></td>
                                </tr>


                            </TABLE>


                            <div id="respuesta">

                            </div>

                            <br/>
                            <table>
                                <tr>
                                    <td><input type="submit" value="Guardar datos" name="submit"></td>
                                    <td><a href="./variable_ver.php"><input type="button" value="Ver"></a> </td>
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