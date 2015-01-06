<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 02/10/14
 * Time: 05:53 PM
 */


header("Content-Type: text/html;charset=utf-8");
ini_set('display_errors', 'On');
ini_set('display_errors', 1);

require_once('../../db.php');



if(isset($_POST['submit'])){


    require_once('../../clases/Validate.php');
    require_once('../../clases/funciones.php');

    $validation = array(


        array('nombre' => 'tipo_pago',
            'requerida' => true,
            'regla' => 'number'),

        array('nombre' => 'periocidad',
            'requerida' => true,
            'regla' => 'number'),

        array('nombre' => 'nombre',
            'requerida' => true
        ),

    );



    $validated = new Validate($validation,$_POST);
    $validated->validate();



    if(!$validated->getIsError()){

        $nombre = $_POST['nombre'];
        $fijo = 'no';
        if(isset($_POST['fijo'])){
            $fijo = 'si';
        }

        $periocidad = $_POST['periocidad'];

        $tipo_pago = $_POST['tipo_pago'];

        $valor = $_POST['valor'];

        $formula = str_replace(' ', '',$nombre);
        $formula = lcfirst($formula);


        $sql = "INSERT INTO mno_new_bonos_produccion
                (nombre,tipo_concepto,codigo_formula,valor,tipo_forma_pago,tipo_periocidad,fijo)
              VALUES
              ('$nombre','2','$formula','$valor','$tipo_pago','$periocidad','$fijo')" ;



        mysql_query($sql) or die('error agregar bono nuevo'.mysql_error());

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

            $("#buscar_vehiculo").click(function() {
                var win = window.open("buscar_vehiculo.php", "nuevo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=900, height=600,left=200,top=90 ");
                win.focus();
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
                            <h1><img src="../../images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong>                Módulo de Nomina | Nuevo Bonos de Producción</strong></h1>
                            <br/>

                            <div>Nota: El nombre solo puede contener letras</div>
                            <br/>
                            <TABLE BORDER="0" CELLSPACING="10" >

                                <tr>
                                    <td>
                                        <label>Nombre</label>
                                    </td>
                                    <td>
                                        <input id="nombre" name="nombre" type="text"/>
                                    </td>
                                </tr>



                                <tr>
                                    <td>
                                        <label>Fijo?</label>
                                    </td>
                                    <td>
                                        <input id="fijo" name="fijo" type="checkbox"/>
                                    </td>
                                </tr>



                                <tr>
                                    <td>
                                        <label>Periocidad</label>
                                    </td>
                                    <td>
                                        <select name="periocidad" id="periocidad">
                                            <option value="0">Mes</option>
                                            <option value="1">Quinceal</option>
                                            <option value="2">Mensual</option>
                                            <option value="3">Bimestral</option>
                                            <option value="4">Trimestral</option>
                                            <option value="5">Cuatrmestral</option>
                                            <option value="6">Semestral</option>
                                            <option value="7">Anual</option>
                                        </select>
                                    </td>
                                </tr>



                                <tr>
                                    <td>
                                        <label>Forma de Pago</label>
                                    </td>
                                    <td>
                                        <select name="tipo_pago" id="tipo_pago">
                                            <option value="0">Monto Fijo</option>
                                            <option value="1">% Salario Base</option>
                                            <option value="2">% Salario Normal</option>
                                            <option value="3">% Salario Integral</option>
                                            <option value="4">Unidad Tributaria</option>
                                        </select>
                                    </td>
                                </tr>






                                <tr>
                                    <td>
                                        <label>Valor</label>
                                    </td>
                                    <td>
                                        <input id="valor" name="valor" type="text"/>
                                    </td>
                                </tr>

                                <!-- leonel -->


                            </TABLE>

                            <br/>
                            <table>
                                <tr>
                                    <td><input type="submit" value="Guardar datos" name="submit"></td>
                                    <td><a href="./bono_produccion_ver.php"><input type="button" value="Ver datos"></a> </td>
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