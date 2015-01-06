<?php

header("Content-Type: text/html;charset=utf-8");
ini_set('display_errors', 'On');
ini_set('display_errors', 1);

require_once('../../db.php');



if(isset($_POST['submit'])){

    require_once('../../clases/Validate.php');
    require_once('../../clases/funciones.php');

    $validation = array(

        array('nombre' => 'codigo_bien_hi',
            'requerida' => true,
            'regla' => 'number'),

        array('nombre' => 'codigo_bien_tipo_hi',
            'requerida' => true,
            'regla' => 'number'),

        array('nombre' => 'codigo_mantenimiento_hi',
            'requerida' => true,
            'regla' => 'number'),

        array('nombre' => 'numero_factura',
            'requerida' => true,
           ),

        array('nombre' => 'costo',
            'requerida' => true,
            'regla' => 'float',
            'tipo' => ','),

        array('nombre' => 'medida_especial',
            'requerida' => false,
            'regla' => 'number'),

    );



    $validated = new Validate($validation,$_POST);
    $validated->validate();

    if(!$validated->getIsError()){

        $codigo_bien_hi = $_POST['codigo_bien_hi'];
        $codigo_bien_tipo_hi = $_POST['codigo_bien_tipo_hi'];
        $codigo_mantenimiento_hi = $_POST['codigo_mantenimiento_hi'];
        $codigo_contable = $_POST['codigo_contable'];
        $numero_factura = $_POST['numero_factura'];
        $costo = $_POST['costo'];

        $fecha_hoy = fecha_sicap();

        $medida_especial = '';

        if(isset($_POST['medida_especial'])){
            $medida_especial = $_POST['medida_especial'];
        }

        $sql = "INSERT INTO bie_realizar_mantenimiento(codigo_bien, codigo_bien_tipo, codigo_mantenimiento, codigo_contable, numero_factura, costo, medida_especial, fecha)
            VALUES('$codigo_bien_hi','$codigo_bien_tipo_hi','$codigo_mantenimiento_hi','$codigo_contable',
            '$numero_factura','$costo','$medida_especial','$fecha_hoy')";

        mysql_query($sql) or die('error agregar bie_mantenimiento  '.mysql_error());


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


            var codigo_tipo;

            $("#buscar_bien").click(function() {

                var win = window.open("buscar_bien.php", "nuevo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=900, height=600,left=200,top=90 ");
                win.focus();
            });

            $("#buscar_mantenimiento").click(function() {
                codigo_tipo = $("#codigo_bien_tipo_hi").val();
                var win = window.open("buscar_mantenimiento.php?id="+codigo_tipo, "nuevo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=900, height=600,left=200,top=90 ");
                win.focus();
            });

        });

    </script>

</head>


<body class="flickr-com">


<form method="post" accept-charset="UTF-8" name="formulario">

    <div id="body_bottom_bgd">
        <div id="">
            <div align="justify" id="right_col" >

                <div id="header">
                </div>

                <div id="">
                    <div id="firefoxbug">

                        <div class="dynamicContent" align="left">


                            <h1><img src="../../images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong>                Módulo de Bienes | Realizar Mantenimiento</strong></h1>
                            <br/>
                            <TABLE BORDER="0" CELLSPACING="10" >

                            <tr>
                                <td><label>Nombre Bien</label></td>
                                <td>
                                    <input type="text" name="nombre_bien"  disabled>
                                    <input type="button" name="buscar_bien" id="buscar_bien" value="Buscar"/>
                                    <input type="hidden" name="codigo_bien_hi" id="codigo_bien_hi"/>
                                    <input type="hidden" name="codigo_bien_tipo_hi" id="codigo_bien_tipo_hi"/>
                                </td>

                            </tr>

                            <tr>
                                <td><label>Nombre Mantenimiento</label></td>
                                <td>
                                    <input type="text" name="nombre_mantenimiento"  disabled>
                                    <input type="button" name="buscar_mantenimiento" id="buscar_mantenimiento" value="Buscar" disabled/>
                                </td>
                                <input type="hidden" name="codigo_mantenimiento_hi"/>
                            </tr>


                                <tr>
                                    <td>
                                        <label>Código Contable</label>
                                    </td>
                                    <td>
                                        <input name="codigo_contable"  type="text"/>
                                    </td>
                                </tr>


                            <tr>
                                <td>
                                    <label>Número Factura</label>
                                </td>
                                <td>
                                    <input name="numero_factura"  type="text"/>
                                </td>
                            </tr>


                            <tr id="medida_campo"  >

                            </tr>


                            <tr>
                                <td><label >Costo</label></td>
                                <td><input name="costo" type="text"/></td>
                            </tr>

                                <!-- leonel -->


                            </TABLE>

                            <br/>
                            <table>
                                <tr>
                                    <td><input type="submit" value="Guardar datos" name="submit"></td>
                                    <td><a href="ver_realizar_mantenimiento.php"><input type="button" value="Ver datos"></a> </td>
                                    <td><a href="../../bie_menu.php"><input type="button" value="Atras"></a> </td>

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