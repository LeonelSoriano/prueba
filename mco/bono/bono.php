<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 01/10/14
 * Time: 02:21 PM
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
            'requerida' => true,
            'regla' => 'number'),

    );



    $validated = new Validate($validation,$_POST);
    $validated->validate();



    if(!$validated->getIsError()){

        $bono_codigo = $_POST['bono_codigo'];
        $valor = $_POST['valor'];
        $tipo_pago = $_POST['tipo_pago'];
        $periocidad = $_POST['periocidad'];

        $sql = "UPDATE mno_new_concepto SET valor = '$valor', tipo_forma_pago = '$tipo_pago',
                  tipo_periocidad = '$periocidad'
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
                    url:   'ajax_bono.php',
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

                        $("#tipo_pago").val(response['tipo_pago']);
                        $("#periocidad").val(response['tipo_periocidad']);

                    }
                });


            });



            var codigo = $("#bono").val();
            var parametros = { codigo : codigo};



            $.ajax({
                data:  parametros,
                url:   'ajax_bono.php',
                type:  'post',
                dataType: "json",
                beforeSend: function () {
                    $("#resultado").html('<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' +
                    '<img src="../../images/ajax-loader.gif" alt="Ajax Cargando" height="42" width="42">');
                },
                success:  function (response) {
                    //$("#respuesta").html(response);
                    $("#valor").val(response['valor']);

                    $("#tipo_pago").val(response['tipo_pago']);

                    $("#periocidad").val(response['tipo_periocidad']);



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
                            <h1><img src="../../images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong>                Módulo de Configuración | Bonos</strong></h1>
                            <br/>
                            <TABLE BORDER="0" CELLSPACING="10" >


                                <TD><label>Bono</label></TD>
                                <?php // consulta de los meses
                                // Consultar la base de datos

                                $consulta_mysql='SELECT * FROM mno_new_concepto WHERE
  codigo = 19 OR codigo = 20 OR codigo = 37 OR codigo = 38 OR codigo = 39 OR codigo = 40 OR
  codigo = 41 OR codigo = 43 OR codigo = 44 OR codigo = 45 OR codigo = 46 OR codigo = 42 OR codigo = 47 OR codigo = 48  OR
  codigo = 49 OR codigo = 50 OR codigo = 51 OR codigo = 49 OR codigo = 11 OR codigo = 12 OR codigo = 17 OR codigo = 18 ORDER BY mno_new_concepto.nombre' ;
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
                                    <td>
                                        <label>Forma de Pago</label>
                                    </td>
                                    <td>
                                        <select name="tipo_pago" id="tipo_pago">
                                            <option value="0" >Monto Fijo</option>
                                            <option value="1">% Salario Base</option>
                                            <option value="2">Unidad Tributaria</option>
                                        </select>
                                    </td>
                                </tr>



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