<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 01/10/14
 * Time: 09:32 AM
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



    if(isset($_POST['semana_mensual'])){


            $validation = array(

                array('nombre' => 'codigo_empleado_hi',
                    'requerida' => true,
                    'regla' => 'number'),


                array('nombre' => 'anhio',
                    'requerida' => true,
                    'regla' => 'number'),



                array('nombre' => 'valor',
                    'requerida' => true,
                    'regla' => 'float',
                    'tipo' => ','),


                array('nombre' => 'bono_codigo',
                    'requerida' => true,
                    'regla' => 'number'),


            );


        $validated = new Validate($validation,$_POST);
        $validated->validate();


        if(!$validated->getIsError()){

            $codigo_empleado = $_POST['codigo_empleado_hi'];
            $cedula = $_POST['cedula_hi'];
            $bono_codigo = $_POST['bono_codigo'];
            $anhio = $_POST['anhio'];
            $mes = $_POST['mes'];
            $valor = $_POST['valor'];


            $sql = "INSERT
                INTO mno_new_concepto_empleado
                (codigo_empleado,codigo_concepto,total,mes,anhio)
                VALUES
                ('$codigo_empleado','$bono_codigo','$valor',
                  '$mes','$anhio')";



            $result=mysql_query($sql);

            send_error_redirect(false);


        }else if($validated->getIsError()  ){

            send_error_redirect(true);
        }


    }else{




        $validation = array(

            array('nombre' => 'codigo_empleado_hi',
                'requerida' => true,
                'regla' => 'number'),

            array('nombre' => 'cedula_hi',
                'requerida' => true,
                'regla' => 'number'),


            array('nombre' => 'bono_codigo',
                'requerida' => true,
                'regla' => 'number'),


            array('nombre' => 'anhio',
                'requerida' => true,
                'regla' => 'number'),



            array('nombre' => 'valor1',
                'requerida' => true,
                'regla' => 'float',
                'tipo' => ','),

            array('nombre' => 'valor2',
                'requerida' => true,
                'regla' => 'float',
                'tipo' => ','),



            array('nombre' => 'valor3',
                'requerida' => true,
                'regla' => 'float',
                'tipo' => ','),

            array('nombre' => 'valor4',
                'requerida' => true,
                'regla' => 'float',
                'tipo' => ','),


        );

        $validated = new Validate($validation,$_POST);
        $validated->validate();

        if(!$validated->getIsError()){


            $codigo_empleado = $_POST['codigo_empleado_hi'];
            $bono_codigo = $_POST['bono_codigo'];
            $cedula = $_POST['cedula_hi'];

            $anhio = $_POST['anhio'];

            $mes = $_POST['mes'];



            $numero_lunes = count(getMondays($anhio,$mes));


            $valor1  = $_POST['valor1'];
            $valor2  = $_POST['valor2'];
            $valor3  = $_POST['valor3'];
            $valor4  = $_POST['valor4'];
            $valor5  = '';

            if($numero_lunes == 5){
                $valor5 = $_POST['valor5'];
            }


            $sql = "INSERT
                INTO mno_new_concepto_empleado
                (codigo_empleado,codigo_concepto,semana_1,semana_2,
                  semana_3,semana_4,semana_5,mes,anhio)
                VALUES
                ('$codigo_empleado','1','$valor1',
                  '$valor2','$valor3','$valor4','$valor5',
                  '$mes','$anhio')";


            $result=mysql_query($sql) or die('mno_new_concepto_empleado '.mysql_error());




            send_error_redirect(false);

        }else{
            send_error_redirect(true);
        }



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

            $( "#buscar_empleado" ).click(function() {
                var win = window.open("buscar_empleado.php", "nuevo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=900, height=600,left=200,top=90 ");
                win.focus();
            });


            var codigo = "";


            $('#mes').bind('change',function() {
                var optionSelected = $("option:selected", this);
                var valueSelected = this.value;
                var mes = valueSelected;

                var anhio = $("#anhio").val();


                var mensual;


                if($('#semana_mensual').is(':checked')){
                    mensual = 'si';
                }else{
                    mensual = 'no';
                }


                var parametros = { mes : mes,
                                   anhio : anhio,
                                  mensual : mensual};

                $.ajax({
                    data:  parametros,
                    url:   'ajax_form.php',
                    type:  'post',
                    beforeSend: function () {
                        $("#resultado").html('<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' +
                        '<img src="../../images/ajax-loader.gif" alt="Ajax Cargando" height="42" width="42">');
                    },
                    success:  function (response) {
                        $("#respuesta").html(response);
                    }
                });


            });


            $('#semana_mensual').change(function(){


                var mes = $('#mes').val();

                var anhio = $("#anhio").val();


                var mensual;


                if($('#semana_mensual').is(':checked')){
                    mensual = 'si';
                }else{
                    mensual = 'no';
                }


                var parametros = { mes : mes,
                    anhio : anhio,
                    mensual : mensual};

                $.ajax({
                    data:  parametros,
                    url:   'ajax_form.php',
                    type:  'post',
                    beforeSend: function () {
                        $("#resultado").html('<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' +
                        '<img src="../../images/ajax-loader.gif" alt="Ajax Cargando" height="42" width="42">');
                    },
                    success:  function (response) {
                        $("#respuesta").html(response);
                    }
                });

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
                            <h1><img src="../../images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong>                Módulo de Inventario | Empresa</strong></h1>
                            <br/>







                            <TABLE BORDER="0" CELLSPACING="10" >


                                <TR>
                                    <TD><label>Cédula de Empleado</label></TD>
                                    <td> <input type="text" name="cedula"  disabled></td><td><input type="button" name="buscar_empleado" id="buscar_empleado" value="Buscar"/>
                                    </TD>

                                    <input type="hidden" name="codigo_empleado_hi" id="codigo_empleado_hi"/>
                                    <input type="hidden" name="cedula_hi" id="cedula_hi"/>
                                </TR>

                                <tr>

                                <TD><label>Bono</label></TD>
                                <?php // consulta de los meses
                                // Consultar la base de datos

                                $consulta_mysql='SELECT * FROM mno_new_concepto WHERE tipo_concepto = 2
AND codigo <> 9 AND codigo <> 10 AND codigo <> 12 ORDER BY mno_new_concepto.nombre';
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
                                echo "<select name='mes' id='mes' >";
                                while($fila=mysql_fetch_array($resultado_consulta_mysql)){
                                    echo "<option value='".$fila['codigo']."'>".$fila['descripcion']."</option>";
                                }
                                echo "</select>";
                                echo "</TD>";
                                ?>


                                <TR>
                                    <TD><label>Pago Anual?</label></TD>
                                    <td> <input type="checkbox" name="semana_mensual" id="semana_mensual"  checked></td>
                                    </TD>

                                </TR>



                                <!-- leonel -->


                            </TABLE>
                            <div id="respuesta">

                            </div>
                            <br/>
                            <table>
                                <tr>
                                    <td><input type="submit" value="Guardar datos" name="submit"></td>
                                    <td><a href="vehiculo_ver.php"><input type="button" value="Ver datos"></a> </td>
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